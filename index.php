<!DOCTYPE html>
<!--
Author: J. Williams
Date: 3/10/2015
Updated: 06 05 2015
Description: A way where incoming NC State Students will have the ability to swipe their user ID and our housing staff can read their information and
their roommates information regarding first and last name, place of residence (i.e. Residence Hall or Apartment), Room # and phone number.
All of this information is then kept on our housing db for report generation, on the overview.php page and the report.php pages.

Added 06 05 2015:
Added the ability to
-->

<?php
//Check login and see if it's within the "welcome_week_signup_security_users" and has a "Y" flag on the "allow_to_check_in" field column.
include('security/index.php');

//Get user from SHIB
$unityID=$_SERVER['SHIB_UID'];

//make all lower case.
$id_to_compare = strtolower($unityID);


$authorization = checkSecurityTable($id_to_compare);

//If the person is not in the 'welcome_week_signup_security_users' with a 'y' flag, then redirect them to a different page.
if($authorization="n"){
    //redirect to the correct page.
    header('Location:http://housing.ncsu.edu/apps/checkin/index.php');
}



//Basic Variables
$today = date("m-d-Y");
//Set time zone
date_default_timezone_set('America/Indianapolis');
$time = date("h:i:s");
$time_Needed = "<span id='ct'></span>";

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NC State University - Housing - Check-In</title>
    <!--Fav Icon Set-->
    <link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/checkin.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!--Parsley Validator-->
    <script type="text/javascript" src="../../secure/scripts/parsley.min.js"></script>
    <!--Parsley CSS Theme-->
    <link rek="stylehseet" href="css/parsley.css">
    <!--Align th new student popup to the right-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body onload="display_ct(); getIDNeeded();">
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="container-fluid">
    <!--06 10 2015 Create a Loader as the page is loading-->
    <!--Internal CSS-->
    <style>
        .loading {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('images/page_loading.gif') 50% 50% no-repeat rgb(249,249,249);
            background-color:white;
        }
    </style>
    <!--End Internal CSS -->
    <div class="loading"></div>
    <!--06 10 2015 -- test jQuery -->
    <script type="text/javascript">
        $(window).load(function() {
            //$(".loader").fadeOut("slow");
            //Hide loading image by default when the page is first loaded.
            $(".loading").hide();
        })


        $( document ).ready(function() {
            $( "#dashboard_link" ).click(function() {
                //once someone clicks the dashboard icon, show the loading image.
                $(".loading").show();

                //Production Version:
                //window.location.href="http://housing.ncsu.edu/apps/checkin/overview.php?dateREQUESTED=allDATES";
                //Testing Version:
                window.location.href="http://localhost/apps/checkin/overview.php?dateREQUESTED=allDATES";

            });
        });


    </script>
    <!--End Additions-->



    <div id="header">
        <input type="button" name="logout" onClick="window.location='https://housing.ncsu.edu/Shibboleth.sso/Logout'"
               value="Logout of Beep System" style="float:right;" />
        <img class="img-responsive" src="images/logo.png" alt="University Housing">
    </div>

    <h2>North Carolina State University </h2>
    <h3 class="underline">Housing Check-In</h3>

    <div id="instructions" class="center col-sm-12">
        <div class="row">
            <p> Welcome to NC State University, please swipe your Student Card so that we may better assist you.
        </div>
        <br/>
        <br/>
    </div><!--End Instructions block-->
    <!--Removed checkin-done.php as we're changing the options for the drop down and adding new students to the list manually.-->
    <!--Pull up students and enter them in the database table, welcome_week_signup-->
    <!--File Name (01):checkin-done.php-->
    <!--Manually add students to the database table, welcome_week_signup, based on the values they put into the system.-->
    <!--File Name (02): checkin-manual_student-done.php-->
    <!--Form action will be changed based on the interaction by the end-user.-->
    <form id="check_in_form_students" name="check_in_form_students" method="POST" action="processing/checkin-done.php" data-parsley-validate>
        <div id="application_table">
            <!--Row #1-->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='student_cardswipe'>Card Swipe:</label><br/><input type='textbox' name='student_cardswipe' id='student_cardswipe' data-parsley-required-message="Please swipe your card" maxlength="9" required />  </div>

                <!--Below button class does not work with Internet Explorer, but does work with Safari, Chrome, Firefox-->
                <!--<div class="col-sm-3"><a href='studentLookup.php'><button type='button' class='btn btn-default'>Lookup Student ID</button></a></div>-->
                <!--Create a button to look up students, if we don't know their Student ID number-->
                <div class="col-sm-3"><a class="btn btn-default btn-large" href="studentLookup.php" title="Student doesn't remember or have their ID? Use this link to look up their ID.">Lookup Student ID</a></div>
                <div class="col-sm-3"></div>
            </div>
            <!--Row #2-->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='todays_date'>Today's Date</label><br/><input type='textbox' name='todays_date' id ="todays_date" value='<?php echo $today; ?>'/></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>
            <!--Row #3-->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='current_time'>Current Time: </label><br/><input type='text' name='current_time' id="current_time" readonly /></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>
            <!--Row #4-->
            <!--Display Current Cell Phone Number Here -->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='current_time'>Current Phone: </label><br/><input type='text' name='current_phone_number' id="current_phone_number" readonly /></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>
            <!--Removed on 06 10 2015 @ 4:20pm as we need to have students that are in the SIS system strictly-->
            <!--Row #4 This will be used if someone is being searched and cannot be found.-->
            <!--<div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='student_missing_in_system'>Student Not In System?</label><br/><input type="checkbox" id="student_missing_in_system" name="student_missing_in_system"  />&nbsp; &nbsp; Add new student</div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>-->
            <!--Add Ability to Update Key Code-->
            <!--<div class="row" id="cellphone_update_yes">
               <div class="col-sm-3"></div>
               <div class="col-sm-3"><label for='keycode_update_yes'>Update Key Code?</label><br/><input type="checkbox" id="keycode_update_yes" name="keycode_update_yes" class='add_keycode_number' />&nbsp; &nbsp; Yes</div>
               <div class="col-sm-3"></div>
               <div class="col-sm-3"></div>
           </div>-->

            <!--Row #5-->
            <!--<div class="row" id='key_code_add_group'>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='key_code_add'>New Key Code:</label><br/><input type='textbox' id="key_code_add" /></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>-->

            <!--Row #6 Information About Whether or not their Roommate Has Checked In-->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='roommate_check_in'>Roommate Check In?</label><br/><span id='roomMATE_CHECKED_IN'></span></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>


            <!--Add Ability to Update Cell Phone-->
            <div class="row" id="cellphone_update_yes">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='cellphone_update_yes'>Update Cell Phone?</label><br/><input type="checkbox" id="cellphone_update_yes" name="cellphone_update_yes" class='add_cell_phone_number' />&nbsp; &nbsp; <span id='cellphone_update_yes_spanned_text'>Yes</span></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>
            <!--Row #4-->
            <div class="row" id="cellphone_add">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='cellphone_new'>New Cell Phone:</label><br/><input type='textbox' id="key_code" name='cellphone_new' value='' maxlength="14" class="phone_us" placeholder="(XXX) XXX-XXXX"/></div>
                <div class="col-sm-3" style='border:1px solid black; background: yellow'>Please note: By updating the student's cell phone number, they will be enlisted into a text-messaging service through N.C. State "Wolf Alert". <strong style="color:red;">Please let the student know that they will be enrolled in a text messaging warning system.</strong></div>
                <div class="col-sm-3"></div>
            </div>

            <!--Add 3/25/2015-->
            <!--Expected checkin date-->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='expected_check_in_date'>Expected Check-In Date</label><br/><input type='text' readonly id='expected_check_in_date' name='expected_check_in_date' style='border:1px solid black; background-color: #E1E1E1'/></div>
                <div class="col-sm-3" id='expected_check_in_date_message'></div>
                <div class="col-sm-3"></div>
            </div>
            <!--Add 4/20/2015 -->
            <!--Override the staff to allow the person checking in to go ahead and check into the building-->
            <div class="row" id="cellphone_add">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><label for='allow_to_by_pass_early_checkin'>Allow student to check-in before the expected check-in date:</label><br/><input type='checkbox' id="allow_check_in_early" name='allow_to_by_pass_early_checkin' class="allow_to_check_in_early"/>&nbsp; &nbsp; Yes</div>
                <div class="col-sm-3" style='border:1px solid black; margin-left: 15px; background-color:yellow;' id='allow_check_in_early_message'><!--Removed on 6 10 2015 @ 4:30 pYou are now allowed to check this student into the system. Please click the 'Check-In' student button below.--><!--Added new message on 4:31p on 6 10 2015-->Please understand that additional charges will apply to students checking in early.</div>
                <div class="col-sm-3"></div>
            </div>

            <!--end add 3/25/2015-->
            <!--DISPLAY RESULTS RIGHT HERE-->
            <div id ="results_placeholder" class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>

            <!--DISPLAY IF THERE ARE NO RESULTS RIGHT HERE-->
            <div id ="no_results" class="row" >
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>



            <!--Values-->
            <input type='hidden' name='searched_residence_location' id='searched_residence_location' value=''/>
            <input type='hidden' name='searched_residence_room' id='searched_residence_room' value=''/>
            <input type='hidden' name='searched_residence_fname' id='searched_residence_fname' value=''/>
            <input type='hidden' name='searched_residence_lname' id='searched_residence_lname' value=''/>
            <!--April 17, 2015 Add two new data points to our database table. -->
            <input type='hidden' name='searched_residence_gender' id='searched_residence_gender' value=''/>
            <input type='hidden' name='searched_residence_classification' id='searched_residence_classification' value=''/>

            <!--Add Suffix-->
            <input type="hidden" name="searched_residence_suffix" id="searched_residence_suffix" value=""/>
            <!--Add Unit Bed Number -->
            <input type ="hidden" name="searched_residence_bed_number" id="searched_residence_bed_number" value=""/>


            <!--END DISPLAY RESULTS -->
        </div> <!--End Application table-->
        <!-- Provide a little spacing -->
        <br/>
        <br/>
        <!--Start Form Controls-->
        <div id="form_controls">
            <div class="row">
                <!--Line Break-->
                <div class="col-sm-3"></div>
                <div class="col-sm-3"><input id="submit_button" type ="submit" value="Check-In Student" enabled></div>
                <div class="col-sm-3"><input id="reset_button"  type="reset" value="Reset"></div>
                <div class="col-sm-3"><!--Temporary link to Dashboard--><!--overview.php?dateREQUESTED=allDATES--><a href='#' id='dashboard_link' title='Link to Dashboard'><img src="images/dashboard_icon.png"  onmouseover="this.src='images/dashboard_icon_red.png'" onmouseout="this.src='images/dashboard_icon.png'" ></img></a></div>
            </div>
        </div>
        <!--End Form Controls -->
    </form>
    <hr>
    <div id="footer">
        <p>
            NC State University Housing Copyright © 2015
        </p>
    </div>

    <!--Add Popup information-->
    <div class="loader"></div>
    <div id="backgroundPopup"></div>
    <!--End Popup information -->



</div><!--End Container Fluid-->
<!--jQuery UI Import-->
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/formFunctions.js"></script>
<script src="js/person_search.js"></script>
<script src="js/clock.js"></script>

<!--Igor Escobar's fantastic MaskPlugin import -->
<script type="text/javascript" src="js/mask/dist/jquery.mask.js"></script>


<script type="text/javascript">
    $('document').ready(function() {
        $('.phone_us').mask('(000) 000-0000');

        //Initially Hide Cell Phone option to update.
        $('#cellphone_add').hide();
        //Initially Hide the keycode option.
        $('#key_code_add_group').hide();
        //Initially hide the option of overriding the expected check-in date message.
        $('#allow_check_in_early_message').hide();
    });

    //Assign the values that are returned from the database lookup, prior to submitting the information
    //to the database in the next page, checkin-done.php
    $( "#check_in_form_students" ).submit(function( event ) {
        //Get values
        var residenceHallInformation = $("#residence_bldg_needed").text();
        var residenceHall_RoomNeeded = $("#residence_room_needed").text();
        //Searched Resident first name
        var searchedResidentFName= $("#first_name_needed").text();
        //Searched Resident last name
        var searchedResidentLName=$("#last_name_needed").text();

        //Searched Resident gender
        var searchedResidentGender = $("#searched_residence_gender_needed").text();
        //Searched Resident Classification
        var searchedResidentClassification = $("#searched_residence_classification_needed").text();

        //Searched Resident Suffix of Property
        var searchedResidentSuffix = $("#residence_unit_suffix_needed").text();

        //Searched Unit Bed Number
        var searchedResidentBedNumber = $("#residence_unit_bed_needed").text();

        //Set Residence Location in the hidden div
        $("#searched_residence_location").val(residenceHallInformation);
        //Set Residence Room in the hidden div
        $("#searched_residence_room").val(residenceHall_RoomNeeded);
        //Set Resident First Name in the hidden div
        $("#searched_residence_fname").val(searchedResidentFName);
        //Set Resident Last Name in the hidden div
        $("#searched_residence_lname").val(searchedResidentLName);

        //Set Resident Gender in the hidden div (above)
        $("#searched_residence_gender").val(searchedResidentGender);

        //Set Resident Classification in the hidden div (above)
        $("#searched_residence_classification").val(searchedResidentClassification);

        //Set the Resident's Building Suffix to the value hidden on the page.
        $("#searched_residence_suffix").val(searchedResidentSuffix);

        //Set the Resident's Unit Bed Number that was gathered (above) and insert it in the hidden textbox.
        $("#searched_residence_bed_number").val(searchedResidentBedNumber);



    });

    $('document').ready(function(){
        $(".allow_to_check_in_early").change(function() {
            if(this.checked) {
                //Show div on the right side of the screen.
                $('#allow_check_in_early_message').show();
                //Allow the person to check the "Check-In Student" button.
                $('#submit_button').prop("disabled",false);
            }else{
                //Hide the div completely.
                $('#allow_check_in_early_message').hide();
                //Turn off the automatic ability to disable the submit button when the Allow student to check-in before the expected check-in date.
                //This may end up causing problems.
                //$('#submit_button').prop("disabled",true);
            }
        });



        //If the "Update Cell Phone" checkbox is checked, then show the message to the end user.
        $(".add_cell_phone_number").change(function() {
            if(this.checked) {
                //Show div on the right side of the screen.
                $('#cellphone_add').show();
            }else{
                //Hide the div completely.
                $('#cellphone_add').hide();
            }
        });
        $(".add_keycode_number").change(function() {
            if(this.checked) {
                //Do stuff
                $('#key_code_add_group').show();
            }else{
                $('#key_code_add_group').hide();
            }
        });
    });

    //Supress the Enter Key
    $('#student_cardswipe').keypress(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    });

    function getIDNeeded(){
        //Retrieve Information
        var IDNeeded;
        IDNeeded = localStorage.getItem("IDNumber");

        if(IDNeeded !==null){
            var lengthOFID = IDNeeded.length;
        }
        //Check and make sure the length doesn't start with 00s, if it does we're going
        //to need to add the leading zeros back to the front of the student ID.
        if(lengthOFID===7){
            document.getElementById("student_cardswipe").value=("00"+IDNeeded);
            //Run automatic search
            runSearchManual("00"+IDNeeded);
        }
        //If the Student ID number picked is a regular Student ID (i.e. starts with 200) remember to put the number
        //in the text box.
        else if(lengthOFID===9){
            document.getElementById("student_cardswipe").value=IDNeeded;
            //Run automatic search
            runSearchManual(IDNeeded);

        }

        //Now, reset the ID.
        IDNeeded="";
        localStorage.removeItem("IDNumber");


    }
</script>

</body>
</html>
