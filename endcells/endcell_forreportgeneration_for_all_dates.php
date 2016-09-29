<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 
 
 //Handle Incoming Residence Areas.
 //Function handles single encoded non-space residence halls from messing up
 //the SQL result.
 //@param string residence hall name.
 function renameHalls($residenceHall){
 	 
 if($residenceHall==="AlexanderHall"){
	 return "Alexander Hall";
 }
 if($residenceHall==="AventFerry"){
	 return "Avent Ferry";
 }
 if($residenceHall==="BagwellHall"){
	 return "Bagwell Hall";
 }
 if($residenceHall==="BectonHall"){
	 return "Becton Hall";
 }
 if($residenceHall==="BerryHall"){
	 return "Berry Hall";
 }
 if($residenceHall==="BowenHall"){
	 return "Bowen Hall";
 }
 if($residenceHall==="BragawHall"){
	 return "Bragaw Hall";
 }
 if($residenceHall==="CarrollHall"){
	 return "Carroll Hall";
 }
 if($residenceHall==="GoldHall"){
	 return "Gold Hall";
 }
 if($residenceHall==="LeeHall"){
	 return "Lee Hall";
 }
 if($residenceHall==="MetcalfHall"){
	 return "Metcalf Hall";
 }
 if($residenceHall==="NorthHall"){
	 return "North Hall";
 }
 if($residenceHall==="OwenHall"){
	 return "Owen Hall";
 }
 if($residenceHall==="SullivanHall"){
	 return "Sullivan Hall";
 }
 if($residenceHall==="SymeHall"){
	 return "Syme Hall";
 }
 if($residenceHall==="TuckerHall"){
	 return "Tucker Hall";
 }
 if($residenceHall==="TurlingtonHall"){
	 return "Turlington Hall";
 }
 if($residenceHall==="WataugaHall"){
	 return "Watauga Hall";
 }
 if($residenceHall==="WelchHall"){
	 return "Welch Hall";
 }
 if($residenceHall==="WoodHall"){
	 return "Wood Hall";
 }
 if($residenceHall==="WolfVillage"){
	 return "Wolf Village";
 }
 if($residenceHall==="WolfRidge"){
	 return "Wolf Ridge";
 } 
 else{
	 //for the total columns...
	 //Nothing...
	 return $residenceHall;
 }
 }
 
 
 //Use the function created above.
 $residenceConverted=renameHalls($residence);
 
 
 
$timeBEGIN=$group1_RESIDENCE->getBeginTime();
$timeEND = $group1_RESIDENCE->getEndTime(); 
   
$sql=$group1_RESIDENCE->getSQLNeededforDateRange();
    
//Create Statement
$statement = $conn->prepare($sql);
//Begin Binding Variables
//Residence Hall
$statement->bindParam(1,$residenceConverted);
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
