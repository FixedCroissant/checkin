<?php

?>
<!DOCTYPE html>
<!--
Author: J. Williams
Title: Student Lookup
Date: 3/19/2015
Description: 
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NC State University - Housing - Check-In</title>
    <link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
    <!--Bootstrap--> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="css/checkin.css">
    <!--Parsley Validator-->
    <script type="text/javascript" src="../../scripts/parsley.min.js"></script>
    <!--Parsley CSS Theme-->
    <link rek="stylehseet" href="css/parsley.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
          <!-- Stack the columns on mobile by making one full-width and the other half-width -->
          <div class="container-fluid">
              <div id="header">
                  <img class="img-responsive" src="images/logo.png" alt="University Housing">
              </div> 
              
              <h2>North Carolina State University </h2>
              <h3 class="underline">Housing Check-In Student Search</h3>
              
            <div id="instructions" class="center col-sm-12">
           <div class="row">
               <p>Student search, please start typing the student's last name to narrow down your search. <br/> <br/>Feel free to <strong>click</strong> the student's ID number and it will be copied to the Check-In page. You will need to go back to the main page to see this change.</p>
            <br/>
			<!--Comment out 06 10 2015-->
			<!--<p><span style='font-weight:bold;'>Note (06 04 15)</span>: Student search by <span style='text-decoration:underline;'>last name</span> is currently in the process of searching for Fall 2015 students.</p>-->
			</div>
              
            <br/>
            <br/>
            </div><!--End Instructions block-->
            
            <div id="application_table">
                
            <form id="personSEARCH" name="personSEARCH" method="post">
                <!--Row #1 -- Provide Drop-Down to Select Which Way to Search -->
                <div id="userSELECT_SEARCH_OPTION" class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"><p>How would you like to search for this student? <br/>
                            <!--Provide the end user with 3 different options on how to search for a particular user-->
                            <select id="searchSTUDENT_CHOSEN">
                                <option value="" selected >Select ...</option>
                                <option value="fname">First Name</option>
                                <option value="lname">Last Name</option>
                                <option value="mname">Middle Name</option>
                            </select>
                            </p></div>
                    
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                </div>
                
              <!--Row #1 -- First Name Search -->
                <div id="searchBY_FIRSTNAME" class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"><label for='first_name'>Start typing first name: <br/>(minimum 4 characters)</label><br/><input type='text' name='first_name' id='first_name' placeholder='First Name'/></div>
                    <!--Create a button to look up students, if we don't know their Student ID number-->
                    <div class="col-sm-3" style="margin-left: 10px; font-weight:bold;font-size: medium;text-decoration: underline;">Search Results</div>
                    <div class="col-sm-3"></div>
                </div>
                
              <!--Row #2 -- Middle Name Search -->
                <div id="searchBY_MIDDLENAME" class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"><label for='middle_name'>Start typing middle name: <br/>(minimum 2 characters)</label><br/><input type='text' name='middle_name' id='middle_name' placeholder='Middle Name'/></div>
                    <!--Create a button to look up students, if we don't know their Student ID number-->
                    <div class="col-sm-3" style="margin-left: 10px; font-weight:bold;font-size: medium;text-decoration: underline;">Search Results</div>
                    <div class="col-sm-3"></div>
                </div>
                
              <!--Row #3 -- Last Name Search -->
                <div id="searchBY_LASTNAME" class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"><label for='last_name'>Start typing last name: <br/>(minimum 2 characters)</label><br/><input type='text' name='last_name' id='last_name' placeholder='Last Name'/></div>
                    <!--Create a button to look up students, if we don't know their Student ID number-->
                    <div class="col-sm-3" style="margin-left: 10px; font-weight:bold;font-size: medium;text-decoration: underline;">Search Results</div>
                    <div class="col-sm-3"></div>
                </div>
                 
                 <!--DISPLAY RESULTS RIGHT HERE-->
                 <div id ="results_placeholder" class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                </div>
                 
                               
                 
                 <!--END DISPLAY RESULTS -->
          </div> <!--End Application table-->
          <!--Start Form Controls-->
                <div id="form_controls">
                          <div class="row">
                              <!--Line Break--> 
                                    <div class="col-sm-3"></div>
                                    <!--Below button class does not work with Internet Explorer, but does work with Safari, Chrome, Firefox-->
                                    <!--<div class="col-sm-3">  <a href='index.php'><button type='button' class='btn btn-default'>Go Back</button></a></div>-->
                                    <div class="col-sm-3"><a class="btn btn-default btn-large" href="index.php" title="Go back to main check-in page.">Go Back</a></div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-3"></div>
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
          </div><!--End Container Fluid-->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     <!--jQuery UI Import-->
    <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/person_search_individual.js"></script>
    <script src="js/provide_search_options.js"></script>
    <script src="js/retrieveClickedID.js"></script>
    
    
    
<!--    <script type="text/javascript">
    $('document').ready(function(){
      $(".add_cell_phone_number").change(function() {
                            if(this.checked) {
                                //Do stuff
                                 $('#cellphone_add').show();
                            }else{
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
    </script>-->
    
  </body>
</html>


