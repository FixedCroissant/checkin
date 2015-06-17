<!DOCTYPE html>
<!--
Author: J. Williams
Date: June 08, 2015
Description: A piece of the check-in application that pulls building capacity numbers from PeopleSoft's View and puts the result
in a array. This version is specific to the Fraternity & Sorority Life properties on campus.

The following buildings will be tallied:

1.) GV01 - Lambda Chi Alpha             (REQUESTED)
2.) GV02 - Sigma Kappa                  (REQUESTED)
3.) GV03 - Kappa Alpha                  (REQUESTED)
4.) GV04 - Delta Zeta                   (REQUESTED)
5.) GV05 - Phi Gamma Delta              (NOT REQUESTED)
6.) GV07 - Sigma Phi Epsilon            (REQUESTED)
7.) GV08 - Alpha Delta Pi               (REQUESTED)
8.) GV 11- Kappa Sigma                  (REQUESTED)
9.) GV 12 - Delta Gamma                 (REQUESTED)
10.) GV 13 - Kappa Alpha Theta          (REQUESTED)
11.) GV 14 - Pi Beta Phi                (REQUESTED)
12.) GV 15 - Alpha Tau Omega            (NOT REQUESTED)
13.) GV 16 - Sigma Phi Epsilon          (REQUESTED)
14.) GV2A - Sigma Nu                    (NOT REQUESTED -- DOES NOT MONITOR THEIR CHECK-IN PROCESS)
15.) GV2C - Kappa Delta                 (NOT REQUESTED -- DOES NOT MONITOR THEIR CHECK-IN PROCESS)




//LEGEND

Grk Vlg-01 	GV01 - Lambda Chi Alpha 	
Grk Vlg-02 	GV02 - Sigma Kappa 	 	
Grk Vlg-03 	GV03 - Kappa Alpha 	 	
Grk Vlg-04 	GV04 - Delta Zeta 	 	
Grk Vlg-05 	GV05 - Phi Gamma Delta 	 	
Grk Vlg-07 	GV07 - Sigma Phi Epsilon 	 	
Grk Vlg-08 	GV08 - Alpha Delta Pi 	 	
Grk Vlg-09 	GV09 - Demolished 	 	
Grk Vlg-11 	GV11 - Kappa Sigma 	 	
Grk Vlg-12 	GV12 - Delta Gamma 	 	
Grk Vlg-13 	GV13 - Kappa Alpha Theta 	
Grk Vlg-14 	GV14 - Pi Beta Phi 	 	 	
Grk Vlg-15 	GV15 - Alpha Tau Omega 	 	
Grk Vlg-16 	GV16 - Sigma Phi Epsilon 	
Grk Vlg-2A 	GV2A - Sigma Nu 	 	
Grk Vlg-2C 	GV2C - Kappa Delta 	
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>NCSU Housing Availability</title>
</head>
<body>
<?php

//When included with the overview.php
//Used for testing
//include('db/oracleconnect.php');

//When running by itself.
//include('../db/oracleconnect.php');

//When Running in Production environment
//Using CS900rpt; day old information.
//REPORTING INFORMATION
//comment out 05-12-2015; 1:14pm
//include('../../mysql/psdb.php');

//PRODUCTION INFORMATION
//Using on 5-12-2015; 1:14pm
include('psdb-PROD.php');

//Trying PRE side on April 27, 2015.
//include('psdb-PRE.php');


//Pull all data from the fake room_availability table.
//Note:This availability is only in a test environment, need to get the correct view to get building views.
//$query="SELECT * FROM ROOM_AVAILABILITY";

//Production Query, as of April 23, 2015, @3:30p this table does not exist in production.
//Still not able to access as of 4/27/2015, @ 8:04am.
//Gained access on 5-12-2015 at 1:15pm
////$query="SELECT * FROM PS_NC_HIS_PPE_VW WHERE NC_LAST_NAME_PRI LIKE :lname";
$query = "SELECT * FROM PS_NC_HIS_BLCNT_VW WHERE BUILDING LIKE 'Grk%'";

//Make the connection with the new query.
//Note: Below is used for a testing environment
//$statement=oci_parse($connPS,$query);

//Production Environment Connection, $psconnect is used for a production environment.
$statement=oci_parse($psconnect,$query);
//End Production  Environment Connection

//Execute the query.
oci_execute($statement);

//echo "<p>";
//echo "This is what is currently in the database view:";
//echo "</p>";

//Commented out on 06 08 2015.
//$initial_bed_count=array("Alexander Hall"=>"","Avent Ferry"=>"","Bagwell Hall"=>"","Becton Hall"=>"","Berry Hall"=>"","Bowen Hall"=>"","Bragaw Hall"=>"","Carroll Hall"=>"","Gold Hall"=>"","Lee Hall"=>"","Metcalf Hall"=>"","North Hall"=>"","Owen Hall"=>"","Sullivan Hall"=>"","Syme Hall"=>"","Tucker Hall"=>"","Turlington Hall"=>"","Watauga Hall"=>"","Welch Hall"=>"","Wood Hall"=>"","Wolf Village"=>"","Wolf Ridge"=>"");

//Fraternity & Sorority Life Building Numbers
$initial_bed_count = array("Grk Vlg-01"=>"","Grk Vlg-02"=>"","Grk Vlg-03"=>"","Grk Vlg-04"=>"","Grk Vlg-05"=>"","Grk Vlg-05"=>"","Grk Vlg-07"=>"","Grk Vlg-08"=>"","Grk Vlg-09"=>"","Grk Vlg-11"=>"","Grk Vlg-12"=>"","Grk Vlg-13"=>"","Grk Vlg-14"=>"","Grk Vlg-15"=>"","Grk Vlg-16"=>"");


$condenced_buildings_bed_count=array();

//We are going need 4 different arrays to hold the condenced
//values of each separate rooms.

$building_names=array();

while($row=  oci_fetch_assoc($statement)){
    //Assign the building name as the correct array key and the contents
    //of the array will be the availability of the building.
    //NOTE 05-12-2015: Unlike my test environment, the column in in production with the actual room numbers is called "COUNT1", in my test environment
    //it is called "AVAILABILITY".
    $building_names[$row["BUILDING"]]=$row["COUNT1"];

    //below is just for testing purposes only.
    //Commented out on 05-12-2015.
    //var_dump($building_names);
}

//Array Manipulation Here
foreach ($building_names as $availability =>$x_value){
   /*
    if($availability==="Alexander"){
        $initial_bed_count["Alexander Hall"]=$x_value;
    }
	*/

    //End consolidation of buildings: Avent Ferry Complex, Wood Hall, Wolf Ridge and Wolf Village Apartments
    if($availability==="Grk Vlg-01"){
        $initial_bed_count["Lambda Chi Alpha"]=$x_value;
    }
	if($availability==="Grk Vlg-02"){
        $initial_bed_count["Sigma Kappa"]=$x_value;
    }
	if($availability==="Grk Vlg-03"){
        $initial_bed_count["Kappa Alpha"]=$x_value;
    }
	if($availability==="Grk Vlg-04"){
        $initial_bed_count["Delta Zeta"]=$x_value;
    }
	if($availability==="Grk Vlg-05"){
        $initial_bed_count["Phi Gamma Delta"]=$x_value;
    }
	if($availability==="Grk Vlg-07"){
        $initial_bed_count["Sigma Phi Epsilon"]=$x_value;
    }
	if($availability==="Grk Vlg-08"){
        $initial_bed_count["Alpha Delta Pi"]=$x_value;
    }
	//Grk Vlg-09 == demolished
	//Commented out on 06 11 2015.
	/*
	if($availability==="Grk Vlg-09"){
        $initial_bed_count["Demolished"]=$x_value;
    }*/
	if($availability==="Grk Vlg-11"){
        $initial_bed_count["Kappa Sigma"]=$x_value;
    }
	if($availability==="Grk Vlg-12"){
        $initial_bed_count["Delta Gamma"]=$x_value;
    }
	if($availability==="Grk Vlg-13"){
        $initial_bed_count["Kappa Alpha Theta"]=$x_value;
    }
	if($availability==="Grk Vlg-14"){
        $initial_bed_count["Pi Beta Phi"]=$x_value;
    }
	
	//In MyPack Portal, Greek Village House 15 is Alpha Tau Omega
	//Per Josh Welch's e-mail 4/28/2015, House 15 is Sigma Alpha Epsilon
	if($availability==="Grk Vlg-15"){
		//This is what is in myPackPortal
        /*$initial_bed_count["Alpha Tau Omega"]=$x_value;*/
		//Per J. Welch.
		$initial_bed_count["Sigma Alpha Epsilon"]=$x_value;
    }
	if($availability==="Grk Vlg-16"){
        $initial_bed_count["Sigma Phi Epsilon"]=$x_value;
    }

}//Close For Each


//Read the new "condenced buildings array"

//foreach($condenced_buildings_bed_count as $condenced_BUILDINGTOTALS){
//    echo $condenced_BUILDINGTOTALS;
//    echo "<br/>";
//}
//End read the new condenced buildings array

//Attach the summation of the building numbers to the building name array.

//Add to Avent Ferry Complex
//$initial_bed_count["Avent Ferry"]=array_sum($condenced_buildings_bed_count);

//Get the sum of the array and print out the correct summation.
//echo "This is the total that is in the array that is holding Avent Ferry:".array_sum($condenced_buildings_bed_count);

//var_dump($initial_bed_count);

//var_dump($condenced_buildings_bed_count);


//End array Manipulation





//List what is currently in each building, based of the index
//set by the
//Comment out on 5-12-2015.

//foreach ($initial_bed_count as $availability =>$x_value){
//   echo $availability.",".$x_value;
//    echo "<br/>";
//   }

?>
</body>
</html>
