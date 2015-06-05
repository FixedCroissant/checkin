<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
    
   $timeBEGIN=$group1_RESIDENCE->getBeginTime();
   $timeEND = $group1_RESIDENCE->getEndTime(); 
   
   $sql=$group1_RESIDENCE->getSQLProvideBuilding();
    
   //Create Statement
   $statement = $conn->prepare($sql);  
   
   ////Bind Variables
   //Set Residence Hall
   $statement->bindParam(1,$residence);
   
   //Set the Date We need
   $statement->bindParam(2,$date_needed);   

    //Set the Beginning Time
   $statement->bindParam(3,$timeBEGIN);
   //Set the Ending Time
   $statement->bindParam(4,$timeEND);
   //End Bind Variables.      
    
   //Execute Statements (single query)
   $statement->execute();   
   
    //Get Row Count based on the statement above
    $rowCount = $statement ->rowCount();
    $rowCountArray = Array($rowCount);
    
    //Provide a value that is going to handle the total results that we add 
    //at the very last column. This integer will only increment up if 
    //there is at least 1 row returned.
    global $totalResults;
    
    if($rowCount>=1){
        //Add to the total results how many returned results we have, so we can keep a running
        //total.
        $totalResults=($totalResults+$rowCountArray[0]);
    }

    //$number_of_rows=count($rowCount);
    if($rowCount>=1){
        //Set link to find the specific information necessary.
        
        
        //Will need to re-route the information from building name (i.e. AFC - A, AFC - B, to Avent Ferry
        /*Avent Ferry Complex*/
        if($residence==="AFC - A"||$residence==="AFC - B"||$residence==="AFC - C"){
             $residenceLOCATION="Avent Ferry";
        }
        /*Wood Hall*/
        if($residence==="Wood - A"||$residence==="Wood - B"){
             $residenceLOCATION="Wood Hall";
        }
        
        /*Wolf Ridge*/
        if($residence==="WR Grove"||$residence==="WR Innovat"||$residence==="WR Lakevw"||$residence==="WR Plaza"||$residence==="WR Tower"||$residence==="WR Valley"){
             $residenceLOCATION="Wolf Ridge";
        }
        /*Wolf Village*/
        if($residence==="Wolf Vlg A"||$residence==="Wolf Vlg B"||$residence==="Wolf Vlg C"||$residence==="Wolf Vlg D"||$residence==="Wolf Vlg E"||$residence==="Wolf Vlg F"||$residence==="Wolf Vlg G"||$residence==="Wolf Vlg H"){
             $residenceLOCATION="Wolf Village";
        }
        
        
        
        //Provide Residence location for the link that we will generate with the number.
        //$residenceLOCATION=$residence;
        
       //Trim characters so that we can just focus on the first two digits of the number.
        $timeBEGINforReport = substr($timeBEGIN,0,2);
        $timeENDforReport = substr($timeEND,0,2);
        
       
        
        if($timeBEGINforReport>=10){
                $timeBEGINforReport = substr($timeBEGIN,0,2);
                $timeENDforReport = substr($timeEND,0,2);
        }
        else if($timeBEGINforReport<10&&$timeENDforReport<10){
                $timeBEGINforReport = substr($timeBEGIN,1,1);
                $timeENDforReport = substr($timeEND,1,1);
        }        
        else if($timeBEGINforReport<10){
                $timeBEGINforReport = substr($timeBEGIN,1,1);
        }
        else if($timeENDforReport<10){
                $timeENDforReport = substr($timeEND,1,1);
        }
        else if($timeENDforReport<10){
                $timeBEGINforReport = substr($timeBEGIN,1,1);
                $timeENDforReport = substr($timeEND,1,1);
        }
        else if($timeENDforReport>=10){
                $timeBEGINforReport = substr($timeBEGIN,0,2);
                $timeENDforReport = substr($timeEND,0,2);
        }        
    
        echo "<a href='http://localhost/apps/checkin/report.php?residence=".$residenceLOCATION."&dateNEEDED=".$date_needed."&beginTIME=".$timeBEGINforReport."&&endTIME=".$timeENDforReport."' target='_blank')'>$rowCountArray[0]</a>";
        
        
        }
    //If there are no rows; why would we want to put a link. It wouldn't go any
    //where.
    else{
        echo $rowCountArray[0];        
    }    
     
    //Close Data Cell
     echo "</td>";