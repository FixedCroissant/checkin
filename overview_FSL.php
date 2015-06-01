<?php 
require_once('../mysql/housing_apps_db_pdo.php');

//New Get Info
include('checkinPopulation.php');
?>
<?php
/* 
 * Author: J. Williams
 * Date: 06/01/2015
 * Version: 1.00
 * Description: This is the overview or dashboard of the students that have checked in for the department of 
 * Fraternity & Sorority Life of those students that have checked in for Opening Week 2015...
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
 if($_REQUEST["dateREQUESTED"]==="2015-03-16"){
 $dateREQUESTED="Monday 03-16-2015";
 }
 else if($_REQUEST["dateREQUESTED"]==="2015-03-17"){
     $dateREQUESTED="Tuesday 03-17-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-03-18"){
     $dateREQUESTED="Wednesday 03-18-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-03-19"){
     $dateREQUESTED="Thursday 03-19-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-03-20"){
     $dateREQUESTED="Friday 03-20-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-03-21"){
     $dateREQUESTED="Saturday 03-21-2015";
 }else if($_REQUEST["dateREQUESTED"]==="2015-03-22"){
     $dateREQUESTED="Sunday 03-22-2015";
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
<!--Fav Icon-->
<link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
</head>
<body>
<br/>
<br/>
<p><img src="images/fsl-text-logo-nw.png" alt="Fraternity & Sorority Life" title="NC State University - Fraternity & Sorority Life" /></p>
<div id = "header">
    <h4>Welcome Week Check-In</h4>
    <h5>Broken Down by Organization Name</h5>
</div>
<!--All the user to pick the date they want information -->
<div id="datechange">
            <p>Please select the date for Check In: </p>
                        <select id="datebox" class="dateSELECT">
                            <!--Initial option-->
                            <option value="#">Select ...</option>
                            <!--Get Custom Dates -->
                            <option value='custom'>Custom Dates</option>
                            <!--Get All Dates -->
                            <option value='allDATES'>Summary for All Dates</option>
                            <!--Monday -- Day 1-->
                            <option value="2015-03-16">Monday, March 16, 2015</option>
                            <!--Tuesday -- Day 2-->
                            <option value="2015-03-17">Tuesday, March 17, 2015</option>
                            <!--Wednesday -- Day 3-->
                            <option value="2015-03-18">Wednesday, March 18, 2015</option>
                            <!--Thursday -- Day 4-->
                            <option value="2015-03-19">Thursday, March 19, 2015</option>
                            <!--Friday -- Day 5-->
                            <option value="2015-03-20">Friday, March 20, 2015</option>
                            <!--Saturday -- Day 6 -->
                            <option value="2015-03-21">Saturday, March 21, 2015</option>
                            <!-- Sunday -- Day 7 -->
                            <option value="2015-03-22">Sunday, March 22, 2015</option>
                        </select>
            
            <!--Summer Start-->
            <!--Commented out on 4-29-2015-->
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
            <!--End Early Check-In->
            <!--Early Check-In & Opening Week-->
<!--            <br/>
            Add Dates Here
            <select id="datebox" class="dateSELECT">
                            Initial option
                            <option value="#">Select ...</option>
                            Get All Dates 
                            <option value='allDATES'>Summary for All Dates</option>
                            Monday -- Day 1
                            <option value="2015-08-11">Tuesday, August 11, 2015</option>
                            Tuesday -- Day 2
                            <option value="2015-08-12">Wednesday, August 12, 2015</option>
                            Wednesday -- Day 3
                            <option value="2015-08-13">Thursday, August 13, 2015</option>
                            Thursday -- Day 4
                            <option value="2015-08-14">Friday, August 14, 2015</option>
                            Friday -- Day 5
                            <option value="2015-08-15">Saturday, August 15, 2015</option>
                            Saturday -- Day 6 
                            <option value="2015-08-16">Sunday, August 16, 2015</option>
                             Sunday -- Day 7 
                            <option value="2015-08-17">Monday, August 17, 2015</option>
                        </select>-->
            <!--End Early Check-In-->
            
            <p>Or, select two dates of your choosing: <br/>
                <br/>
                <input type ="checkbox" id="customDatesSelected" name="customDatesSelected">Provide Custom Dates</input></p>            
            <br/>
            
            <div id ="customDatesWanted">
                <form action="http://localhost/apps/checkin/overview.php?dateREQUESTED=custom" id="customDatesCreated" name="customDates" method="POST">
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
</div>
<div id="columnControls">
<!--    Currently Disabled-->
<!--    <p> Other Reports <img src="images/other_reports.png" alt="other reports available"></p>-->
    <ul>
        <!--Currently disabled-->
        <!--<li><a href='overview_campus_area.php?dateREQUESTED=allDATES'>View by Campus Area</a></li>-->
    </ul>
    <p>Currently hidden columns <img src="images/hidden_columns.png" alt="currently hidden columns"></p>
    <ul>
        <li><a href='#' id='show_bed_information' title='Click to display/hide information about bed utilization.'>Bed Information</a> (% and total used) </li>
    </ul>
</div>
<br/>
<!--get date needed from dropdown-->
<script src="js/getDate.js"></script>
<!--calculate the totals for each time period-->
<script src="js/calcTotals.js"></script>
<!--Hide/Show chart as needed-->
<script src='js/showHideChartAndColumns.js'></script>
<table id="welcome_week_checkin" border="1">
 <thead>
  <!--Residence Hall or Apartment Name-->
 <th style="width: 150px;">
     FSL Org. Name
 </th>
  <!--Beds allocated for each building per PeopleSoft lookup.-->
 <th style="width:145px"  class="bed_information">
     Beginning Beds <span style="background-color:yellow;border:1px solid black; font-size: x-small;">[CURRENTLY FAKE NUMBERS]</span>
 </th>
 <!--Initial hide this block-->
 <!--From just over mid-night to 7:00am-->
 <th style="width: 130px;" class=''>
     12:01-7:59 am
 </th>
 <!--8:00-9:00-->
 <th>
     8-9 am
 </th>
 <!--9:00-10:00-->
 <th>
     9-10 am
 </th>
 <!--10:00-11:00-->
 <th>
     10-11 am
 </th>
 <!--11:00-12:00-->
 <th>
     11-12 n
 </th>
 <!--12:00-1:00p-->
 <th>
     12-1 pm
 </th>
 <!--1:00-2:00-->
 <th>
     1-2 pm
 </th>
 <!--2:00-3:00-->
 <th>
     2-3 pm
 </th>
 <!--3:00-4:00-->
 <th>
     3-4 pm
 </th>
 <!--4:00-5:00-->
 <th>
     4-5 pm
 </th>
 <!--From 6:00 to 12:00am-->
 <th style="width: 130px;" class=''>
     5:01-12:00 am
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
    
    //Greek Life
    //Setting these values for 100,90,80,70,60,50,40,30, etc.
    //THESE ARE NOT PULLING FROM A DATABSE
    //$initial_bed_count = array("Alexander Hall"=>"160","Avent Ferry"=>"586","Bagwell Hall"=>"100","Becton Hall"=>"250","Berry Hall"=>"56","Bowen Hall"=>"75","Bragaw Hall"=>"737","Carroll Hall"=>"342","Gold Hall"=>"56","Lee Hall"=>"730","Metcalf Hall"=>"396","North Hall"=>"231","Owen Hall"=>"366","Sullivan Hall"=>"688","Syme Hall"=>"205","Tucker Hall"=>"348","Turlington Hall"=>"156","Watauga Hall"=>"94","Welch Hall"=>"56","Wood Hall"=>"457","Wolf Village"=>"1187","Wolf Ridge"=>"1158");
    
    $initial_bed_count = array("Lambda Chi Alpha"=>"110","Sigma Kappa"=>"100","Kappa Alpha"=>"90","Delta Zeta"=>"80","Alpha Delta Pi"=>"70","Kappa Sigma"=>"60","Delta Gamma"=>"50","Kappa Alpha Theta"=>"40","Pi Beta Phi"=>"30","Sigma Alpha Epsilon"=>"20","Sigma Phi Epsilon"=>"10");
    
    //Get the initial bed counts from the SIS database.
    //THIS INFORMATION IS FOR FRATERNITY & SORORITY LIFE
    //TEMPORARILY COMMENTED OUT.
    //include('utilities/readRoomAvail-FSL.php');
    
    //Create an array of Greek Life Villages.
    $GreekVillages = array("Lambda Chi Alpha","Sigma Kappa","Kappa Alpha","Delta Zeta","Alpha Delta Pi","Kappa Sigma","Delta Gamma","Kappa Alpha Theta","Pi Beta Phi","Sigma Alpha Epsilon","Sigma Phi Epsilon");
    
    //Get the date that we need from the option block that is currently residing on line(s) 50-65.
    //$dateNEEDED = "2015-03-12";
    $dateNEEDED = $_GET["dateREQUESTED"];
    
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
                                foreach ($GreekVillages as $residenceNAME){                       
                                                    //Set Residence Hall
                                                    $group1_RESIDENCE->setResidenceHall($residenceNAME);    

                                                    //Set Date Range Needed All Dates
                                                    //Check endcell_for_date_range.php for the 2 bound variables 
                                                    
                                                    $group1_RESIDENCE->setDateNeededRange($beginDATENEEDED, $endDATENEEDED);
                                                    
                                                    //Specify the residence that we need and assign to "residence" variable.
                                                    $residence = $group1_RESIDENCE->getResidenceHall();

                                                    //Specify the date that we need and assign to a "date_needed" variable.
                                                    $date_needed = $group1_RESIDENCE->getDateNeeded();
                                                    

                                                    //Greek Village Location!!!
                                                    echo "<tr>";
                                                    echo "<td>";
                                                       echo $residence; 
                                                                            
                                                        //echo $residence;                            
                                                    echo "</td>";

                                                    //Provide bed numbers for building
                                                    echo "<td id='initial_bed_number' class='bed_information'>";                        
                                                            echo $initial_bed_count[$residenceNAME];
                                                    echo "</td>";

                                                     //Late at night check-ins
                                                     //Start at 00 and go to 7:00
                                                    for($x=0;$x<1;$x++){
                                                        //Set initial beginTIME.
                                                        $beginTIME="0".$x.":01";
                                                        $endTIME="07:59";                
                                                            //Start the beginning of the cell.
                                                            include('begincell.php');

                                                            //Set Times for this Location.
                                                            $group1_RESIDENCE->setBeginTime($beginTIME);
                                                            $group1_RESIDENCE->setEndTime($endTIME);
                                                            //Close the cell off
                                                            include('endcells/endcell_for_date_range.php');
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
                                                            include('endcells/endcell_for_date_range.php');
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
                                                        include('endcells/endcell_for_date_range.php');
                                                    }
                                                    //End 5:01pm until 12:00am
                                                    
                                                    //Get totals
                                                    include('begincell.php');
                                                    echo $totalResults;
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
                                for($x=0;$x<12;$x++){
                                        echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
                                        echo "&nbsp;";
                                        echo "</td>";
                                }    

                                echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";
                                      //echo "this is a test - total";
                                echo "</td>"; 
    
        }//End CustomDates
    
    /**
     *  ALL DATES
     */
    //Option #2
    //Dates Hard Coded for March 16 2015 through March 22 2015 
    if($dateNEEDED=="allDATES"){        
         //Get Begin Date
         $beginDATENEEDED ="2015-03-16";
                
         //Get End Date
         $endDATENEEDED = "2015-03-22";                
        
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
                                foreach ($GreekVillages as $residenceNAME){                       
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
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
                                                    }
                                                    else if($residence==="Wood Hall"){
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
                                                    }
                                                    else if($residence==="Wolf Village"){
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
                                                    }
                                                    else if($residence==="Wolf Ridge"){
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
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
                                                     //Start at 00 and go to 7:00
                                                    for($x=0;$x<1;$x++){
                                                        //Set initial beginTIME.
                                                        $beginTIME="0".$x.":01";
                                                        $endTIME="07:59";                
                                                            //Start the beginning of the cell.
                                                            include('begincell.php');

                                                            //Set Times for this Location.
                                                            $group1_RESIDENCE->setBeginTime($beginTIME);
                                                            $group1_RESIDENCE->setEndTime($endTIME);
                                                            //Close the cell off
                                                            include('endcells/endcell_for_date_range.php');
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
                                                            include('endcells/endcell_for_date_range.php');
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
                                                        include('endcells/endcell_for_date_range.php');
                                                    }
                                                    //End 5:01pm until 12:00am
                                                    
                                                    //Get totals
                                                    include('begincell.php');
                                                    echo $totalResults;
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
                                for($x=0;$x<12;$x++){
                                        echo "<td style='color: red; font-weight: bold; background-color:#CACACA' id=total_area".$x.">";
                                        echo "&nbsp;";
                                        echo "</td>";
                                }    

                                echo "<td class='bed_information' id='remaining_bed_total' style='background-color:#CACACA; font-weight:bold;'>";
                                      //echo "this is a test - total";
                                echo "</td>"; 
    
        }//End DateNeeded "All Dates"
    
    /**
     *  SPECIFIC DATE
     */    
    //Option #3, specific day needed to list information.
    //If I need anything than all the dates then create something specfic just for an individual time period.
    if($dateNEEDED!=="allDATES" && $dateNEEDED!=="custom"){
        //If not all dates, then there is no reason to put Date Begin & Date End
        //add javascript and show the current beginning date and ending date.
        echo "<script type='text/javascript'>";
        //Remove the DIV from the DOM when we are specifying the specific date that we need to retrieve information. 
        echo "$('#blockOfDateBeginAndEnd').remove();";
        echo "</script>";
        //end javascript
        
        
        
        
        //just for testing Testing
        //echo "You do not need all dates!";
                                //START
                                //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
                                include('completeTOTALS.php');
                                //END    

                                //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
                                foreach ($GreekVillages as $residenceNAME){                       
                                                    //Set Residence Hall
                                                    $group1_RESIDENCE->setResidenceHall($residenceNAME);    

                                                    //Set Date Needed
                                                    $group1_RESIDENCE->setDateNeeded($dateNEEDED);

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
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Avent%20Ferry' title='Click to get a sub-report of building. i.e. Avent Ferry broken down by AFC-A,AFC-B,AFC-C'>".$residence."</a>";
                                                    }
                                                    else if($residence==="Wood Hall"){
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED ."&building_needed=Wood%20Hall' title='Click to get a sub-report of building. i.e. Wood Hall broken into Wood-A and Wood-B'>".$residence."</a>";
                                                    }
                                                    else if($residence==="Wolf Village"){
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Village' title='Click to get a sub-report of building. i.e. Wolf Village broken into buildings, Wolf Village A-H'>".$residence."</a>";
                                                    }
                                                    else if($residence==="Wolf Ridge"){
                                                        echo "<a href='http://localhost/apps/checkin/overview_detailed_list.php?dateREQUESTED=".$dateNEEDED."&building_needed=Wolf%20Ridge' title='Click to get a sub-report of building. i.e. Wolf Ridge broken down into WR Grove, WR Innovation, WR Lakeview,etc.'>".$residence."</a>";
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
                                                     //Start at 00 and go to 7:59
                                                    for($x=0;$x<1;$x++){
                                                        //Set initial beginTIME.
                                                        $beginTIME="0".$x.":01";
                                                        $endTIME="07:59";                
                                                            //Start the beginning of the cell.
                                                            include('begincell.php');

                                                            //Set Times for this Location.
                                                            $group1_RESIDENCE->setBeginTime($beginTIME);
                                                            $group1_RESIDENCE->setEndTime($endTIME);
                                                            //Close the cell off
                                                            include('endcells/endcell.php');
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
                                                            include('endcells/endcell.php');
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
                                                        include('endcells/endcell.php');
                                                    }
                                                    //End 5:01pm until 12:00am






                                                        //Get totals
                                                        include('begincell.php');
                                                        echo $totalResults;
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
                                                        $percentage_occupied = number_format($percentage_occupied_temp*100,2)."%";                            

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
<!--Comment out Charts as they're not needed-->
<p>Chart Options</p>

<!--Removed as likely not necessary for FSL-->
<!--Commented out on 06 01 2015 @ 4:29p-->
<!--<div id ="reportOptions">
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
</div>-->


<div id='overview_of_results'>
    
    <p>
         Overview of the Day-to-Day Check in: <br/>
         <br/>
         Weekly Overview <br/>
        Monday, March 16 - Sunday March 22
     </p>
     
     
     <div id="chart_div" style="width: 900px; height: 500px;"></div>
</div>

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

//5:01-midnight
$('#welcome_week_checkin .timeGroup17 a').each(function(){
    val = parseFloat($(this).html());
    
    if (val > 0){
        total_17+= val;
            }           
});//End Function


//Complete totals:
$('#welcome_week_checkin .timeGroup18').each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        completeTOTAL+= val;        
        //console.log(completeTOTAL);
            }           
});//End Function



//Display results on the bottom most row in the table.


//12:01am to 7:00am time frame
$('#total_area0').html(total_mid_to_seven);

//8-9 am time period
$('#total_area1').html(total_8);
//9-10am time period
$('#total_area2').html(total_9);
//10-11am time period
$('#total_area3').html(total_10);
//11-12noon time period
$('#total_area4').html(total_11);
//12-1pm time period
$('#total_area5').html(total_12);
//1-2pm time period
$('#total_area6').html(total_13);
//2-3pm time period
$('#total_area7').html(total_14);
//3-4pm time period
$('#total_area8').html(total_15);
//4-5pm time period
$('#total_area9').html(total_16);
//5:01-12:00mid time perdio
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
          ['Day', 'Overall CheckIns', 'Residence Halls','Wolf Ridge','Wolf Village'],
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
