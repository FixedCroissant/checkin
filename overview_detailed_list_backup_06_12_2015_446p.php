<?php
require_once('../mysql/housing_apps_db_pdo.php');

//New Get Info
 include('checkinPopulation.php');
 
 
//Change based on what value is clicked and sent over to our page.
$buildingDETAIL_NEEDED=$_REQUEST['building_needed'];

$dateNEEDED=$_REQUEST["dateREQUESTED"];

?>
<?php
/* 
 * Author: J. Williams
 * Date: 03/20/2014
 * Version: 1.00
 * Description: A detailed report that lists all the students that have told University Housing that they're going to be doing a Co-Op in the upcoming term..
 */

// Create connection
//$conn = new mysqli($hostname, $username, $password, $database);

//NEW PDO Connection
 $conn = new PDO($hostname,$username,$password);
 
 //Individual Day Information
 $group1_RESIDENCE = new checkinPopulation();
 
 //Complete Groups to Paint an overview picture.
 $group_TOTAL_PICTURE = new checkinPopulation();
?>
<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">    
<title>
University Housing - Welcome Week Sign Up - Detailed Report
</title>
<!--jQuery Import - minified-->
<script src='//code.jquery.com/jquery-1.11.1.min.js' type='text/javascript'></script>
<!--jQuery DataTable script-->
<script src='//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js' type='text/javascript'></script>
<!--jQuery DataTable CSS Import -->
<link rel='stylesheet' type='text/css' href='//cdn.datatables.net/1.10.4/css/jquery.dataTables.css'>
<link rel='stylesheet' type='text/css' href='css/report.css'>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--Fav Icon-->
<link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
</head>
<body>
<br/>
<br/>
<p><img src="https://housing.ncsu.edu/secure/images/logo.png" alt="University Housing logo" title="NC State University Housing" /></p>
<div id = "header">
    <h4>Welcome Week Check-In</h4>
    <p>Detailed report of individual building.</p>
</div>

<!--All the user to pick the date they want information -->
<!--<div id="datechange">
            <p>Please select the date for Check In: </p>
                        <select id="datebox" class="dateSELECT">
                            Monday -- Day 1
                            <option value="2015-03-16">Monday, March 16, 2015</option>
                            Tuesday -- Day 2
                            <option value="2015-03-17">Tuesday, March 17, 2015</option>
                            Wednesday -- Day 3
                            <option value="2015-03-18">Wednesday, March 18, 2015</option>
                            Thursday -- Day 4
                            <option value="2015-03-19">Thursday, March 19, 2015</option>
                            Friday -- Day 5
                            <option value="2015-03-20">Friday, March 20, 2015</option>
                            Saturday -- Day 6 
                            <option value="2015-03-21">Saturday, March 21, 2015</option>
                             Sunday -- Day 7 
                            <option value="2015-03-22">Sunday, March 22, 2015</option>
                        </select> &nbsp; Table will automatically update. <br/>
</div>-->
<div id="columnControls">
    <p>Currently hidden columns:</p>
    <ul>
        <li><a href='#' id='show_bed_information' title='Click to display/hide information about bed utilization.'>Bed Information</a> (% and total used)</li>        
    </ul>
</div>

<br/>
<!--get date needed from dropdown-->
<script src="js/getDate.js"></script>
<!--calculate the totals for each time period-->
<script src="js/calcTotals.js"></script>
<!--Hide/Show chart as needed-->
<script src='js/showHideChartAndColumns.js'></script>

<br/>
<br/>
<br/>
<br/>
<a href='overview.php?dateREQUESTED=<?php echo $dateNEEDED ?>&building_needed=<?php echo $buildingDETAIL_NEEDED; ?>' title='Click to go back to overview of detailed building report.'>Go back</a>


<p>The date the information is looking at is the: <strong><?php echo $dateNEEDED?></strong> date.</p>
<br/>

<table id="welcome_week_checkin" border="1">
 <thead>
  <!--Residence Hall or Apartment Name-->
 <th style="width: 150px;">
     <a href='#' title='Click to hide column,residence halls/apartments'>Bldg. Name</a> 
 </th>
  <!--Beds allocated for each building per PeopleSoft lookup.-->
 <th style="width:145px"  class="bed_information">
     Beginning Beds 
 </th>

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
    % of Remaining Beds
 </th>
 <!--END remaining percentage of beds left-->
</thead>   
<tbody>    
    
    <?php
    //Variables
    $totalResults=0;    
    $totalResultsGrouping= array();
    
    
    //THESE ARE GROUPS!!!! OF BUILDINGS. THEY WILL BE BROKEN DOWN AND SEPARATED LIKE AVENT FERRY === AFC-A,AFC-B,AFC-E,AFC-F.    
    
    //Set of if statement(s) to assign array, based on the building specified.
    //$initial_bed_count = array("Alexander Hall"=>"160","Avent Ferry"=>"586","Bagwell Hall"=>"100","Becton Hall"=>"250","Berry Hall"=>"56","Bowen Hall"=>"75","Bragaw Hall"=>"737","Carroll Hall"=>"342","Gold Hall"=>"56","Lee Hall"=>"730","Metcalf Hall"=>"396","North Hall"=>"231","Owen Hall"=>"366","Sullivan Hall"=>"688","Syme Hall"=>"205","Tucker Hall"=>"348","Turlington Hall"=>"156","Watauga Hall"=>"94","Welch Hall"=>"56","Wood Hall"=>"457","Wolf Village"=>"1187","Wolf Ridge"=>"1158");
    
    if($buildingDETAIL_NEEDED==="Avent Ferry"){    
    //Create an array of Residence Halls & Complexes.
    $residenceBUILDINGS = array("AFC - A","AFC - B","AFC - E","AFC - F");
    //Set up array.
    //$initial_bed_count=array("AFC - A"=>"106","AFC - B"=>"114","AFC - E"=>"216","AFC - F"=>"150");
        $initial_bed_count=array("AFC - A"=>"","AFC - B"=>"","AFC - E"=>"","AFC - F"=>"");
    }
    else if($buildingDETAIL_NEEDED==="Wood Hall"){
    
    //Create an array of Residence Halls & Complexes.
    $residenceBUILDINGS = array("Wood - A","Wood - B");
    
       
    //Get information from the database  -- 04-17-2015
        include('utilities/readRoomAvail_detailed_list.php');
    //End get information from the database -- 04-17-2015
    
    }
    else if($buildingDETAIL_NEEDED==="Wolf Village"){
    //Create an array of Residence Halls & Complexes.
    $residenceBUILDINGS = array("Wolf Vlg A","Wolf Vlg B","Wolf Vlg C","Wolf Vlg D","Wolf Vlg E","Wolf Vlg F","Wolf Vlg G","Wolf Vlg H");
    //Set up array.
    //$initial_bed_count=array("Wolf Vlg A"=>"160","Wolf Vlg B"=>"160","Wolf Vlg C"=>"144","Wolf Vlg D"=>"132","Wolf Vlg E"=>"160","Wolf Vlg F"=>"160","Wolf Vlg G"=>"127","Wolf Vlg H"=>"144");
    
    
    //Get information from the database  -- 04-17-2015
        include('utilities/readRoomAvail_detailed_list.php');
    //End get information from the database -- 04-17-2015
    
    }
    else if($buildingDETAIL_NEEDED==="Wolf Ridge"){    
    //Create an array of Residence Halls & Complexes.
    $residenceBUILDINGS = array("WR Grove","WR Innovat","WR Lakevw","WR Plaza","WR Tower","WR Valley");
    //Set up array.
    //$initial_bed_count=array("WR Grove"=>"140","WR Innovat"=>"216","WR Plaza"=>"220","WR Lakevw"=>"145","WR Tower"=>"235","WR Valley"=>"202");
    
    //Get information from the database  -- 04-17-2015
        include('utilities/readRoomAvail_detailed_list.php');
    //End get information from the database -- 04-17-2015
    }    
    else{
        $residenceBUILDINGS=array("");
    }
    
    //Get the date that we need from the option block that is currently residing on line(s) 50-65.
    //$dateNEEDED = "2015-03-12";
    
    $dateNEEDED = $_GET["dateREQUESTED"];
    
    //Get Begin Date
    $beginDATENEEDED ="2015-03-16";
    //Get End Date
    $endDATENEEDED = "2015-03-22";  
    
    
    //START
    //Provide all Information FOR THE ENTIRE WEEK THAT WE CAN USE ON OUR CHART.
    include('completeTOTALSforGraph.php');
    //END    
    
    if($dateNEEDED==="allDATES"){
          foreach ($residenceBUILDINGS as $residenceNAME){                       
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
                                                            include('endcells/endcell_buildinglookup_alldates.php');
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
                                                            include('endcells/endcell_buildinglookup_alldates.php');
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
                                                        include('endcells/endcell_buildinglookup_alldates.php');
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

    }
    else{
    
    //Provide a table that displays the individual results of each residence hall for a particular day that is selected by the drop-down list.
    foreach ($residenceBUILDINGS as $residenceNAME){
                       
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
                                echo $residence;                                                       
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
                                //This end cell is going to be different because the basic endcell.php looks for residence_groups in the 
                                //housing database, this other version, endcell_buildinglookup.php will adjust the sql query accordingly.
                                //include('endcell.php');
                                include('endcells/endcell_buildinglookup.php');
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
                            echo "<td class='bed_information'>";
                            echo $amount_left;
                            echo "</td>";
                            
                            //Display the information in the next adjacent cell.
                            //Display the percentages of occupancy here.
                            echo "<td class='bed_information'>";
                            echo $percentage_occupied;
                            echo "</td>";
                            
                            //Clear total Results for a New Row.
                            $totalResults=0;                            
                         //Close Data Row
                         echo "</tr>";
                        }//close for each
    
    } //Close else statement                    
                        
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
    
    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
           //{
           //echo $row["id"]." ".$row["residence"]."".$row["cardswipe"]." ".$row["date_of_swipe"]." ".$row["time_of_swipe"]." ".$row["key_code"].$row["cellphone_new"];
           //echo "<br/>";
          // }
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

<!--<p>Chart Options</p>
<input type='button' id='displayChart' value='Display Area Chart'><input type='button' id='hideChart' value='Hide Area Chart'>-->
<div id='overview_of_results'>
    
    <p>
         Overview of the Day-to-Day Check in: <br/>
         <br/>
         Weekly Overview <br/>
        Monday, March 09 - Sunday March 15
       
        
     </p>
     
     
     <div id="chart_div" style="width: 900px; height: 500px;"></div>
</div>


</body>
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

var initialbed_allotment=0.0;



//Calculate the total amount of beds that we have to utilize 
//from the very beginning before any are taken away.
$('#initial_bed_number ' ).each(function(){
    val = parseFloat($(this).html());
    if (val > 0){
        initialbed_allotment+= val;        
        console.log(initialbed_allotment);
        
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

//5:01-12:00mid time period:
$('#total_area10').html(total_17);

//Complete totals.
$('#total_area11').html(completeTOTAL);



//Create a total of the initial bed number
$('#total_initial_bed_allotment').html(initialbed_allotment);
//End the display of the total amount of initial beds that we have.


//END END END END
//End display results.

</script>


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
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }


</script>

<html>
