<?php
//live
//require_once('../mysql/housing_apps_db_pdo.php');
//Development
require_once('db/PDO/connection.php');
//New Get Info
include('checkinPopulation.php');
?>
<?php
/*
 * Author: J. Williams
 * Date: 03/06/2014
 * Updated: Wednesday, 6/22 - Friday, 6/24 2016
 * Version: 1.00
 * Description: A basic report that lists all the students that have told University Housing that they're going to be doing a Co-Op in the upcoming term..
 */

// Create connection
//$conn = new mysqli($hostname, $username, $password, $database);

//NEW PDO Connection
$conn = new PDO($hostname,$username,$password);

//Individual Day Information
$group1_RESIDENCE = new checkinPopulation();

//Complete Groups to Paint an overview picture.
$group_TOTAL_PICTURE = new checkinPopulation();

//Display Date Requested to End User for the Report Dashboard.
//Temporary variable
$dateREQUESTED=NULL;

if($_REQUEST["dateREQUESTED"]==="allDATES"){
    //$dateREQUESTED="All Dates for Opening Weekend";
    //Edit on 4-22-2015; make the change so it states "Summary for All Dates"
    $dateREQUESTED="Summary for All Dates";
}

?>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <title>
        University Housing - Welcome Week Sign Up
    </title>
    <!--jQuery Import - minified-->
    <script src='//code.jquery.com/jquery-1.11.1.min.js' type='text/javascript'></script>
    <!--jQuery DataTable script-->
    <script src='//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js' type='text/javascript'></script>
    <!--jQuery UI for the date pickers-->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--jQuery DataTable CSS Import -->
    <link rel='stylesheet' type='text/css' href='//cdn.datatables.net/1.10.4/css/jquery.dataTables.css'>
    <link rel='stylesheet' type='text/css' href='css/report.css'>
    <!--Ability to Export tables to PDF or Excel format-->
    <script type="text/javascript" src="excel_export/html_table_export/tableExport.js"></script>
    <script type="text/javascript" src="excel_export/html_table_export/jquery.base64.js"></script>
    <!--End ability to Export tables-->
    <!--CSS Needed for the date pickers-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!--End Bootstrap-->
    <!--Fav Icon-->
    <link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
</head>
<body>
<input type="button" name="logout" onClick="window.location='https://shib.ncsu.edu/idp/logoutredir.jsp?return_url=https://housing.ncsu.edu/Shibboleth.sso/Logout?return=/apps/loggedout.php	'"
       value="Logout of Check-In System" style="float:right;" />
<img src="https://housing.ncsu.edu/secure/images/logo.png" alt="University Housing logo" title="NC State University Housing" />
<div id = "header">
    <h4>Welcome Week Check-In</h4>
    <h5>Broken Down by Building</h5>
</div>
<div id='goToHomePage' style='height:55px; margin-left: 15px;'>
    <a href ='http://housing.ncsu.edu/apps/checkin/index.php' title='Go back to checkin'><strong>Go back to Check-In Screen</strong></a>
</div>
<!--All the user to pick the date they want information -->
<div id="datechange">
    <p>Please select the date for Check In: </p>
    <select id="datebox" class="dateSELECT">
        <!--Initial option-->
        <option value="#">Select ...</option>
        <!--Get Custom Dates -->
        <option value='custom'>Custom Dates</option>
    </select>
    <p>Or, select two dates of your choosing: <br/>
        <br/>
        <input type ="checkbox" id="customDatesSelected" name="customDatesSelected">Provide Custom Dates</input></p>
    <br/>
    <div id ="customDatesWanted">
        <form action="overview.php?dateREQUESTED=custom" id="customDatesCreated" name="customDates" method="POST">
            Beginning Date: <input id="customBeginDate" type="textbox" maxlength="18" name="beginningDateNeededCustom"></input> <br/>
            Ending Date: &nbsp; <input id="customEndDate" type="textbox" maxlength="18" name="endingDateNeededCustom"></input>
            <br/>
            <br/>
            <input type="submit" value="Provide New Information"></input>
        </form>
    </div>
    Currently viewing date:&nbsp; <?php echo "<strong>".$dateREQUESTED."</strong>"; ?>
    <br/>
    <br/>
    <!--Create a block showing the beginning and ending dates for "Summary of All Dates"-->
    <div id='blockOfDateBeginAndEnd'>
        Date Begin:<span id='dateBeginNotify'></span> <br/>
        Date End: <span id='dateEndNotifyUser'></span>
    </div>
    <!--End block showing the beginning and ending dates for "Summary of All Dates"-->
    <!--Line Breaks-->
    <br/>
    Table will automatically update.
    <!--Line Breaks-->
    <br/>
    <br/>

    <!--Ability to Export Data -->
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" onclick="$('#welcome_week_checkin').tableExport({type:'excel',escape:'true'});" class="btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>

        <br/>
        <span style='font-size:small;'><span style='text-decoration:underline;'>Note:</span>(This function does not work with Internet Explorer. Firefox and Chrome work fine.)</span>
    </div>
    <!--Line breaks-->
    <br/>
    <br/>
    <!--End the ability to export data.-->
</div>
<div id="columnControls">
    <p> Other Reports <img src="images/other_reports.png" alt="other reports available"></p>
    <ul>
        <li><a href='overview_campus_area.php?dateREQUESTED=allDATES'>View by Campus Area</a></li>
    </ul>
    <p>Currently hidden columns <img src="images/hidden_columns.png" alt="currently hidden columns"></p>
    <ul>
        <li><a href='#' id='show_bed_information' title='Click to display/hide information about bed utilization.'>Bed Information</a> (% and total used) </li>
    </ul>
    Early Morning or Late in the Day Hours
    <ul>
        <li><a href='#' id='showEarlyMorning'>Show/Hide Early Morning Hours</a></li>
        <li><a href='#' id='showEvening'>Show/Hide Late Evening Hours</a></li>
    </ul>
</div>
<br/>
<!--get date needed from dropdown-->
<script src="js/getDate.js"></script>
<!--calculate the totals for each time period-->
<script src="js/calcTotals.js"></script>
<!--Hide/Show chart as needed-->
<!--Seperate file for main overview page-->
<script src='js/showHideChartAndColumns_main_page.js'></script>

<table id="welcome_week_checkin" border="1">
    <thead>
    <!--Residence Hall or Apartment Name-->
    <th style="width: 150px;">
        Residence Hall & Apartments
    </th>
    <!--Beds allocated for each building per PeopleSoft lookup.-->
    <th style="width:145px"  class="bed_information">
        Beginning Beds
    </th>
    <!--Initial hide this block-->
    <!--From just over mid-night to 7:00am-->
    <th class="earlyMorning">
        12-12:59:59 am
    </th>
    <!--01:00-01:59:59am-->
    <th class="earlyMorning">
        01-01:59:59 am
    </th>
    <!--02:00-02:59:59am-->
    <th class="earlyMorning">
        02-02:59:59 am
    </th>
    <!--03:00-03:59:59am-->
    <th class="earlyMorning">
        03-03:59:59 am
    </th>
    <!--04:00-04:59:59am-->
    <th class="earlyMorning">
        04-04:59:59 am
    </th>
    <!--05:00-05:59:59am-->
    <th class="earlyMorning">
        05-05:59:59 am
    </th>
    <!--06:00-06:59:59am-->
    <th class="earlyMorning">
        06-06:59:59 am
    </th>
    <!--07:00-07:59:59am-->
    <th  style="width:100px;">
        07-07:59:59 am
    </th>
    <!--8:00-9:00-->
    <th class="center-headings">
        8-9 am
    </th>
    <!--9:00-10:00-->
    <th class="center-headings">
        9-10 am
    </th>
    <!--10:00-11:00-->
    <th class="center-headings">
        10-11 am
    </th>
    <!--11:00-12:00-->
    <th class="center-headings">
        11-12 n
    </th>
    <!--12:00-1:00p-->
    <th class="center-headings">
        12-1 pm
    </th>
    <!--1:00-2:00-->
    <th class="center-headings">
        1-2 pm
    </th>
    <!--2:00-3:00-->
    <th class="center-headings">
        2-3 pm
    </th>
    <!--3:00-4:00-->
    <th class="center-headings">
        3-4 pm
    </th>
    <!--4:00-5:00-->
    <th class="center-headings">
        4-5 pm
    </th>
    <!--From 5:00 to 05:59pm-->
    <th class="lateEvening">
        5:00-05:59 pm
    </th>
    <th class="lateEvening">
        6:00-06:59 pm
    </th>
    <th class="lateEvening">
        7:00-07:59 pm
    </th>
    <th class="lateEvening">
        8:00-08:59 pm
    </th>
    <th class="lateEvening">
        9:00-09:59 pm
    </th>
    <th class="lateEvening">
        10:00-10:59 pm
    </th>
    <th class="lateEvening">
        11:00-11:59 pm
    </th>
    <th>
        Totals:
    </th>
    <!--Add amount of buildings left under here -->
    <th class='bed_information' style="width: 100px;">
        Remaining Beds
    </th>
    <!--END remaining rooms-->
    <!--Add # of beds left under here -->
    <th class='bed_information' style="width: 150px;">
        % of Beds Used
    </th>
    <!--END remaining percentage of beds left-->
    </thead>
    <tbody>

    <?php
    //Variables
    $totalResults=0;
    $totalResultsGrouping= array();

    //THESE ARE GROUPS!!!! OF BUILDINGS. THEY WILL BE BROKEN DOWN AND SEPARATED LIKE AVENT FERRY === AFC-A,AFC-B,AFC-E,AFC-F.
    //06-25-2015 - Temporarily read the stated bed counts below, as the following residence halls are not reading:
    //Bagwell
    //Becton
    //Berry
    //and others
    //uncommented out on 08-15-2015 @ 4:55pm
    //these numbers include RA numbers & are the assigned rooms, prior was all rooms available regarless of whether or not it was assigned.
    //HARD CODED  VALUES...
    //$initial_bed_count = array("Alexander Hall"=>"163","Avent Ferry"=>"560","Bagwell Hall"=>"159","Becton Hall"=>"203","Berry Hall"=>"57","Bowen Hall"=>"305","Bragaw Hall"=>"748","Carroll Hall"=>"347","Gold Hall"=>"57","Lee Hall"=>"726","Metcalf Hall"=>"399","North Hall"=>"231","Owen Hall"=>"370","Sullivan Hall"=>"686","Syme Hall"=>"206","Tucker Hall"=>"347","Turlington Hall"=>"160","Watauga Hall"=>"93","Welch Hall"=>"54","Wood Hall"=>"435","Wolf Village"=>"1142","Wolf Ridge"=>"722");


    //Get the initial bed counts from the SIS database.
    //07-14-2015-Commented out as we currently do not have a way of specifying the term and does
    //not pull up building information for rooms that are currently un-occupied. So, for the month of
    //July only 6 buildings are available. (Alexander, Owen,Tucker,Turlington,Wolf Village and Wolf Ridge are presenting information)
    //the total amount given is a 3361.

    //Below reads from SIS --- does not include RAs
    //commented out on 08 15 2015 @ 4:55pm
    //turn live on 06-24-2016.
    //pulling Fall 2016 bedroom information.
    include('utilities/readRoomAvail.php');

    //Create an array of Residence Halls & Complexes.
    $residenceHALLSANDAPARTMENTS = array("Alexander Hall","Avent Ferry","Bagwell Hall","Becton Hall","Berry Hall","Bowen Hall","Bragaw Hall","Carroll Hall","Gold Hall","Lee Hall","Metcalf Hall","North Hall","Owen Hall","Sullivan Hall","Syme Hall","Tucker Hall","Turlington Hall","Watauga Hall","Welch Hall","Wood Hall","Wolf Village","Wolf Ridge");

    //Get the date that we need from the option block that is currently residing on line(s) 50-65.
    $dateNEEDED = $_GET["dateREQUESTED"];


    /**
     * Start number of groups...
     **/
    //Get totals from the welcome_week_signup table
    include('endcells/getAllForUniversityHousing.php');


    echo "<div id='totalNumbers' style='display:none;'>";
    echo "<h4>Total Checkins:</h4>";
    echo "<br/>";
    echo "<br/>";
    echo "<div>";
    echo "<br/>";
    echo "<br/>";

    //Print out the total groups by count, regardless of the hour or date...
    //Loop through the counts of groups, regardless of date or time.
    $totalNumberOfChecksByGroup = NULL;
    $TotalInitialBeds = NULL;
    foreach ($result as $myresult) {
        if(empty($myresult['residence_campus_area']))
        {
            echo "blanks";
        }
        echo "<br/>";
        echo "<span style='font-weight:bold;'>".$myresult['residence_campus_area']."</span>";
        echo "<br/>";
        echo "<span style='float:right;'>";
        //Add to my total....
        $totalNumberOfChecksByGroup += $myresult['count(residence_campus_area)'];

        echo $myresult['count(residence_campus_area)'];
        echo "</span>";
    }
    echo "<br/>";
    echo "<br/>";
    echo "Total Checkins: <span id='totalCheckInNumbers'>$totalNumberOfChecksByGroup</span>";
    echo "</div>";
    //End Looping through the Grouping of Counts
    /**
     * End number of groups.
     **/

    /**
     *  CUSTOM DATES
     */
    //Option #1 - Custom Dates
    if($dateNEEDED=="custom"){
        //Get Begin Date
        $beginDATENEEDED =$_POST['beginningDateNeededCustom'];

        //Get End Date
        $endDATENEEDED = $_POST['endingDateNeededCustom'];


        //add javascript and show the current beginning date and ending date.
        echo "<script type='text/javascript'>";
        //Provide the end user with the beginning date in the #dateBeginNotify span.
        echo "$('#dateBeginNotify').html('&nbsp; <strong>".$beginDATENEEDED."</strong>');";

        //Provide the end user with the beginning date in the #dateEndNotify span.
        echo "$('#dateEndNotifyUser').html('&nbsp;&nbsp; <strong>".$endDATENEEDED."</strong>');";

        echo "</script>";
        //end javascript



        //START
        //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
        include('completeTOTALS.php');
        //END

        //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
        foreach ($residenceHALLSANDAPARTMENTS as $residenceNAME){
            //Set Residence Hall
            $group1_RESIDENCE->setResidenceHall($residenceNAME);

            //Set Date Range Needed All Dates
            //Check endcell_for_date_range.php for the 2 bound variables

            $group1_RESIDENCE->setDateNeededRange($beginDATENEEDED, $endDATENEEDED);

            //Specify the residence that we need and assign to "residence" variable.
            $residence = $group1_RESIDENCE->getResidenceHall();

            //Specify the date that we need and assign to a "date_needed" variable.
            $date_needed = $group1_RESIDENCE->getDateNeeded();


            //Residence Location!!!
            echo "<tr>";
            echo "<td>";
            //By clicking on the link for residence hall, they will get a break down for sub areas
            //Avent Ferry will break down to AFC-A, AFC-B,AFC-C, etc.

            if($residence==="Avent Ferry")
            {
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
            }
            else if($residence==="Wood Hall"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
            }
            else if($residence==="Wolf Village"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
            }
            else if($residence==="Wolf Ridge"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
            }
            else{
                echo $residence;
            }
            //echo $residence;
            echo "</td>";

            //Provide bed numbers for building
            echo "<td id='initial_bed_number' class='bed_information'>";
            echo $initial_bed_count[$residenceNAME];
            echo "</td>";

            //Late at night check-ins
            //Start at 00 and go to 00:59:59 //last minute, second for midnight.
            for($x=0;$x<1;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";
                $endTIME="00:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');
                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }

            //01:00:00 am to 01:59:59 am
            //Start at 1 and at 2:00
            for($x=1;$x<2;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";
                //Send end time at 01:59:59
                $endTIME="01:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 01:00:00 am to 01:59:59 am

            //02:00:00 am to 02:59:59 am
            //Start at 2 and at 3:00
            for($x=2;$x<3;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00:00";

                //Send end time at 02:59:59
                $endTIME="02:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 02:00:00 am to 02:59:59 am

            //03:00:00 am to 03:59:59 am
            //Start at 3 and at 4:00
            for($x=3;$x<4;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 02:59:59
                $endTIME="03:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 03:00:00 am to 03:59:59 am

            //04:00:00 am to 04:59:59 am
            //Start at 4 and at 5
            for($x=4;$x<5;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 02:59:59
                $endTIME="04:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 04:00:00 am to 04:59:59 am

            //05:00:00 am to 05:59:59 am
            //Start at 5 and at 6
            for($x=5;$x<6;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 05:59:59
                $endTIME="05:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 05:00:00 am to 05:59:59 am

            //06:00:00 am to 06:59:59 am
            //Start at 6 and at 7
            for($x=6;$x<7;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 05:59:59
                $endTIME="06:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 06:00:00 am to 06:59:59 am

            //07:00:00 am to 07:59:59 am
            //Start at 7 and at 8
            for($x=7;$x<8;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="07:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 07:00:00 am to 07:59:59 am


            //END early morning break down...



            //Start at 8 and go to 9
            for($x=8;$x<17;$x++){
                //Set initial beginTIME;
                $beginTIME="0".$x.":00";

                //Set conditions if the first digit (e.g. 10, 12, 13 ,etc) exists.
                //If it's 08 (08:00 am); then we're going to need to add a 0.
                if($x<9){
                    $endTIME="0".($beginTIME+1).":00";
                }

                if($x==9){
                    $endTIME=($beginTIME+1).":00";
                }

                //Otherwise, we can do 10, 11, 12, 13 (1:00), 14 (2:00), 15 (3:00), etc.
                if($x>9){
                    //Correct Begin Time.
                    $beginTIME=$x.":00";
                    $endTIME=($beginTIME+1).":00";
                }

                //Start the beginning of the cell.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);

                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }


            //05:00:00 pm to 07:59:59 am
            //Start at 17and at 18
            for($x=17;$x<18;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="17:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 05:00:00 pm to 05:59:59 pm

            //06:00:00 pm to 06:59:59 am
            //Start at 18and at 19
            for($x=18;$x<19;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 05:59:59
                $endTIME="18:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 06:00:00 pm to 06:59:59 pm

            //07:00:00 pm to 07:59:59 am
            //Start at 19and at 20
            for($x=19;$x<20;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="19:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 07:00:00 pm to 07:59:59 pm

            //08:00:00 pm to 08:59:59 am
            //Start at 20and at 21
            for($x=20;$x<21;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="20:59:59";
                //$endTIME="0".($beginTIME+1).":00";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 08:00:00 pm to 08:59:59 pm
            //09:00:00 pm to 09:59:59 am
            //Start at 21 and at 22
            for($x=21;$x<22;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="21:59:59";
                //$endTIME="0".($beginTIME+1).":00";

                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 09:00:00 pm to 09:59:59 pm

            //10:00:00 pm to 10:59:59 am
            //Start at 22 and at 23
            for($x=22;$x<23;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="22:59:59";
                //$endTIME="0".($beginTIME+1).":00";

                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 10:00:00 pm to 10:59:59 pm

            //11:00:00 pm to 11:59:59 am
            //Start at 23 and at 24
            for($x=23;$x<24;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 11:59:59
                $endTIME="23:59:59";
                //$endTIME="0".($beginTIME+1).":00";

                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 11:00:00 pm to 11:59:59 pm



            //GET TOTALS!!!!
            //June 12 2015 -- also provide a new report that allows a clickable total amount.
            include('begincell.php');
            //echo $totalResults;

            //Provide link that will display a new report once clicked that will show the total
            //amount of people for a specified residence hall or apartment.

            //echo $totalResults;
            //We will want ALL check-ins for a specific building.
            //Parameters needed
            //residence=___________________________ [Building parameter should already be housed in the $residence variable ]
            //beginTIME=___________________________ [Since it's the beginning of the day, should start at 0]
            //endTIME=_____________________________ [Since it's the end of the day, it should end at 24]
            //dateNEEDEDSTART = ___________________ [These can be custom dates in the format XXXX-XX-XX YYYY-MM-DD]
            //dateNEEDEDEND = _____________________ [This can be a custom date in the format XXXX-XX-XX YYYY-MM-DD]

            //Specifically setting both the begging time to the beginning of the day.
            $timeBEGINforReport=0;              //0 will be 0:00 i.e. the very beginning of the day.
            //Specifically setting the ending time for the end of the day.
            $timeENDforReport=24;               //24 will be 24:00 i.e. midnight
            echo "<a href='report_for_specific_area_totals.php?residence=".$residence."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&&endTIME=".$timeENDforReport."' target='_blank')'>$totalResults</a>";
            echo"</td>";

            //Add to our total Results array for usuage in the Chart.
            //Currently displayed results will be stored in the array called
            //$totalResultsGrouping[]
            $totalResultsGrouping[$residenceNAME]= $totalResults;

            //Create a variable that will hold the amount left.
            $amount_left= ($initial_bed_count[$residenceNAME]-$totalResults);

            //Create a variable that will hold the percentage use for the occupancy for the building.
            $percentage_occupied_temp=($amount_left/$initial_bed_count[$residenceNAME]);

            //Format the number (above, percentage_occupied_temp) to a percentage so it's easily read, and format
            //it to 1 decimal point.
            $percentage_occupied = number_format($percentage_occupied_temp*100,1)."%";

            //Display the information in the next table cell.
            echo "<td class='bed_information' id='amount_of_beds_left'>";
            echo $amount_left;
            echo "</td>";

            //Display the information in the next adjacent cell.
            //Display the percentages of occupancy here.
            echo "<td class='bed_information'>";
            echo number_format((100-$percentage_occupied),2)."%";
            echo "</td>";

            //Clear total Results for a New Row.
            $totalResults=0;
            //Close Data Row
            echo "</tr>";
        }//close for each

        //Totals
        $timeTOTALS=array(1);
        echo "<td style='background-color:#CACACA; font-weight:bold;'>";
        echo "Totals";
        echo "</td>";

        //Subtotal of the "beginning beds" section.
        //This will be initially HIDDEN
        echo "<td class='bed_information' id='total_initial_bed_allotment' style='background-color:#CACACA; font-weight:bold;'>";
        echo "</td>";


        //Now have 26 columns.
        for($x=0;$x<25;$x++){
            echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
            echo "&nbsp;";
            echo "</td>";
        }
        echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";
        //echo "this is a test - total";
        echo "test";
        echo "</td>";

        //Percentage
        echo "<td class='bed_information' id='remaining_bed_percentage' style='background-color:#CACACA; font-weight:bold;'>";

        echo "&nbsp;";
        echo "</td>";


    }//End CustomDates

    /**
     *  ALL DATES
     */
    //Option #2
    //Dates Hard Coded for July 11 2016 (Monday) through August 15 2016 (The first Monday after check in is over.).
    if($dateNEEDED=="allDATES"){
        //Get Begin Date
        $beginDATENEEDED ="2016-07-11";

        //Get End Date
        $endDATENEEDED = "2016-08-15";

        //add javascript and show the current beginning date and ending date.
        echo "<script type='text/javascript'>";
        //Provide the end user with the beginning date in the #dateBeginNotify span.
        echo "$('#dateBeginNotify').html('&nbsp; <strong>".$beginDATENEEDED."</strong>');";
        //Provide the end user with the beginning date in the #dateEndNotify span.
        echo "$('#dateEndNotifyUser').html('&nbsp;&nbsp; <strong>".$endDATENEEDED."</strong>');";
        echo "</script>";
        //end javascript



        //START
        //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
        include('completeTOTALS.php');
        //END

        //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
        foreach ($residenceHALLSANDAPARTMENTS as $residenceNAME){
            //Set Residence Hall
            $group1_RESIDENCE->setResidenceHall($residenceNAME);

            //Set Date Range Needed All Dates
            //Check endcell_for_date_range.php for the 2 bound variables

            $group1_RESIDENCE->setDateNeededRange($beginDATENEEDED, $endDATENEEDED);

            //Specify the residence that we need and assign to "residence" variable.
            $residence = $group1_RESIDENCE->getResidenceHall();

            //Specify the date that we need and assign to a "date_needed" variable.
            $date_needed = $group1_RESIDENCE->getDateNeeded();


            //Residence Location!!!
            echo "<tr>";
            echo "<td>";
            //By clicking on the link for residence hall, they will get a break down for sub areas
            //Avent Ferry will break down to AFC-A, AFC-B,AFC-C, etc.

            if($residence==="Avent Ferry")
            {
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
            }
            else if($residence==="Wood Hall"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
            }
            else if($residence==="Wolf Village"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
            }
            else if($residence==="Wolf Ridge"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
            }
            else{
                echo $residence;
            }
            //echo $residence;
            echo "</td>";

            //Provide bed numbers for building
            echo "<td id='initial_bed_number' class='bed_information'>";
            echo $initial_bed_count[$residenceNAME];
            echo "</td>";

            //Late at night check-ins
            //Start at 00 and go to 00:59:59 //last minute, second for midnight.
            for($x=0;$x<1;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":01:00";
                $endTIME="00:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');
                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }

            //01:00:00 am to 01:59:59 am
            //Start at 1 and at 2:00
            for($x=1;$x<2;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 01:59:59
                $endTIME="01:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 01:00:00 am to 01:59:59 am

            //02:00:00 am to 02:59:59 am
            //Start at 2 and at 3:00
            for($x=2;$x<3;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00:00";

                //Send end time at 02:59:59
                $endTIME="02:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 02:00:00 am to 02:59:59 am

            //03:00:00 am to 03:59:59 am
            //Start at 3 and at 4:00
            for($x=3;$x<4;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 02:59:59
                $endTIME="03:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 03:00:00 am to 03:59:59 am

            //04:00:00 am to 04:59:59 am
            //Start at 4 and at 5
            for($x=4;$x<5;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 02:59:59
                $endTIME="04:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 04:00:00 am to 04:59:59 am

            //05:00:00 am to 05:59:59 am
            //Start at 5 and at 6
            for($x=5;$x<6;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 05:59:59
                $endTIME="05:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 05:00:00 am to 05:59:59 am

            //06:00:00 am to 06:59:59 am
            //Start at 6 and at 7
            for($x=6;$x<7;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 05:59:59
                $endTIME="06:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 06:00:00 am to 06:59:59 am

            //07:00:00 am to 07:59:59 am
            //Start at 7 and at 8
            for($x=7;$x<8;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="07:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 07:00:00 am to 07:59:59 am


            //END early morning break down...



            //Start at 8 and go to 9
            for($x=8;$x<17;$x++){
                //Set initial beginTIME;
                $beginTIME="0".$x.":00";

                //Set conditions if the first digit (e.g. 10, 12, 13 ,etc) exists.
                //If it's 08 (08:00 am); then we're going to need to add a 0.
                if($x<9){
                    $endTIME="0".($beginTIME+1).":00";
                }

                if($x==9){
                    $endTIME=($beginTIME+1).":00";
                }

                //Otherwise, we can do 10, 11, 12, 13 (1:00), 14 (2:00), 15 (3:00), etc.
                if($x>9){
                    //Correct Begin Time.
                    $beginTIME=$x.":00";
                    $endTIME=($beginTIME+1).":00";
                }

                //Start the beginning of the cell.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);

                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }

            /*
            UNTOUCHED
            //From 5:01pm until 12:00am
            //Late at night check-ins
            for($x=17;$x<18;$x++){
                //Set initial beginTIME.
                $beginTIME="17:01";
                $endTIME="24:00";
                //Start the beginning of the cell.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);

                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 5:01pm until 12:00am*/


            //05:00:00 pm to 07:59:59 am
            //Start at 17and at 18
            for($x=17;$x<18;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="17:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 05:00:00 pm to 05:59:59 pm

            //06:00:00 pm to 06:59:59 am
            //Start at 18and at 19
            for($x=18;$x<19;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 05:59:59
                $endTIME="18:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 06:00:00 pm to 06:59:59 pm

            //07:00:00 pm to 07:59:59 am
            //Start at 19and at 20
            for($x=19;$x<20;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="19:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 07:00:00 pm to 07:59:59 pm

            //08:00:00 pm to 08:59:59 am
            //Start at 20and at 21
            for($x=20;$x<21;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="20:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 08:00:00 pm to 08:59:59 pm
            //09:00:00 pm to 09:59:59 am
            //Start at 21 and at 22
            for($x=21;$x<22;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="21:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 09:00:00 pm to 09:59:59 pm

            //10:00:00 pm to 10:59:59 am
            //Start at 22 and at 23
            for($x=22;$x<23;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="22:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 10:00:00 pm to 10:59:59 pm

            //11:00:00 pm to 11:59:59 am
            //Start at 23 and at 24
            for($x=23;$x<24;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 11:59:59
                $endTIME="23:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 11:00:00 pm to 11:59:59 pm


            //Get totals
            //June 12 2015 -- also provide a new report that allows a clickable total amount.
            include('begincell.php');
            //echo $totalResults;

            //Provide link that will display a new report once clicked that will show the total
            //amount of people for a specified residence hall or apartment.

            //echo $totalResults;
            //We will want ALL check-ins for a specific building.
            //Parameters needed
            //residence=___________________________ [Building parameter should already be housed in the $residence variable ]
            //beginTIME=___________________________ [Since it's the beginning of the day, should start at 0]
            //endTIME=_____________________________ [Since it's the end of the day, it should end at 24]
            //dateNEEDEDSTART = ___________________ [These can be custom dates in the format XXXX-XX-XX YYYY-MM-DD]
            //dateNEEDEDEND = _____________________ [This can be a custom date in the format XXXX-XX-XX YYYY-MM-DD]

            //Specifically setting both the begging time to the beginning of the day.
            $timeBEGINforReport=0;              //0 will be 0:00 i.e. the very beginning of the day.
            //Specifically setting the ending time for the end of the day.
            $timeENDforReport=24;               //24 will be 24:00 i.e. midnight

            echo "<a href='report_for_specific_area_totals.php?residence=".$residence."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&&endTIME=".$timeENDforReport."' target='_blank')'>$totalResults</a>";

            echo"</td>";

            //Add to our total Results array for usuage in the Chart.
            //Currently displayed results will be stored in the array called
            //$totalResultsGrouping[]
            $totalResultsGrouping[$residenceNAME]= $totalResults;

            //Create a variable that will hold the amount left.
            $amount_left= ($initial_bed_count[$residenceNAME]-$totalResults);

            //Create a variable that will hold the percentage use for the occupancy for the building.
            $percentage_occupied_temp=($amount_left/$initial_bed_count[$residenceNAME]);

            //Format the number (above, percentage_occupied_temp) to a percentage so it's easily read, and format
            //it to 1 decimal point.
            $percentage_occupied = number_format($percentage_occupied_temp*100,1)."%";

            //Display the information in the next table cell.
            echo "<td class='bed_information' id='amount_of_beds_left'>";
            echo $amount_left;
            echo "</td>";

            //Display the information in the next adjacent cell.
            //Display the percentages of occupancy here.
            echo "<td class='bed_information'>";
            echo number_format((100-$percentage_occupied),2)."%";
            echo "</td>";

            //Clear total Results for a New Row.
            $totalResults=0;
            //Close Data Row
            echo "</tr>";
        }//close for each

        //Totals
        $timeTOTALS=array(1);
        echo "<td style='background-color:#CACACA; font-weight:bold;'>";
        echo "Totals";
        echo "</td>";

        //Subtotal of the "beginning beds" section.
        //This will be initially HIDDEN
        echo "<td class='bed_information' id='total_initial_bed_allotment' style='background-color:#CACACA; font-weight:bold;'>";
        echo "</td>";

        //Now have 26 columns.
        for($x=0;$x<25;$x++){
            echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
            echo "&nbsp;";
            echo "</td>";
        }
        echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";

        echo "</td>";

        //Percentage
        echo "<td class='bed_information' id='remaining_bed_percentage' style='background-color:#CACACA; font-weight:bold;'>";

        echo "&nbsp;";
        echo "</td>";

    }//End DateNeeded "All Dates"

    /**
     *  SPECIFIC DATE
     */
    //Option #3, specific day needed to list information.
    //If I need anything than all the dates then create something specfic just for an individual time period.
    if($dateNEEDED!=="allDATES" && $dateNEEDED!=="custom"){
        //Get Begin Date
        $beginDATENEEDED =$_POST['beginningDateNeededCustom'];
        //Get End Date
        $endDATENEEDED = $_POST['endingDateNeededCustom'];

        //add javascript and show the current beginning date and ending date.
        echo "<script type='text/javascript'>";
        //Provide the end user with the beginning date in the #dateBeginNotify span.
        echo "$('#dateBeginNotify').html('&nbsp; <strong>".$beginDATENEEDED."</strong>');";
        //Provide the end user with the beginning date in the #dateEndNotify span.
        echo "$('#dateEndNotifyUser').html('&nbsp;&nbsp; <strong>".$endDATENEEDED."</strong>');";
        echo "</script>";
        //end javascript


        //START
        //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
        include('completeTOTALS.php');
        //END

        //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
        foreach ($residenceHALLSANDAPARTMENTS as $residenceNAME){
            //Set Residence Hall
            $group1_RESIDENCE->setResidenceHall($residenceNAME);

            //Set Date Range Needed All Dates
            //Check endcell_for_date_range.php for the 2 bound variables

            $group1_RESIDENCE->setDateNeededRange($beginDATENEEDED, $endDATENEEDED);

            //Specify the residence that we need and assign to "residence" variable.
            $residence = $group1_RESIDENCE->getResidenceHall();

            //Specify the date that we need and assign to a "date_needed" variable.
            $date_needed = $group1_RESIDENCE->getDateNeeded();


            //Residence Location!!!
            echo "<tr>";
            echo "<td>";
            //By clicking on the link for residence hall, they will get a break down for sub areas
            //Avent Ferry will break down to AFC-A, AFC-B,AFC-C, etc.

            if($residence==="Avent Ferry")
            {
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
            }
            else if($residence==="Wood Hall"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
            }
            else if($residence==="Wolf Village"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
            }
            else if($residence==="Wolf Ridge"){
                echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge&dateBegin=".$beginDATENEEDED."&dateEnd=".$endDATENEEDED."' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
            }
            else{
                echo $residence;
            }
            //echo $residence;
            echo "</td>";

            //Provide bed numbers for building
            echo "<td id='initial_bed_number' class='bed_information'>";
            echo $initial_bed_count[$residenceNAME];
            echo "</td>";

            //Late at night check-ins
            //Start at 00 and go to 00:59:59 //last minute, second for midnight.
            for($x=0;$x<1;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":01:00";
                $endTIME="00:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');
                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }

            //01:00:00 am to 01:59:59 am
            //Start at 1 and at 2:00
            for($x=1;$x<2;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 01:59:59
                $endTIME="01:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 01:00:00 am to 01:59:59 am

            //02:00:00 am to 02:59:59 am
            //Start at 2 and at 3:00
            for($x=2;$x<3;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00:00";

                //Send end time at 02:59:59
                $endTIME="02:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 02:00:00 am to 02:59:59 am

            //03:00:00 am to 03:59:59 am
            //Start at 3 and at 4:00
            for($x=3;$x<4;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 02:59:59
                $endTIME="03:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 03:00:00 am to 03:59:59 am

            //04:00:00 am to 04:59:59 am
            //Start at 4 and at 5
            for($x=4;$x<5;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 02:59:59
                $endTIME="04:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 04:00:00 am to 04:59:59 am

            //05:00:00 am to 05:59:59 am
            //Start at 5 and at 6
            for($x=5;$x<6;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 05:59:59
                $endTIME="05:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 05:00:00 am to 05:59:59 am

            //06:00:00 am to 06:59:59 am
            //Start at 6 and at 7
            for($x=6;$x<7;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00";

                //Send end time at 05:59:59
                $endTIME="06:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 06:00:00 am to 06:59:59 am

            //07:00:00 am to 07:59:59 am
            //Start at 7 and at 8
            for($x=7;$x<8;$x++){
                //Set initial beginTIME.
                $beginTIME="0".$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="07:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 07:00:00 am to 07:59:59 am
            //END early morning break down...



            //Start at 8 and go to 9
            for($x=8;$x<17;$x++){
                //Set initial beginTIME;
                $beginTIME="0".$x.":00";

                //Set conditions if the first digit (e.g. 10, 12, 13 ,etc) exists.
                //If it's 08 (08:00 am); then we're going to need to add a 0.
                if($x<9){
                    $endTIME="0".($beginTIME+1).":00";
                }

                if($x==9){
                    $endTIME=($beginTIME+1).":00";
                }

                //Otherwise, we can do 10, 11, 12, 13 (1:00), 14 (2:00), 15 (3:00), etc.
                if($x>9){
                    //Correct Begin Time.
                    $beginTIME=$x.":00";
                    $endTIME=($beginTIME+1).":00";
                }

                //Start the beginning of the cell.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);

                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //05:00:00 pm to 07:59:59 am
            //Start at 17and at 18
            for($x=17;$x<18;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="17:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 05:00:00 pm to 05:59:59 pm

            //06:00:00 pm to 06:59:59 am
            //Start at 18and at 19
            for($x=18;$x<19;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 05:59:59
                $endTIME="18:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 06:00:00 pm to 06:59:59 pm

            //07:00:00 pm to 07:59:59 am
            //Start at 19and at 20
            for($x=19;$x<20;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="19:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 07:00:00 pm to 07:59:59 pm

            //08:00:00 pm to 08:59:59 am
            //Start at 20and at 21
            for($x=20;$x<21;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="20:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 08:00:00 pm to 08:59:59 pm
            //09:00:00 pm to 09:59:59 am
            //Start at 21 and at 22
            for($x=21;$x<22;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="21:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 09:00:00 pm to 09:59:59 pm

            //10:00:00 pm to 10:59:59 am
            //Start at 22 and at 23
            for($x=22;$x<23;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 07:59:59
                $endTIME="22:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 10:00:00 pm to 10:59:59 pm

            //11:00:00 pm to 11:59:59 am
            //Start at 23 and at 24
            for($x=23;$x<24;$x++){
                //Set initial beginTIME.
                $beginTIME=$x.":00:00";

                //Send end time at 11:59:59
                $endTIME="23:59:59";
                //Start the beginning of the cell.
                //Also provides the class which is used in /js/provideROWTotals.js
                //that gives us the total amount of links on the bottom of the row.
                include('begincell.php');

                //Set Times for this Location.
                $group1_RESIDENCE->setBeginTime($beginTIME);
                $group1_RESIDENCE->setEndTime($endTIME);
                //Close the cell off
                include('endcells/endcell_for_date_range.php');
            }
            //End 11:00:00 pm to 11:59:59 pm

            //Get totals
            //June 12 2015 -- also provide a new report that allows a clickable total amount.
            include('begincell.php');
            //echo $totalResults;

            //Provide link that will display a new report once clicked that will show the total
            //amount of people for a specified residence hall or apartment.

            //echo $totalResults;
            //We will want ALL check-ins for a specific building.
            //Parameters needed
            //residence=___________________________ [Building parameter should already be housed in the $residence variable ]
            //beginTIME=___________________________ [Since it's the beginning of the day, should start at 0]
            //endTIME=_____________________________ [Since it's the end of the day, it should end at 24]
            //dateNEEDEDSTART = ___________________ [These can be custom dates in the format XXXX-XX-XX YYYY-MM-DD]
            //dateNEEDEDEND = _____________________ [This can be a custom date in the format XXXX-XX-XX YYYY-MM-DD]

            //Specifically setting both the begging time to the beginning of the day.
            $timeBEGINforReport=0;              //0 will be 0:00 i.e. the very beginning of the day.
            //Specifically setting the ending time for the end of the day.
            $timeENDforReport=24;               //24 will be 24:00 i.e. midnight

            echo "<a href='report_for_specific_area_totals.php?residence=".$residence."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&&endTIME=".$timeENDforReport."' target='_blank')'>$totalResults</a>";

            echo"</td>";

            //Add to our total Results array for usuage in the Chart.
            //Currently displayed results will be stored in the array called
            //$totalResultsGrouping[]
            $totalResultsGrouping[$residenceNAME]= $totalResults;

            //Create a variable that will hold the amount left.
            $amount_left= ($initial_bed_count[$residenceNAME]-$totalResults);

            //Create a variable that will hold the percentage use for the occupancy for the building.
            $percentage_occupied_temp=($amount_left/$initial_bed_count[$residenceNAME]);

            //Format the number (above, percentage_occupied_temp) to a percentage so it's easily read, and format
            //it to 1 decimal point.
            $percentage_occupied = number_format($percentage_occupied_temp*100,1)."%";

            //Display the information in the next table cell.
            echo "<td class='bed_information' id='amount_of_beds_left'>";
            echo $amount_left;
            echo "</td>";

            //Display the information in the next adjacent cell.
            //Display the percentages of occupancy here.
            echo "<td class='bed_information'>";
            echo number_format((100-$percentage_occupied),2)."%";
            echo "</td>";

            //Clear total Results for a New Row.
            $totalResults=0;
            //Close Data Row
            echo "</tr>";
        }//close for each

        //Totals
        $timeTOTALS=array(1);
        echo "<td style='background-color:#CACACA; font-weight:bold;'>";
        echo "Totals";
        echo "</td>";

        //Subtotal of the "beginning beds" section.
        //This will be initially HIDDEN
        echo "<td class='bed_information' id='total_initial_bed_allotment' style='background-color:#CACACA; font-weight:bold;'>";
        echo "</td>";

        //This section here provides totals at the bottom of the row.
        //Untouched
        /*for($x=0;$x<12;$x++){
                echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
                echo "&nbsp;";
                echo "</td>";
        }*/

        //Now have 26 columns.
        for($x=0;$x<25;$x++){
            echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
            echo "&nbsp;";
            echo "</td>";
        }
        echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";
        //echo "this is a test - total";
        echo "test";
        echo "</td>";

        //Percentage
        echo "<td class='bed_information' id='remaining_bed_percentage' style='background-color:#CACACA; font-weight:bold;'>";

        echo "&nbsp;";
        echo "</td>";

    }//End DateNeeded NOT FOR "All Dates", but a specific time period.
    ?>
    </tbody>
    <?php
    //Close PDO connection
    $conn = null;
    ?>
    </tbody>
</table>
<br/>
<br/>
<span style='font-weight:bold;'>*Note: Beginning Beds include RA beds.</span>
<br/>
<br/>
<!--Comment out Charts as they're not needed-->
<!--Removed Charts for 2016 as barely used-->
<!--
<p>Chart Options <br/>
Showing the Week of August 10 - August 16, 2015</p>

<div id ="reportOptions">
    <p>
        Which chart would you like to view? <br/>
        <select id="chart_options" name="chart_options">
            <option value="residencehalls">Residence Halls & Apartments</option>
            <option value="campusarea">Campus Area</option>
        </select>
        <br/>
        <br/>
        <input type='button' id='displayChart' value='Display Area Chart'><input type='button' id='hideChart' value='Hide Area Chart'>
    </p>
</div>
<div id='overview_of_results'>
    <p>
         Overview of the Day-to-Day Check in: <br/>
         <br/>
         Weekly Overview <br/>
        Monday, August 10 - Sunday August 16
     </p>
     <div id="chart_div" style="width: 900px; height: 500px;"></div>
</div>-->

</body>
<!--Hide the values for the custom dates-->
<script type="text/javascript">
    // A $( document ).ready() block.
    $( document ).ready(function() {
        //Initially hide the options of doing a custom date option.
        $("#customDatesWanted").hide();

        $('input[type="checkbox"]').change(function(){
            if($(this).prop("checked") == true){
                $("#customDatesWanted").show();
                //Use a date picker the beginning date
                $( "#customBeginDate" ).datepicker({
                    dateFormat: "yy-mm-dd"
                });
                //Use a date picker for the ending date
                $( "#customEndDate" ).datepicker({
                    dateFormat: "yy-mm-dd"

                });
            }
            else if($(this).prop("checked") == false){
                $("#customDatesWanted").hide();
            }
        });
    });
</script>
<!--End hide the textbox values to allow a custom date -->



<!--Provide totals for end row at the bottom-->
<!--On 06 12 2015, using external JS file-->
<script src="js/provideROWTotals.js"></script>

<!--Provide a Google Graphic showing the changes-->
<script type='text/javascript'>
    google.load("visualization", "1", {packages:["corechart"]});
    //google.setOnLoadCallback(drawChart);


    $( "#displayChart" ).click(function() {
        if($('#chart_options').val()==="residencehalls"){
            google.setOnLoadCallback(drawChartforResidenceHallandApt());
        }
        else{
            google.setOnLoadCallback(drawChartforCentralCampus());
        }
    });


    //Encode the PHP Array to json array.
    //Monday
    //var mon= <?php echo json_encode($totalResultsGrouping); ?>;
    var mon = <?php echo json_encode($mondayCountsFilled); ?>
    //Tuesday
    var tues=<?php echo json_encode($tuesdayCountsFilled);?>;
    //Wednesday
    var wed=<?php echo json_encode($wednesdayCountsFilled);?>;
    //Thursday
    var thurs=<?php echo json_encode($thursdayCountsFilled); ?>;
    //Friday
    var fri=<?php echo json_encode($fridayCountsFilled); ?>;
    //Saturday
    var sat=<?php echo json_encode($saturdayCountsFilled); ?>;
    //Sunday
    var sun=<?php echo json_encode($sundayCountsFilled);  ?>;

    //var completeTOTAL= <?php echo json_encode($totalResultsFORALL); ?>;
    var countFORMONDAY = <?php echo $countFORMONDAY; ?>;
    var countFORTUESDAY = <?php echo $countFORTUESDAY; ?>;
    var countFORWEDNESDAY = <?php echo $countFORWEDNESDAY;?>;
    var countFORTHURSDAY = <?php echo $countFORTHURSDAY; ?>;
    var countFORFRIDAY = <?php echo $countFORFRIDAY; ?>;
    var countFORSATURDAY= <?php echo $countFORSATURDAY; ?>;
    var countFORSUNDAY=<?php echo $countFORSUNDAY; ?>;


    /*GROUPS OF RESIDENCE HALLS*/
    /*MONDAY*/
    mon["RESIDENCE_HALLS"]=(mon["Alexander Hall"]+mon["Avent Ferry"]+mon["Bagwell Hall"]+mon["Becton Hall"]+mon["Berry Hall"]+mon["Bowen Hall"]+mon["Bragaw Hall"]+mon["Carroll Hall"]+mon["Gold Hall"]+mon["Lee Hall"]+mon["Metcalf Hall"]+mon["North Hall"]+mon["Owen Hall"]+mon["Sullivan Hall"]+mon["Syme Hall"]+mon["Tucker Hall"]+mon["Turlington Hall"]+mon["Watauga Hall"]+mon["Welch Hall"]+mon["Wood Hall"]);
    /*TUESDAY*/
    tues["RESIDENCE_HALLS"]=(tues["Alexander Hall"]+tues["Avent Ferry"]+tues["Bagwell Hall"]+tues["Becton Hall"]+tues["Berry Hall"]+tues["Bowen Hall"]+tues["Bragaw Hall"]+tues["Carroll Hall"]+tues["Gold Hall"]+tues["Lee Hall"]+tues["Metcalf Hall"]+tues["North Hall"]+tues["Owen Hall"]+tues["Sullivan Hall"]+tues["Syme Hall"]+tues["Tucker Hall"]+tues["Turlington Hall"]+tues["Watauga Hall"]+tues["Welch Hall"]+tues["Wood Hall"]);
    /*WEDNESDAY*/
    wed["RESIDENCE_HALLS"]=(wed["Alexander Hall"]+wed["Avent Ferry"]+wed["Bagwell Hall"]+wed["Becton Hall"]+wed["Berry Hall"]+wed["Bowen Hall"]+wed["Bragaw Hall"]+wed["Carroll Hall"]+wed["Gold Hall"]+wed["Lee Hall"]+wed["Metcalf Hall"]+wed["North Hall"]+wed["Owen Hall"]+wed["Sullivan Hall"]+wed["Syme Hall"]+wed["Tucker Hall"]+wed["Turlington Hall"]+wed["Watauga Hall"]+wed["Welch Hall"]+wed["Wood Hall"]);
    /*THURSDAY*/
    thurs["RESIDENCE_HALLS"]=(thurs["Alexander Hall"]+thurs["Avent Ferry"]+thurs["Bagwell Hall"]+thurs["Becton Hall"]+thurs["Berry Hall"]+thurs["Bowen Hall"]+thurs["Bragaw Hall"]+thurs["Carroll Hall"]+thurs["Gold Hall"]+thurs["Lee Hall"]+thurs["Metcalf Hall"]+thurs["North Hall"]+thurs["Owen Hall"]+thurs["Sullivan Hall"]+thurs["Syme Hall"]+thurs["Tucker Hall"]+thurs["Turlington Hall"]+thurs["Watauga Hall"]+thurs["Welch Hall"]+thurs["Wood Hall"]);
    /*FRIDAY*/
    fri["RESIDENCE_HALLS"]=(fri["Alexander Hall"]+fri["Avent Ferry"]+fri["Bagwell Hall"]+fri["Becton Hall"]+fri["Berry Hall"]+fri["Bowen Hall"]+fri["Bragaw Hall"]+fri["Carroll Hall"]+fri["Gold Hall"]+fri["Lee Hall"]+fri["Metcalf Hall"]+fri["North Hall"]+fri["Owen Hall"]+fri["Sullivan Hall"]+fri["Syme Hall"]+fri["Tucker Hall"]+fri["Turlington Hall"]+fri["Watauga Hall"]+fri["Welch Hall"]+fri["Wood Hall"]);
    /*SATURDAY*/
    sat["RESIDENCE_HALLS"]=(sat["Alexander Hall"]+sat["Avent Ferry"]+sat["Bagwell Hall"]+sat["Becton Hall"]+sat["Berry Hall"]+sat["Bowen Hall"]+sat["Bragaw Hall"]+sat["Carroll Hall"]+sat["Gold Hall"]+sat["Lee Hall"]+sat["Metcalf Hall"]+sat["North Hall"]+sat["Owen Hall"]+sat["Sullivan Hall"]+sat["Syme Hall"]+sat["Tucker Hall"]+sat["Turlington Hall"]+sat["Watauga Hall"]+sat["Welch Hall"]+sat["Wood Hall"]);
    /*SUNDAY*/
    sun["RESIDENCE_HALLS"]=(sun["Alexander Hall"]+sun["Avent Ferry"]+sun["Bagwell Hall"]+sun["Becton Hall"]+sun["Berry Hall"]+sun["Bowen Hall"]+sun["Bragaw Hall"]+sun["Carroll Hall"]+sun["Gold Hall"]+sun["Lee Hall"]+sun["Metcalf Hall"]+sun["North Hall"]+sun["Owen Hall"]+sun["Sullivan Hall"]+sun["Syme Hall"]+sun["Tucker Hall"]+sun["Turlington Hall"]+sun["Watauga Hall"]+sun["Welch Hall"]+sun["Wood Hall"]);



    /*CENTRAL GROUPS*/
    /*EAST: North, Wat, Syme, Gold, Welch, Ber,Becton,Bagwell,Wood, Avent Ferry Complex*/
    /*CENTRAL: Bowen, Carroll, Metcalf, Tucker, OWen, Turlingotn, Alexander*/
    /*WEST: Bragaw, Lee, Sullivan*/
    /*APT: Wolf Village, Wolf Ridge*/

    /*MONDAY*/
    mon["east"]=(mon["North Hall"]+mon["Watauga Hall"]+mon["Syme Hall"]+mon["Gold Hall"]+mon["Welch Hall"]+mon["Berry Hall"]+mon["Becton Hall"]+mon["Bagwell Hall"]+mon["Wood Hall"]+mon["Avent Ferry"]);
    mon["central"]=(mon["Bowen Hall"]+mon["Carroll Hall"]+mon["Metcalf Hall"]+mon["Tucker Hall"]+mon["Owen Hall"]+mon["Turlington Hall"]+mon["Alexander Hall"]);
    mon["west"]=(mon["Bragaw Hall"]+mon["Lee Hall"]+mon["Sullivan Hall"]);
    mon["apt"]=(mon["Wolf Village"]+mon["Wolf Ridge"]);


    /*TUESDAY*/
    tues["east"]=(tues["North Hall"]+tues["Watauga Hall"]+tues["Syme Hall"]+tues["Gold Hall"]+tues["Welch Hall"]+tues["Berry Hall"]+tues["Becton Hall"]+tues["Bagwell Hall"]+tues["Wood Hall"]+tues["Avent Ferry"]);
    tues["central"]=(tues["Bowen Hall"]+tues["Carroll Hall"]+tues["Metcalf Hall"]+tues["Tucker Hall"]+tues["Owen Hall"]+tues["Turlington Hall"]+tues["Alexander Hall"]);
    tues["west"]=(tues["Bragaw Hall"]+tues["Lee Hall"]+tues["Sullivan Hall"]);
    tues["apt"]=(tues["Wolf Village"]+tues["Wolf Ridge"]);

    /*WEDNESDAY*/
    wed["east"]=(wed["North Hall"]+wed["Watauga Hall"]+wed["Syme Hall"]+wed["Gold Hall"]+wed["Welch Hall"]+wed["Berry Hall"]+wed["Becton Hall"]+wed["Bagwell Hall"]+wed["Wood Hall"]+wed["Avent Ferry"]);
    wed["central"]=(wed["Bowen Hall"]+wed["Carroll Hall"]+wed["Metcalf Hall"]+wed["Tucker Hall"]+wed["Owen Hall"]+wed["Turlington Hall"]+wed["Alexander Hall"]);
    wed["west"]=(wed["Bragaw Hall"]+wed["Lee Hall"]+wed["Sullivan Hall"]);
    wed["apt"]=(wed["Wolf Village"]+wed["Wolf Ridge"]);

    /*THURSDAY*/
    thurs["east"]=(thurs["North Hall"]+thurs["Watauga Hall"]+thurs["Syme Hall"]+thurs["Gold Hall"]+thurs["Welch Hall"]+thurs["Berry Hall"]+thurs["Becton Hall"]+thurs["Bagwell Hall"]+thurs["Wood Hall"]+thurs["Avent Ferry"]);
    thurs["central"]=(thurs["Bowen Hall"]+thurs["Carroll Hall"]+thurs["Metcalf Hall"]+thurs["Tucker Hall"]+thurs["Owen Hall"]+thurs["Turlington Hall"]+thurs["Alexander Hall"]);
    thurs["west"]=(thurs["Bragaw Hall"]+thurs["Lee Hall"]+thurs["Sullivan Hall"]);
    thurs["apt"]=(thurs["Wolf Village"]+thurs["Wolf Ridge"]);

    /*FRIDAY*/
    fri["east"]=(fri["North Hall"]+fri["Watauga Hall"]+fri["Syme Hall"]+fri["Gold Hall"]+fri["Welch Hall"]+fri["Berry Hall"]+fri["Becton Hall"]+fri["Bagwell Hall"]+fri["Wood Hall"]+fri["Avent Ferry"]);
    fri["central"]=(fri["Bowen Hall"]+fri["Carroll Hall"]+fri["Metcalf Hall"]+fri["Tucker Hall"]+fri["Owen Hall"]+fri["Turlington Hall"]+fri["Alexander Hall"]);
    fri["west"]=(fri["Bragaw Hall"]+fri["Lee Hall"]+fri["Sullivan Hall"]);
    fri["apt"]=(fri["Wolf Village"]+fri["Wolf Ridge"]);

    /*SATURDAY*/
    sat["east"]=(sat["North Hall"]+sat["Watauga Hall"]+sat["Syme Hall"]+sat["Gold Hall"]+sat["Welch Hall"]+sat["Berry Hall"]+sat["Becton Hall"]+sat["Bagwell Hall"]+sat["Wood Hall"]+sat["Avent Ferry"]);
    sat["central"]=(sat["Bowen Hall"]+sat["Carroll Hall"]+sat["Metcalf Hall"]+sat["Tucker Hall"]+sat["Owen Hall"]+sat["Turlington Hall"]+sat["Alexander Hall"]);
    sat["west"]=(sat["Bragaw Hall"]+sat["Lee Hall"]+sat["Sullivan Hall"]);
    sat["apt"]=(sat["Wolf Village"]+sat["Wolf Ridge"]);

    /*SUNDAY*/
    sun["east"]=(sun["North Hall"]+sun["Watauga Hall"]+sun["Syme Hall"]+sun["Gold Hall"]+sun["Welch Hall"]+sun["Berry Hall"]+sun["Becton Hall"]+sun["Bagwell Hall"]+sun["Wood Hall"]+sun["Avent Ferry"]);
    sun["central"]=(sun["Bowen Hall"]+sun["Carroll Hall"]+sun["Metcalf Hall"]+sun["Tucker Hall"]+sun["Owen Hall"]+sun["Turlington Hall"]+sun["Alexander Hall"]);
    sun["west"]=(sun["Bragaw Hall"]+sun["Lee Hall"]+sun["Sullivan Hall"]);
    sun["apt"]=(sun["Wolf Village"]+sun["Wolf Ridge"]);

    /*This is a breakdown of Residence Halls Vs Apartments*/

    function drawChartforResidenceHallandApt() {
        var data = google.visualization.arrayToDataTable([
            ['Day', 'Overall CheckIns', 'Residence Halls','Wolf Village','Wolf Ridge'],
            ['Monday',  countFORMONDAY,mon["RESIDENCE_HALLS"],mon["Wolf Village"],mon["Wolf Ridge"], ],
            ['Tuesday',  countFORTUESDAY,tues["RESIDENCE_HALLS"],tues["Wolf Village"],tues["Wolf Ridge"], ],
            ['Wednesday',  countFORWEDNESDAY,wed["RESIDENCE_HALLS"],wed["Wolf Village"],wed["Wolf Ridge"], ],
            ['Thursday',  countFORTHURSDAY,thurs["RESIDENCE_HALLS"],thurs["Wolf Village"],thurs["Wolf Ridge"], ],
            ['Friday',  countFORFRIDAY,fri["RESIDENCE_HALLS"],fri["Wolf Village"],fri["Wolf Ridge"], ],
            ['Saturday',  countFORSATURDAY,sat["RESIDENCE_HALLS"],sat["Wolf Village"],sat["Wolf Ridge"], ],
            ['Sunday',  countFORSUNDAY,sun["RESIDENCE_HALLS"],sun["Wolf Village"],sun["Wolf Ridge"], ],
        ]);

        var options = {
            title: 'Welcome Week 2015 - Residence Hall Compared to Apts',
            hAxis: {title: 'Day of Week',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0.5},
            bar: {groupWidth: "300%"},
            'width': 900,
            'height': 500
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }




    /*This is a break down of Campus Area
     EAST, CENTRAL, WEST, APT*/
    function drawChartforCentralCampus() {
        var data = google.visualization.arrayToDataTable([
            ['Day', 'Overall CheckIns', 'East','Central','West','Apt'],
            ['Monday',countFORMONDAY,mon["east"],mon["central"],mon["west"],mon["apt"]],
            ['Tuesday',countFORTUESDAY,tues["east"],tues["central"],tues["west"],tues["apt"]],
            ['Wednesday',countFORWEDNESDAY,wed["east"],wed["central"],wed["west"],wed["apt"]],
            ['Thursday',countFORTHURSDAY,thurs["east"],thurs["central"],thurs["west"],thurs["apt"]],
            ['Friday',countFORFRIDAY,fri["east"],fri["central"],fri["west"],fri["apt"]],
            ['Saturday',countFORSATURDAY,sat["east"],sat["central"],sat["west"],sat["apt"]],
            ['Sunday',countFORSUNDAY,sun["east"],sun["central"],sun["west"],sun["apt"]],
        ]);

        var options = {
            title: 'Welcome Week 2015 - Campus Area',
            hAxis: {title: 'Day of Week',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0.5},
            bar: {groupWidth: "300%"},
            'width': 900,
            'height': 500
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);


        //Utilize Google Handler(s) to handle the on-click of a bar

        //Add ou selection handler.
        google.visualization.events.addListener(chart,'select',selectHandler);


        // The selection handler.
        // Loop through all items in the selection and concatenate
        // a single message from all of them.
        function selectHandler() {
            var selection = chart.getSelection();
            var message = '';
            for (var i = 0; i < selection.length; i++) {
                var item = selection[i];

                if (item.row != null && item.column != null) {
                    var str = data.getFormattedValue(item.row, item.column);
                    var labelOfChart = data.getColumnLabel(item.column);

                    message +=  str +'data label'+ labelOfChart +'\n';

                    //On chart column click, go to the chart that represents the page of checkins
                    //for that particular segment.
                    if(labelOfChart==="East"){
                        // similar behavior as an HTTP redirect
                        window.location.replace("http://www.google.com");

                    }

                } else if (item.row != null) {
                    var str = data.getFormattedValue(item.row, 0);
                    message += '{row:' + item.row + ', column:none}; value (col 0) = ' + str + '\n';
                } else if (item.column != null) {
                    var str = data.getFormattedValue(0, item.column);
                    message += '{row:none, column:' + item.column + '}; value (row 0) = ' + str + '\n';
                }



            }

            if (message == '') {
                message = 'nothing';
            }
            alert('You selected ' + message);
        }

    }
</script>

<html>
