<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$timeBEGIN=$group1_RESIDENCE->getBeginTime();
$timeEND = $group1_RESIDENCE->getEndTime(); 

//Change to get the centralized campus areas and not the residence groups.
$sql=$group1_RESIDENCE->getSQLFORCENTRALCAMPUSSEARCH();
    
//Create Statement
$statement = $conn->prepare($sql);  

////Bind Variables
//Campus Area, East, Central, West, Apartment, etc.
//
//$statement->bindParam(1,$residence);

$statement->bindParam(1,$campusarea);

//Set the Date We need
$statement->bindParam(2,$dateNEEDEDFORREPORT);
   
//Beginning Time
$statement->bindParam(3,$timeBEGIN);
//Ending Time
$statement->bindParam(4,$timeEND);
//End Bind Variables.      
    
//Execute Statements (single query)
$statement->execute();  
     
//Close Data Cell
//echo "</td>";