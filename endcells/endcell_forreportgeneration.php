<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$timeBEGIN=$group1_RESIDENCE->getBeginTime();
$timeEND = $group1_RESIDENCE->getEndTime(); 
   
$sql=$group1_RESIDENCE->getSQL();
    
//Create Statement
$statement = $conn->prepare($sql);  

////Bind Variables
//Residence Hall
$statement->bindParam(1,$residence);
   
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