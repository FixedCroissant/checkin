<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$timeBEGIN=$group1_RESIDENCE->getBeginTime();
$timeEND = $group1_RESIDENCE->getEndTime(); 
   
$sql=$group1_RESIDENCE->getSQLNeededforDateRange();
    
//Create Statement
$statement = $conn->prepare($sql);  

//Begin Binding Variables
//Residence Hall

$statement->bindParam(1,$residence);

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