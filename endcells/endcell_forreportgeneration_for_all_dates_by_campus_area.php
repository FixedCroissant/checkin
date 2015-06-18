<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Retrieve the time that we need to start information.
$timeBEGIN=$group1_RESIDENCE->getBeginTime();
//Retreive the time we need to end the list.
$timeEND = $group1_RESIDENCE->getEndTime(); 

//The SQL is changed, as for this particular lookup, we need to retrieve check-ins for a campus area, not a particular
//residence hall.
//E.g. getSQLNeededforDateRange() ==> this provides us with the date range (With a provided Start Date and an End Date and a given Residence location, Alexander,
//Lee, Sullivan, Wolf Ridge Apartments, Wolf Village Apartments)
//E.g. getSQLNeededforDateRange_CampusArea() ==> this provides us with the date range (With a provided Start Date and a provided End Date and a given central area, 
// east, west, apt, etc.

$sql=$group1_RESIDENCE->getSQLNeededforDateRange_CampusArea();
    
//Create Statement
$statement = $conn->prepare($sql);  

//Begin Binding Variables
//Set Campus Area, instead of setting a particular residence or building name.
$statement->bindParam(1,$campusarea);

$statement->bindParam(2,$dateNEEDED_BEGIN);
  
//End Date
$statement->bindParam(3,$dateNEEDED_END);

//Beginning Time
$statement->bindParam(4,$timeBEGIN);


//Ending Time
$statement->bindParam(5,$timeEND);


//End Bind Variables.      
    
//Execute Statements (single query)
$statement->execute();  


$row_count = $statement->rowCount();

//Close Data Cell
//echo "</td>";