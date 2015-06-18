<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('../mysql/housing_apps_db_pdo.php');
//New Get Info
include('checkinPopulation.php');
 
 $group1_RESIDENCE = new checkinPopulation();
 
 //NEW PDO Connection
 $conn = new PDO($hostname,$username,$password);
?>

<html>
<head>
<title>
University Housing - Welcome Week Sign Up
</title>
<!--jQuery Import - minified-->
<script src='//code.jquery.com/jquery-1.11.1.min.js' type='text/javascript'></script>
<!--jQuery DataTable script-->
<script src='//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js' type='text/javascript'></script>
<!--jQuery DataTable CSS Import -->
<link rel='stylesheet' type='text/css' href='//cdn.datatables.net/1.10.4/css/jquery.dataTables.css'>
<link rel='stylesheet' type='text/css' href='css/report.css'>
<!--Fav Icon-->
<link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
</head>
<body>
<script type="text/javascript">
$(document).ready(function() {
    $('#welcome_week_checkin').DataTable(
            {
             "paging": false,
             "searching":false
            }                
                );
} );
</script>
<br/>
<br/>
<p><img src="https://housing.ncsu.edu/secure/images/logo.png" alt="University Housing logo" title="NC State University Housing" /></p>
<div id = "header"><h4>Welcome Week Report of Students</h4>
</div>
<table id="welcome_week_checkin" border="1" align="center">
 <thead>
 
 <th>
     Resident Location
 </th>
  <!--Arrival Time-->
 <th>
    Resident Last Name
 </th>    
 <!--8:00-9:00-->
 <th>
     Resident First Name
 </th>
  <th>
     Check In Date
 </th>
 <th>
     Check In Time
 </th>
 
</thead>   
<tbody>    
    
    <?php
    //Variables
    //$residenceNAME=$_GET["residence"];
    $campusarea=$_GET["central_location"];
    $beginTIMEBEGIN=$_GET["beginTIME"];
    $endTIMESTOP=$_GET["endTIME"];
    //Start Date Range
    $dateNEEDED_BEGIN=$_GET["dateNEEDEDSTART"];
    $dateNEEDED_END=$_GET["dateNEEDEDEND"];
    
    //End Date Range
    //$residenceNAME="Alexander Hall";
    //This is where we BEGIN looking for people whoe came in at a certain time.
    //$beginTIMEBEGIN="11";
    //This is where we STOP looking for people who came in at a certain time.
    //$endTIMESTOP="12";
    //$dateNEEDED=$_GET["dateNEEDED"];
                        //Set Residence Hall (Not needed on this report).
                        //$group1_RESIDENCE->setResidenceHall($residenceNAME);    
        
                        //Set Date we need.
                        //$group1_RESIDENCE->setDateNeeded($dateNEEDED);
                        
                        //Set Date Begin and Date End
                        $group1_RESIDENCE->setDateNeededRange($dateNEEDED_BEGIN,$dateNEEDED_END);
                        
                                               
                        //Use this residence variable that will be passed to our report generation.
                        $residence = $group1_RESIDENCE->getResidenceHall();
                        
                        
                        //Testing information
//                        echo "<p>";
//                        echo "<h4>TEST INFORMATION</h4>";
//                        echo $residence;
//                        echo "<br>";
//                        echo $dateNEEDED_BEGIN;
//                        echo "<br>";
//                        echo $dateNEEDED_END;
//                        echo "<br>";
//                        echo $beginTIMEBEGIN;
//                        echo "<br>";
//                        echo $endTIMESTOP;
//                        echo "<br>";
//                        echo "<strong>END test information</strong>";
//                        echo "<br>";
//                        echo "</p>";
                        
                        
                        
                        
                       //Use this dateNEEDEDFORREPORT variable that will be passed to our report generation.
                        //$dateNEEDEDFORREPORT=$group1_RESIDENCE->getDateNeeded();
                        
                        $dateNEEDEDFORREPORT=$group1_RESIDENCE->getDateNeeded();
                        

                        //Start at 8  and go to 9
                        for($x=$beginTIMEBEGIN;$x<$endTIMESTOP;$x++){
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
                            //Set Times for this Location.
                            $group1_RESIDENCE->setBeginTime($beginTIME);
                            $group1_RESIDENCE->setEndTime($endTIME);

                        }//Closing the "FOR" statement on line 116.  
                            
                          //Close the cell off
                        include('endcell_forreportgeneration_for_all_dates_by_campus_area.php');  
                       
                        //Just for testing
                        //var_dump($statement);
                        
                        /*
                        //Display the total amount of returned values.
                        echo "Location: ".$residence;
                        echo "<br/>";
                        echo "Time Range:";
                        echo "<br/>";
                        echo "Begin Date:" . $dateNEEDED_BEGIN;
                        echo "<br/>";
                        echo "End Date:" . $dateNEEDED_END;
                        echo "<br/>";
                        
                        */
                        
                        //Change the begin time to a temporary value that makes sense
                        //to the end user.
                        
                        //Begin Times
                        $easiertoReadTime;
                        
                        //End Times
                        $easiertoReadTimeENDING;
                        /*
                        if ($beginTIMEBEGIN==0){
                            $easiertoReadTime="12:00 am";
                        }
                        if ($beginTIMEBEGIN==1){
                            $easiertoReadTime="01:00 am";
                        }
                        
                        
                        //End Times
                        if ($endTIMESTOP==8){
                            $easiertoReadTimeENDING="08:00 am";
                        }
                       
                        
                        
                        
                        echo "Beginning Time: ". $easiertoReadTime;
                        echo "<br/>";
                        echo "Ending Time: ". $easiertoReadTimeENDING;
                         */
                        
                        
                        
                        while ($row = $statement->fetch(PDO::FETCH_ASSOC)){
                                        echo "<td>".$row["residence"]."</td>"."<td>".$row["resident_lname"]."</td>"."<td>".$row["resident_fname"]."</td>"."<td>".$row["date_of_swipe"]."</td>"."<td>".$row["time_of_swipe"]."</td>";;
                                        echo "</tr>";
                        }
                         
                         
                         
                           
                            
                         //Close Data Row
                         echo "</tr>";
 ?>      
   

    
</tbody>   
    
<?php

//Close PDO connection
$conn = null;
?>
</tbody>
</table>
</body>
<html>
