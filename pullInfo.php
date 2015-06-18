<?php



    



    //$group1_RESIDENCE = new checkinPopulation();

     //Set Beginning Time
    $group1_RESIDENCE->setBeginTime("08:00");
    //Set Ending Time
    $group1_RESIDENCE->setEndTime("09:00");
    //Get Beginning Time
    $beginTIME=$group1_RESIDENCE->getBeginTime();
    //Get Ending Time
    $endTIME=$group1_RESIDENCE->getEndTime();
    
     //   echo "This is what is currently in residence:" .var_dump($group1_RESIDENCE);
    
    //$beginTIME="08:00"; $endTIME="09:00";
  
     //13:00 -- 1:00p o clock
    //14:00 -- 2:00p o clock
    //15:00 -- 3:00p o clock
    //16:00 -- 4:00p o clock
    //17:00 -- 5:00p o clock
    //18:00 -- 6:00p o clock
    //
    //Query Line; edit this portion.
    $sql='SELECT * FROM welcome_week_signup WHERE residence=? && time_of_swipe >=? && time_of_swipe <?';
    
    //Create Statement
    $statement = $conn->prepare($sql);
    
    /*******************
     *
     * BIND PARAMETERS
     *****************/
    
    //echo $group1_RESIDENCE;
    
    $residence="Alexander Hall";
    
    //Residence Hall
    $statement->bindParam(1,$residence);
    
    //Beginning Time
    $statement->bindParam(2,$beginTIME);
    
    //Ending Time
    $statement->bindParam(3,$endTIME);
  
    
      /**
     * END BIND PARAMETER
     */
    
    
   //Execute Statements (single query)
   $statement->execute();