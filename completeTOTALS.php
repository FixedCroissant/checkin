<?php 
   
   $sql=$group_TOTAL_PICTURE->getSQLNotSpecific();
    
   //Create Statement
   $statement = $conn->prepare($sql);
      
    
   //Execute Statements (single query)
   $statement->execute();   
   
    //Get Row Count based on the statement above
    $rowCount = $statement ->rowCount();
    $rowCountArray = Array($rowCount);
    
    //Provide a value that is going to handle the total results that we add 
    //at the very last column. This integer will only increment up if 
    //there is at least 1 row returned.
    global $totalResultsFORALL;
    
    $totalResultsFORALL=$rowCount;
    
    //echo "This is the total result for all".$totalResultsFORALL;
    
    //Array to house Tuesday's Information
    $mondayINFO = array();
    $tuesdayINFO = array();
    $wednesdayINFO= array();
    $thursdayINFO= array();
    $fridayINFO = array();
    $saturdayINFO = array();
    $sundayINFO = array();   
    
   
    
    //Counts
    $countFORMONDAY=0;
    $countFORTUESDAY=0;
    $countFORWEDNESDAY=0;
    $countFORTHURSDAY=0;
    $countFORFRIDAY=0;
    $countFORSATURDAY=0;
    $countFORSUNDAY=0;
    
    //Display the results of everything.
    while($row=$statement->fetch(PDO::FETCH_ASSOC)){        
        //Get Monday's Information
        if($row["date_of_swipe"]==="2015-03-16"){
                    //echo $row["residence"]."  ".$row["date_of_swipe"];
                    //echo "<br/>";  
                   $countFORMONDAY++;                 
                   
                   $mondayINFO[] = $row["residence_group"];
        }

        //Get Tuesday's Information
        if($row["date_of_swipe"]==="2015-03-17"){
            $countFORTUESDAY++;
                   $tuesdayINFO[]=$row["residence_group"];
        }        
        
        //Get Wednesday's Information
        if($row["date_of_swipe"]==="2015-03-18"){
                $countFORWEDNESDAY++;
                    $wednesdayINFO[]=$row["residence_group"];
        }
        
        //Get Thursday's Information
        if($row["date_of_swipe"]==="2015-03-19"){
            $countFORTHURSDAY++;
                    $thursdayINFO[]=$row["residence_group"];
        }
        
        //Get Friday's Information
        if($row["date_of_swipe"]==="2015-03-20"){
                    //echo $row["residence_group"]."  ".$row["date_of_swipe"];
                    //echo "<br/>"; 
                    
                    $countFORFRIDAY++;
                    $fridayINFO[]=$row["residence_group"];
        }
        
        //Get Saturday's Information
        if($row["date_of_swipe"]==="2015-03-21"){
            $countFORSATURDAY++;
                    $saturdayINFO[]=$row["residence_group"];
        }
        
        //Get Sunday's Information
        if($row["date_of_swipe"]==="2015-03-22"){
            $countFORSUNDAY++;
                    $sundayINFO[]=$row["residence_group"];
        }
    }//End While Statement
        
        //Create an Array that just houses the names of the Residence Halls.
        $residenceHALLNAMES=array("Alexander Hall","Avent Ferry","Bagwell Hall","Becton Hall","Berry Hall","Bowen Hall","Bragaw Hall","Carroll Hall","Gold Hall","Lee Hall","Metcalf Hall","North Hall","Owen Hall","Sullivan Hall","Syme Hall","Tucker Hall","Turlington Hall","Watauga Hall","Welch Hall","Wood Hall");
        
        //Create INITIAL Array with NOTHING in the counts
        $mondayCounts = array("Alexander Hall"=>0,"Avent Ferry"=>0,"Bagwell Hall"=>0,"Becton Hall"=>0,"Berry Hall"=>0,"Bowen Hall"=>0,"Bragaw Hall"=>0,"Carroll Hall"=>0,"Gold Hall"=>0,"Lee Hall"=>0,"Metcalf Hall"=>0,"North Hall"=>0,"Owen Hall"=>0,"Sullivan Hall"=>0,"Syme Hall"=>0,"Tucker Hall"=>0,"Turlington Hall"=>0,"Watauga Hall"=>0,"Welch Hall"=>0,"Wood Hall"=>0,"Wolf Village"=>0,"Wolf Ridge"=>0);
        $tuesdayCounts = array("Alexander Hall"=>0,"Avent Ferry"=>0,"Bagwell Hall"=>0,"Becton Hall"=>0,"Berry Hall"=>0,"Bowen Hall"=>0,"Bragaw Hall"=>0,"Carroll Hall"=>0,"Gold Hall"=>0,"Lee Hall"=>0,"Metcalf Hall"=>0,"North Hall"=>0,"Owen Hall"=>0,"Sullivan Hall"=>0,"Syme Hall"=>0,"Tucker Hall"=>0,"Turlington Hall"=>0,"Watauga Hall"=>0,"Welch Hall"=>0,"Wood Hall"=>0,"Wolf Village"=>0,"Wolf Ridge"=>0);
        $wednesdayCounts = array("Alexander Hall"=>0,"Avent Ferry"=>0,"Bagwell Hall"=>0,"Becton Hall"=>0,"Berry Hall"=>0,"Bowen Hall"=>0,"Bragaw Hall"=>0,"Carroll Hall"=>0,"Gold Hall"=>0,"Lee Hall"=>0,"Metcalf Hall"=>0,"North Hall"=>0,"Owen Hall"=>0,"Sullivan Hall"=>0,"Syme Hall"=>0,"Tucker Hall"=>0,"Turlington Hall"=>0,"Watauga Hall"=>0,"Welch Hall"=>0,"Wood Hall"=>0,"Wolf Village"=>0,"Wolf Ridge"=>0);
        $thursdayCounts = array("Alexander Hall"=>0,"Avent Ferry"=>0,"Bagwell Hall"=>0,"Becton Hall"=>0,"Berry Hall"=>0,"Bowen Hall"=>0,"Bragaw Hall"=>0,"Carroll Hall"=>0,"Gold Hall"=>0,"Lee Hall"=>0,"Metcalf Hall"=>0,"North Hall"=>0,"Owen Hall"=>0,"Sullivan Hall"=>0,"Syme Hall"=>0,"Tucker Hall"=>0,"Turlington Hall"=>0,"Watauga Hall"=>0,"Welch Hall"=>0,"Wood Hall"=>0,"Wolf Village"=>0,"Wolf Ridge"=>0);
        $fridayCounts = array("Alexander Hall"=>0,"Avent Ferry"=>0,"Bagwell Hall"=>0,"Becton Hall"=>0,"Berry Hall"=>0,"Bowen Hall"=>0,"Bragaw Hall"=>0,"Carroll Hall"=>0,"Gold Hall"=>0,"Lee Hall"=>0,"Metcalf Hall"=>0,"North Hall"=>0,"Owen Hall"=>0,"Sullivan Hall"=>0,"Syme Hall"=>0,"Tucker Hall"=>0,"Turlington Hall"=>0,"Watauga Hall"=>0,"Welch Hall"=>0,"Wood Hall"=>0,"Wolf Village"=>0,"Wolf Ridge"=>0);
        $saturdayCounts = array("Alexander Hall"=>0,"Avent Ferry"=>0,"Bagwell Hall"=>0,"Becton Hall"=>0,"Berry Hall"=>0,"Bowen Hall"=>0,"Bragaw Hall"=>0,"Carroll Hall"=>0,"Gold Hall"=>0,"Lee Hall"=>0,"Metcalf Hall"=>0,"North Hall"=>0,"Owen Hall"=>0,"Sullivan Hall"=>0,"Syme Hall"=>0,"Tucker Hall"=>0,"Turlington Hall"=>0,"Watauga Hall"=>0,"Welch Hall"=>0,"Wood Hall"=>0,"Wolf Village"=>0,"Wolf Ridge"=>0);
        $sundayCounts = array("Alexander Hall"=>0,"Avent Ferry"=>0,"Bagwell Hall"=>0,"Becton Hall"=>0,"Berry Hall"=>0,"Bowen Hall"=>0,"Bragaw Hall"=>0,"Carroll Hall"=>0,"Gold Hall"=>0,"Lee Hall"=>0,"Metcalf Hall"=>0,"North Hall"=>0,"Owen Hall"=>0,"Sullivan Hall"=>0,"Syme Hall"=>0,"Tucker Hall"=>0,"Turlington Hall"=>0,"Watauga Hall"=>0,"Welch Hall"=>0,"Wood Hall"=>0,"Wolf Village"=>0,"Wolf Ridge"=>0);
        
        
        //Update the above array with information provided with the database lookup.
        //Monday
        $mondayCountsTEMP=array_count_values($mondayINFO);
        $mondayCountsFilled =array_merge($mondayCounts,$mondayCountsTEMP);
        //Tuesday
        $tuesdayCountsTEMP=array_count_values($tuesdayINFO);
        $tuesdayCountsFilled=array_merge($tuesdayCounts,$tuesdayCountsTEMP);
        //Wednesday        
        $wednesdayCountsTEMP=array_count_values($wednesdayINFO);
        $wednesdayCountsFilled=array_merge($wednesdayCounts,$wednesdayCountsTEMP);        
        //Thursday
        $thursdayCountsTEMP=array_count_values($thursdayINFO);
        $thursdayCountsFilled=array_merge($thursdayCounts,$thursdayCountsTEMP);        
        //Friday
        $fridayCountsTEMP=array_count_values($fridayINFO);
        $fridayCountsFilled=array_merge($fridayCounts,$fridayCountsTEMP);        
        //Saturday
        $saturdayCountsTEMP=array_count_values($saturdayINFO);
        $saturdayCountsFilled=array_merge($saturdayCounts,$saturdayCountsTEMP);
        //Sunday
        $sundayCountsTEMP=array_count_values($sundayINFO);
        $sundayCountsFilled=array_merge($sundayCounts,$sundayCountsTEMP);   