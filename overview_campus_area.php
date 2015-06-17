<?php 
require_once('../mysql/housing_apps_db_pdo.php');

//New Get Info
include('checkinPopulation.php');
?>
<?php
/* 
 * Author: J. Williams
 * Date: 03/06/2014
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
 if($_REQUEST["dateREQUESTED"]==="2015-08-03"){
 $dateREQUESTED="Monday 08-03-2015";
 }
 else if($_REQUEST["dateREQUESTED"]==="2015-08-04"){
     $dateREQUESTED="Tuesday 08-04-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-08-05"){
     $dateREQUESTED="Wednesday 08-05-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-08-06"){
     $dateREQUESTED="Thursday 08-06-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-08-07"){
     $dateREQUESTED="Friday 08-07-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-08-08"){
     $dateREQUESTED="Saturday 08-08-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-08-09"){
     $dateREQUESTED="Sunday 08-09-2015";
 }
 
 else if($_REQUEST["dateREQUESTED"]==="allDATES"){
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
<!--CSS Needed for the date pickers-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--Ability to Export tables to PDF or Excel format-->
<script type="text/javascript" src="excel_export/html_table_export/tableExport.js"></script>
<script type="text/javascript" src="excel_export/html_table_export/jquery.base64.js"></script>
<!--End ability to Export tables-->
<!--Bootstrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<!--End Bootstrap-->
<!--Fav Icon-->
<link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
</head>
<body>
<img src="https://housing.ncsu.edu/secure/images/logo.png" alt="University Housing logo" title="NC State University Housing" />
<!--Added 06 05 2015 allow end users to log-out of Shibb-->
<input type="button" name="logout" onClick="window.location='https://housing.ncsu.edu/Shibboleth.sso/Logout'"
value="Logout of Beep System" style="float:right;" />
<div id = "header">
    <h4>Welcome Week Check-In</h4>
    <h5>Broken Down by Campus Area</h5>
</div>
<!-- 06 05 2015 -- Add link to go back to beep system. -->
<a href ="index.php" alt="Go Back to Beep System" title="Go Back to Beep System" style="align:left;">Go Back to Beep System</a>
<!-- Line breaks-->
<br/>
<br/>
<!--All the user to pick the date they want information -->
<div id="datechange">
            <p>Please select the date for Check In: </p>
                        <select id="datebox" class="dateSELECT">
                            <!--Initial option-->
                            <option value="#">Select ...</option>
                            <!--Get Custom Dates -->
                            <option value='custom'>Custom Dates</option>
                            <!--Add option for Summer II -->
                            <option value="2015-06-21">Summer II Term Check-In (June 21 2015)</option>
                        </select>
            <br/>
            <!--Summer Start-->
            <br/>
<!--            <p>Summer Start Dates</p>
            Add Dates Here
            <select id="datebox" class="dateSELECT">
                            Initial option
                            <option value="#">Select ...</option>
                            Get All Dates 
                            <option value='allDATES'>Summary for All Dates</option>
                            Sunday -- Day 1
                            <option value="2015-06-11">Sunday, June 21, 2015</option>
                        </select>-->
            <!--End Summer Start Date-->
			<p>Or, select two dates of your choosing: <br/>
                <br/>
                <input type ="checkbox" id="customDatesSelected" name="customDatesSelected">Provide Custom Dates</input></p>            
            <br/>
            
            <div id ="customDatesWanted">
                <form action="overview_campus_area.php?dateREQUESTED=custom" id="customDatesCreated" name="customDates" method="POST">
                Beginning Date: <input id="customBeginDate" type="textbox" maxlength="18" name="beginningDateNeededCustom"></input> <br/>
                Ending Date: &nbsp; <input id="customEndDate" type="textbox" maxlength="18" name="endingDateNeededCustom"></input>
                <br/>
                <br/>
                <input type="submit" value="Provide New Information"></input>
                </form>
            </div>
            
            
            Currently viewing date: &nbsp; <?php if($dateREQUESTED==="Summary for All Dates"){echo "<strong> Summary of the Two Dates below: </strong>";}else{echo "<strong>".$dateREQUESTED."</strong>";} ?>
            <!--Create a block showing the beginning and ending dates for "Summary of All Dates"--> 
            <div id='blockOfDateBeginAndEnd'>
            Date Begin:<span id='dateBeginNotify'></span> <br/>
            Date End: <span id='dateEndNotifyUser'></span>
            </div>
            <!--End block showing the beginning and ending dates for "Summary of All Dates"--> 
            <!--Line Break -->
            <br/>            
            Table will automatically update.
            <!--Line Break -->            
            <br/>
            <br/>
            <!--Ability to Export Data -->
            <div class="btn-group" role="group" aria-label="...">
                <button type="button" onclick="$('#welcome_week_checkin').tableExport({type:'excel',escape:'true'});" class="btn-warning btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
            </div>
            <!--Line breaks-->
</div>
<div id="columnControls">
    <p> Other Reports <img src="images/other_reports.png" alt="other reports available"></p>
    <ul>
    <li><a href='overview.php?dateREQUESTED=allDATES'>View by Building</a></li>
    </ul>
    <p>Currently hidden columns <img src="images/hidden_columns.png" alt="currently hidden columns"></p>
    <ul>
        <li><a href='#' id='show_bed_information' title='Click to display/hide information about bed utilization.'>Bed Information</a> (% and total used) </li>
    </ul>
</div>
<br/>
<!--get date needed from dropdown-->
<script src="js/getDate_for_campus_area.js"></script>
<!--calculate the totals for each time period-->
<script src="js/calcTotals.js"></script>
<!--Hide/Show chart as needed-->
<script src='js/showHideChartAndColumns.js'></script>
<table id="welcome_week_checkin" border="1">
 <thead>
  <!--Residence Hall or Apartment Name-->
 <th style="width: 95px;">
     Area Location 
 </th>
  <!--Beds allocated for each building per PeopleSoft lookup.-->
 <th style="width:145px"  class="bed_information">
     Beginning Beds 
 </th>
 <!--Initial hide this block-->
 <!--From just over mid-night to 7:00am-->
 <th style="width: 90px;" class=''>
     12:01-7:00 am
 </th>
 <!--8:00-9:00-->
 <th style="width: 90px;">
     8-9 am
 </th>
 <!--9:00-10:00-->
 <th style="width: 90px;">
     9-10 am
 </th>
 <!--10:00-11:00-->
 <th style="width: 90px;">
     10-11 am
 </th>
 <!--11:00-12:00-->
 <th style="width: 90px;">
     11-12 n
 </th>
 <!--12:00-1:00p-->
 <th style="width: 90px;">
     12-1 pm
 </th>
 <!--1:00-2:00-->
 <th style="width: 90px;">
     1-2 pm
 </th>
 <!--2:00-3:00-->
 <th style="width: 90px;">
     2-3 pm
 </th>
 <!--3:00-4:00-->
 <th style="width: 90px;">
     3-4 pm
 </th>
 <!--4:00-5:00-->
 <th style="width: 90px;">
     4-5 pm
 </th>
 <!--From 6:00 to 12:00am-->
 <th style="width: 90px;" class=''>
     5:01-12:00 am
 </th>
 <th style="width: 90px;">
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
    
    //This is a new array that combines bed numbers from all halls and apartments to their corresponding 
    //centralized areas on campus.
    
    //This line is commented out because we will now be getting information from the database.
    //This portion is ready from the "readRoomAvail_centralized_areas.php
    //$initial_bed_count = array("east"=>"160","central"=>"586","west"=>"700","apt"=>"480");
    
    //Get information from the database  -- 03-31-2015
    include('utilities/readRoomAvail_centralized_areas.php');
    //End get information from the database -- 03-31-2015
    
    //Create an array of Residence Halls & Complexes.
    //$residenceHALLSANDAPARTMENTS = array("Alexander Hall","Avent Ferry","Bagwell Hall","Becton Hall","Berry Hall","Bowen Hall","Bragaw Hall","Carroll Hall","Gold Hall","Lee Hall","Metcalf Hall","North Hall","Owen Hall","Sullivan Hall","Syme Hall","Tucker Hall","Turlington Hall","Watauga Hall","Welch Hall","Wood Hall","Wolf Village","Wolf Ridge");
    
    //Create an array of centralized locations of each property.
    $central_locations=array("east","central","west","apt");
    
    //Get the date that we need from the option block that is currently residing on line(s) 50-65.
    //Format of Date is = "2015-03-12";
    $dateNEEDED = $_GET["dateREQUESTED"];
    /**
	 * CUSTOM DATES
	 **/
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
            //end javascript    
            echo "</script>";
            
       
    //START
    //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
    include('completeTOTALSforGraph.php');
    //END    
    
    //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
    foreach ($central_locations as $centralAreas){                       
                        //Set Residence Hall
                        //$group1_RESIDENCE->setResidenceHall($residenceNAME);    
                        $group1_RESIDENCE->setCentralAreas($centralAreas);
                                                
                        //Get the centralized areas:
                        $campusarea = $group1_RESIDENCE->getCentralArea();                        
                        //echo $campusarea;                        
                        
                        //Set Date Needed
                        $group1_RESIDENCE->setDateNeeded($dateNEEDED);
        
                        //Specify the residence that we need and assign to "residence" variable.
                        $residence = $group1_RESIDENCE->getResidenceHall();
                        
                        //echo $residence;
                        
                        //Specify the date that we need and assign to a "date_needed" variable.
                        $date_needed = $group1_RESIDENCE->getDateNeeded();
                        
                        //Residence Location!!!
                        echo "<tr>";
                        echo "<td>";
                        
                            //By clicking on the link for residence hall, they will get a break down for sub areas
                            //Avent Ferry will break down to AFC-A, AFC-B,AFC-C, etc.
                        
                        if($residence==="Avent Ferry")
                            {
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
                        }
                        else if($residence==="Wood Hall"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
                        }
                        else if($residence==="Wolf Village"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
                        }
                        else if($residence==="Wolf Ridge"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
                        }
                        else{
                           echo "<span style='font-weight:bold'>".ucfirst($campusarea)."</span>";
                           
                                        if($campusarea==="east"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "NE - North, Wat, Sym, Gold, Welch, Ber, Bect, Bag";
                                            echo "<br/>";
                                            echo "SE - Wood, AFC";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="central"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "TT - Bowen, Carroll, Met";
                                            echo "<br/>";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="west"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "Bragaw";
                                            echo "<br/>";
                                            echo "Lee";
                                            echo "<br/>";
                                            echo "Sullivan";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="apt"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "Wolf Village";
                                            echo "<br/>";
                                            echo "Wolf Ridge";
                                            echo "<br/>";
                                            echo "</div>";
                                        }
                        }                        
                            //echo $residence;                            
                        echo "</td>";
                        
                        //Provide bed numbers for building
                        echo "<td id='initial_bed_number' class='bed_information'>";                        
                                echo $initial_bed_count[$centralAreas];      
                        echo "</td>";
                        
                         //Late at night check-ins
                         //Start at 00 and go to 7:00
                        for($x=0;$x<1;$x++){
                            //Set initial beginTIME.
                            $beginTIME="0".$x.":01";
                            $endTIME="07:00";                
                                //Start the beginning of the cell.
                                include('begincell.php');

                                //Set Times for this Location.
                                $group1_RESIDENCE->setBeginTime($beginTIME);
                                $group1_RESIDENCE->setEndTime($endTIME);
                                
                                //Close the cell off for ALL dates in the drop down.  This is a specific version strictly used 
                                //for the particular campus area the check-in happened.
                                include('endcells/endcell_for_date_range_campus_area.php');
                        }
                        
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

                                //Close the cell off for ALL dates in the drop down.  This is a specific version strictly used 
                                //for the particular campus area the check-in happened.
                                include('endcells/endcell_for_date_range_campus_area.php');
                        }
                        
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
                            
                            //Close the cell off for ALL dates in the drop down.  This is a specific version strictly used 
                            //for the particular campus area the check-in happened.
                            include('endcells/endcell_for_date_range_campus_area.php');
                        }
                        //End 5:01pm until 12:00am
                     
                        /**
						* GET TOTALS FOR SEGMENT (EAST OR CENTRAL OR WEST OR APT)
						*/
                        include('begincell.php');                        
                        //echo $totalResults;
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
						
						echo "<a href='report_for_specific_area_totals_campus_area.php?central_location=".$campusarea."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&&endTIME=".$timeENDforReport."' target='_blank')'>$totalResults</a>";
						
                        echo"</td>";
                            
                            
                        //Comment out while debugging code.
                        //Uncomment on 4/1/2015 - 8:24am
                            
                            //Add to our total Results array for usuage in the Chart.
                            //Currently displayed results will be stored in the array called
                            //$totalResultsGrouping[]
                            $totalResultsGrouping[$centralAreas]= $totalResults;                            
                            
                            //Create a variable that will hold the amount left.
                            $amount_left= ($initial_bed_count[$centralAreas]-$totalResults);
                            
                            //Create a variable that will hold the percentage use for the occupancy for the building.
                            $percentage_occupied_temp=($amount_left/$initial_bed_count[$centralAreas]);
                            
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
    
    for($x=0;$x<12;$x++){
            echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
            echo "&nbsp;";
            echo "</td>";
    }    
    
    echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";
          //echo "this is a test - total";
    echo "</td>"; 
    
     //Close if custom are picked
     }	
	
	
	
	
	/**
	 * Option #2
	 */
	//Updated on 06 15, 2015 -- dates have been hard coded for Summer Start II, Sunday, 06 21 2015. 
	//Dates Hard Coded for March 16 2015 through March 22 2015. 
    //If ALL DATES are picked from the DROP-DOWN list.
    if($dateNEEDED=="allDATES"){
		//Get Begin Date
        $beginDATENEEDED ="2015-06-21";
                
        //Get End Date
        $endDATENEEDED = "2015-06-21"; 

      	//add javascript and show the current beginning date and ending date.
        echo "<script type='text/javascript'>";
        //Provide the end user with the beginning date in the #dateBeginNotify span. 
        echo "$('#dateBeginNotify').html('&nbsp; <strong>".$beginDATENEEDED."</strong>');";
        //Provide the end user with the beginning date in the #dateEndNotify span. 
        echo "$('#dateEndNotifyUser').html('&nbsp;&nbsp; <strong>".$endDATENEEDED."</strong>');";
        //end javascript    
        echo "</script>";
        
       
    //START
    //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
    include('completeTOTALSforGraph.php');
    //END    
    
    //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
    foreach ($central_locations as $centralAreas){                       
                        //Set Residence Hall
                        //$group1_RESIDENCE->setResidenceHall($residenceNAME);    
                        $group1_RESIDENCE->setCentralAreas($centralAreas);
                                                
                        //Get the centralized areas:
                        $campusarea = $group1_RESIDENCE->getCentralArea();                        
                        //echo $campusarea;                        
                        
                        //Set Date Needed
                        $group1_RESIDENCE->setDateNeeded($dateNEEDED);
        
                        //Specify the residence that we need and assign to "residence" variable.
                        $residence = $group1_RESIDENCE->getResidenceHall();
                        
                        //echo $residence;
                        
                        //Specify the date that we need and assign to a "date_needed" variable.
                        $date_needed = $group1_RESIDENCE->getDateNeeded();
                        
                        //Residence Location!!!
                        echo "<tr>";
                        echo "<td>";
                        
                            //By clicking on the link for residence hall, they will get a break down for sub areas
                            //Avent Ferry will break down to AFC-A, AFC-B,AFC-C, etc.
                        
                        if($residence==="Avent Ferry")
                            {
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
                        }
                        else if($residence==="Wood Hall"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
                        }
                        else if($residence==="Wolf Village"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
                        }
                        else if($residence==="Wolf Ridge"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
                        }
                        else{
                           echo "<span style='font-weight:bold'>".ucfirst($campusarea)."</span>";
                           
                                        if($campusarea==="east"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "NE - North, Wat, Sym, Gold, Welch, Ber, Bect, Bag";
                                            echo "<br/>";
                                            echo "SE - Wood, AFC";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="central"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "TT - Bowen, Carroll, Met";
                                            echo "<br/>";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="west"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "Bragaw";
                                            echo "<br/>";
                                            echo "Lee";
                                            echo "<br/>";
                                            echo "Sullivan";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="apt"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "Wolf Village";
                                            echo "<br/>";
                                            echo "Wolf Ridge";
                                            echo "<br/>";
                                            echo "</div>";
                                        }
                        }                        
                            //echo $residence;                            
                        echo "</td>";
                        
                        //Provide bed numbers for building
                        echo "<td id='initial_bed_number' class='bed_information'>";                        
                                echo $initial_bed_count[$centralAreas];      
                        echo "</td>";
                        
                         //Late at night check-ins
                         //Start at 00 and go to 7:00
                        for($x=0;$x<1;$x++){
                            //Set initial beginTIME.
                            $beginTIME="0".$x.":01";
                            $endTIME="07:00";                
                                //Start the beginning of the cell.
                                include('begincell.php');

                                //Set Times for this Location.
                                $group1_RESIDENCE->setBeginTime($beginTIME);
                                $group1_RESIDENCE->setEndTime($endTIME);
                                
                                //Close the cell off for ALL dates in the drop down.  This is a specific version strictly used 
                                //for the particular campus area the check-in happened.
                                include('endcells/endcell_for_date_range_campus_area.php');
                        }
                        
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

                                //Close the cell off for ALL dates in the drop down.  This is a specific version strictly used 
                                //for the particular campus area the check-in happened.
                                include('endcells/endcell_for_date_range_campus_area.php');
                        }
                        
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
                            
                            //Close the cell off for ALL dates in the drop down.  This is a specific version strictly used 
                            //for the particular campus area the check-in happened.
                            include('endcells/endcell_for_date_range_campus_area.php');
                        }
                        //End 5:01pm until 12:00am

						
                        //Get totals
                        include('begincell.php');
                        //echo $totalResults;
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
						
						echo "<a href='report_for_specific_area_totals_campus_area.php?central_location=".$campusarea."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&&endTIME=".$timeENDforReport."' target='_blank')'>$totalResults</a>";
						
                        echo"</td>";
                            
                            
                        //Comment out while debugging code.
                        //Uncomment on 4/1/2015 - 8:24am
                            
                            //Add to our total Results array for usuage in the Chart.
                            //Currently displayed results will be stored in the array called
                            //$totalResultsGrouping[]
                            $totalResultsGrouping[$centralAreas]= $totalResults;                            
                            
                            //Create a variable that will hold the amount left.
                            $amount_left= ($initial_bed_count[$centralAreas]-$totalResults);
                            
                            //Create a variable that will hold the percentage use for the occupancy for the building.
                            $percentage_occupied_temp=($amount_left/$initial_bed_count[$centralAreas]);
                            
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
    
    for($x=0;$x<12;$x++){
            echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
            echo "&nbsp;";
            echo "</td>";
    }    
    
    echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";
          //echo "this is a test - total";
    echo "</td>"; 
    
    //Close if all Dates are picked
     }
    
    
     
    if($dateNEEDED!=="allDATES" && $dateNEEDED!=="custom"){ 
            //add javascript and show the current beginning date and ending date.
            echo "<script type='text/javascript'>";
            //Provide the end user with the beginning date in the #dateBeginNotify span. 
            //echo "$('#dateBeginNotify').html('&nbsp; <strong>".$beginDATENEEDED."</strong>');";

            //Provide the end user with the beginning date in the #dateEndNotify span. 
            //echo "$('#dateEndNotifyUser').html('&nbsp;&nbsp; <strong>".$endDATENEEDED."</strong>');";

            echo "</script>";
            //end javascript
       
    //START
    //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
    include('completeTOTALSforGraph.php');
    //END    
    
    //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
    foreach ($central_locations as $centralAreas){                       
                        //Set Residence Hall
                        //$group1_RESIDENCE->setResidenceHall($residenceNAME);    
                        $group1_RESIDENCE->setCentralAreas($centralAreas);
                                                
                        //Get the centralized areas:
                        $campusarea = $group1_RESIDENCE->getCentralArea();                        
                        //echo $campusarea;                        
                        
                        //Set Date Needed
                        $group1_RESIDENCE->setDateNeeded($dateNEEDED);
        
                        //Specify the residence that we need and assign to "residence" variable.
                        $residence = $group1_RESIDENCE->getResidenceHall();
                        
                        //echo $residence;
                        
                        
                        //Specify the date that we need and assign to a "date_needed" variable.
                        $date_needed = $group1_RESIDENCE->getDateNeeded();
                        
                        //Residence Location!!!
                        echo "<tr>";
                        echo "<td>";
                            //By clicking on the link for residence hall, they will get a break down for sub areas
                            //Avent Ferry will break down to AFC-A, AFC-B,AFC-C, etc.
                        
                        if($residence==="Avent Ferry")
                            {
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
                        }
                        else if($residence==="Wood Hall"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
                        }
                        else if($residence==="Wolf Village"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
                        }
                        else if($residence==="Wolf Ridge"){
                            echo "<a href='overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
                        }
                        else{
                           echo "<span style='font-weight:bold'>".ucfirst($campusarea)."</span>";
                           
                                        if($campusarea==="east"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "NE - North, Wat, Sym, Gold, Welch, Ber, Bect, Bag";
                                            echo "<br/>";
                                            echo "SE - Wood, AFC";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="central"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "TT - Bowen, Carroll, Met";
                                            echo "<br/>";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="west"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "Bragaw";
                                            echo "<br/>";
                                            echo "Lee";
                                            echo "<br/>";
                                            echo "Sullivan";
                                            echo "</div>";
                                        }
                                        else if($campusarea==="apt"){
                                            echo "<div style='text-align:right; width: 90px;'>";
                                            echo "<br/>";
                                            echo "Wolf Village";
                                            echo "<br/>";
                                            echo "Wolf Ridge";
                                            echo "<br/>";
                                            echo "</div>";
                                        }
                            
                        
                        
                        }                        
                            //echo $residence;                            
                        echo "</td>";
                        
                        //Provide bed numbers for building
                        echo "<td id='initial_bed_number' class='bed_information'>";                        
                                echo $initial_bed_count[$centralAreas];      
                        echo "</td>";
                        
                         //Late at night check-ins
                         //Start at 00 and go to 7:00
                        for($x=0;$x<1;$x++){
                            //Set initial beginTIME.
                            $beginTIME="0".$x.":01";
                            $endTIME="07:00";                
                                //Start the beginning of the cell.
                                include('begincell.php');

                                //Set Times for this Location.
                                $group1_RESIDENCE->setBeginTime($beginTIME);
                                $group1_RESIDENCE->setEndTime($endTIME);
                                //Close the cell off
                                include('endcells/endcell_central_campus.php');
                        }
                        
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
                                include('endcells/endcell_central_campus.php');
                        }
                        
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
                            include('endcells/endcell_central_campus.php');
                        }
                        //End 5:01pm until 12:00am
                     
                        //Get totals
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
						
						//To do a case statement for ALL of East Campus
						
						//Central Campus
						
						//West Campus
						
						//Apartments						
						echo "<a href='report_for_specific_area_totals.php?residence=".$residence."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&&endTIME=".$timeENDforReport."' target='_blank')'>$totalResults</a>";
						echo"</td>";
                            
                            
                        //Comment out while debugging code.
                        //Uncomment on 4/1/2015 - 8:24am
                            
                            //Add to our total Results array for usuage in the Chart.
                            //Currently displayed results will be stored in the array called
                            //$totalResultsGrouping[]
                            $totalResultsGrouping[$centralAreas]= $totalResults;                            
                            
                            //Create a variable that will hold the amount left.
                            $amount_left= ($initial_bed_count[$centralAreas]-$totalResults);
                            
                            //Create a variable that will hold the percentage use for the occupancy for the building.
                            $percentage_occupied_temp=($amount_left/$initial_bed_count[$centralAreas]);
                            
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
    
    for($x=0;$x<12;$x++){
            echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
            echo "&nbsp;";
            echo "</td>";
    }    
    
    echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";
          //echo "this is a test - total";
    echo "</td>"; 
    
    //Close if all Dates are picked
     } 
            
            ?> 
</tbody>   
    
<?php


//Close PDO connection
$conn = null;
?>
</tbody>
</table>
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
<!--Provide totals for end row at the bottom-->
<script type="text/javascript">
//Variables to keep the totals.
var total_mid_to_seven=0.0;
var total_8 = 0.0;
var total_9 = 0.0;
var total_10 = 0.0;
var total_11 = 0.0;
var total_12 = 0.0;
var total_13 = 0.0;
var total_14 = 0.0;
var total_15 = 0.0;
var total_16 = 0.0;
var total_17=0.0;
var completeTOTAL = 0.0;

//Variable to set the initial bed total.
var initialbed_allotment=0.0;
//Varaible to set the remaining bed total.
var remaining_bed_number=0.0;

//Calculate the total amount of beds that we have to utilize 
//from the very beginning before any are taken away.
$('#initial_bed_number ' ).each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        initialbed_allotment+= val;        
        //console.log(initialbed_allotment);
            }           
});//End Function

$('#amount_of_beds_left ' ).each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        remaining_bed_number+= val;
            }           
});//End Function

//12:01-7:00am
$('#welcome_week_checkin .timeGroup0 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_mid_to_seven+= val;
            }        
});//End Function
//8-9
$('#welcome_week_checkin .timeGroup8 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_8+= val;
            }        
});//End Function
//9-10
$('#welcome_week_checkin .timeGroup9 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_9+= val;
            }           
});//End Function
//10-11
$('#welcome_week_checkin .timeGroup10 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_10+= val;
            }
        console.log(total_10);    
});//End Function
//11-12
$('#welcome_week_checkin .timeGroup11 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_11+= val;
            }
        console.log(total_11);    
});//End Function
//12-1
$('#welcome_week_checkin .timeGroup12 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_12+= val;
            }           
});//End Function
//1-2
$('#welcome_week_checkin .timeGroup13 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_13+= val;
            }           
});//End Function
//2-3
$('#welcome_week_checkin .timeGroup14 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_14+= val;
            }            
});//End Function
//3-4
$('#welcome_week_checkin .timeGroup15 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_15+= val;
            }
          
});//End Function
//4-5
$('#welcome_week_checkin .timeGroup16 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_16+= val;
            }           
});//End Function

//5:00-midnight
$('#welcome_week_checkin .timeGroup17 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_17+= val;
            }           
});//End Function


//Complete totals:
$('#welcome_week_checkin .timeGroup18 a').each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        completeTOTAL+= val;        
        //console.log(completeTOTAL);
            }           
});//End Function



//Display results on the bottom most row in the table.


//12:01am to 7:00am time frame
$('#total_area0').html(total_mid_to_seven);
//8-9 am time period.
$('#total_area1').html(total_8);
//9-10am time period.
$('#total_area2').html(total_9);
//10-11am time period.
$('#total_area3').html(total_10);
//11-12noon time period.
$('#total_area4').html(total_11);
//12-1pm time period.
$('#total_area5').html(total_12);
//1-2pm time period.
$('#total_area6').html(total_13);
//2-3pm time period.
$('#total_area7').html(total_14);
//3-4pm time period.
$('#total_area8').html(total_15);
//4-5pm time period.
$('#total_area9').html(total_16);
//5:01-12:00mid time period.
$('#total_area10').html(total_17);

//Complete totals:
$('#total_area11').html(completeTOTAL);

//Create a total of the initial bed number
$('#total_initial_bed_allotment').html(initialbed_allotment);
//End the display of the total amount of initial beds that we have.

//Provide the total REMAINING beds available.
$('#remaining_bed_total').html(remaining_bed_number);
//End the total REMAINING beds available.


//END END END END
//End display results.

</script>

<!--Provide a Google Graphic showing the changes-->
<script type='text/javascript'>
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);



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


function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Overall CheckIns', 'Alexander','Avent Ferry','Bagwell Hall','Becton Hall','Berry Hall', 'Bowen Hall','Bragaw Hall','Carroll Hall','Gold Hall','Lee Hall','Metcalf Hall','North Hall','Owen Hall','Sullivan Hall','Syme Hall','Tucker Hall','Turlington Hall','Watauga Hall','Welch Hall','Wood Hall'],
          ['Monday',  countFORMONDAY, mon["Alexander Hall"],mon["Avent Ferry"],mon["Bagwell Hall"],mon["Becton Hall"],mon["Berry Hall"],mon["Bowen Hall"],mon["Bragaw Hall"],mon["Carroll Hall"],mon["Gold Hall"],mon["Lee Hall"],mon["Metcalf Hall"],mon["North Hall"],mon["Owen Hall"],mon["Sullivan Hall"],mon["Syme Hall"],mon["Tucker Hall"],mon["Turlington Hall"],mon["Watauga Hall"],mon["Welch Hall"],mon["Wood Hall"]],
          ['Tuesday',  countFORTUESDAY, tues["Alexander Hall"],tues["Avent Ferry"],tues["Bagwell Hall"],tues["Becton Hall"],tues["Berry Hall"],tues["Bowen Hall"],tues["Bragaw Hall"],tues["Carroll Hall"],tues["Gold Hall"],tues["Lee Hall"],tues["Metcalf Hall"],tues["North Hall"],tues["Owen Hall"],tues["Sullivan Hall"],tues["Syme Hall"],tues["Tucker Hall"],tues["Turlington Hall"],tues["Watauga Hall"],tues["Welch Hall"],tues["Wood Hall"]],
          ['Wednesday',  countFORWEDNESDAY, wed["Alexander Hall"],wed["Avent Ferry"],wed["Bagwell Hall"],wed["Becton Hall"],wed["Berry Hall"],wed["Bowen Hall"],wed["Bragaw Hall"],wed["Carroll Hall"],wed["Gold Hall"],wed["Lee Hall"],wed["Metcalf Hall"],wed["North Hall"],wed["Owen Hall"],wed["Sullivan Hall"],wed["Syme Hall"],wed["Tucker Hall"],wed["Turlington Hall"],wed["Watauga Hall"],wed["Welch Hall"],wed["Wood Hall"]],
          ['Thursday',  countFORTHURSDAY, thurs["Alexander Hall"],thurs["Avent Ferry"],thurs["Bagwell Hall"],thurs["Becton Hall"],thurs["Berry Hall"],thurs["Bowen Hall"],thurs["Bragaw Hall"],thurs["Carroll Hall"],thurs["Gold Hall"],thurs["Lee Hall"],thurs["Metcalf Hall"],thurs["North Hall"],thurs["Owen Hall"],thurs["Sullivan Hall"],thurs["Syme Hall"],thurs["Tucker Hall"],thurs["Turlington Hall"],thurs["Watauga Hall"],thurs["Welch Hall"],thurs["Wood Hall"]],
          ['Friday',  countFORFRIDAY, fri["Alexander Hall"],fri["Avent Ferry"],fri["Bagwell Hall"],fri["Becton Hall"],fri["Berry Hall"],fri["Bowen Hall"],fri["Bragaw Hall"],fri["Carroll Hall"],fri["Gold Hall"],fri["Lee Hall"],fri["Metcalf Hall"],fri["North Hall"],fri["Owen Hall"],fri["Sullivan Hall"],fri["Syme Hall"],fri["Tucker Hall"],fri["Turlington Hall"],fri["Watauga Hall"],fri["Welch Hall"],fri["Wood Hall"]],
          ['Saturday',  countFORSATURDAY, sat["Alexander Hall"],sat["Avent Ferry"],sat["Bagwell Hall"],sat["Becton Hall"],sat["Berry Hall"],sat["Bowen Hall"],sat["Bragaw Hall"],sat["Carroll Hall"],sat["Gold Hall"],sat["Lee Hall"],sat["Metcalf Hall"],sat["North Hall"],sat["Owen Hall"],sat["Sullivan Hall"],sat["Syme Hall"],sat["Tucker Hall"],sat["Turlington Hall"],sat["Watauga Hall"],sat["Welch Hall"],sat["Wood Hall"]],
          ['Sunday',  countFORSUNDAY, sun["Alexander Hall"],sun["Avent Ferry"],sun["Bagwell Hall"],sun["Becton Hall"],sun["Berry Hall"],sun["Bowen Hall"],sun["Bragaw Hall"],sun["Carroll Hall"],sun["Gold Hall"],sun["Lee Hall"],sun["Metcalf Hall"],sun["North Hall"],sun["Owen Hall"],sun["Sullivan Hall"],sun["Syme Hall"],sun["Tucker Hall"],sun["Turlington Hall"],sun["Watauga Hall"],sun["Welch Hall"],sun["Wood Hall"]],
        ]);

        var options = {
          title: 'Welcome Week 2015',
          hAxis: {title: 'Day of Week',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0.5},
          bar: {groupWidth: "300%"},
          'width': 900,
          'height': 500
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
</script>

<html>
