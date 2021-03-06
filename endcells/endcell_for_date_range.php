<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$timeBEGIN=$group1_RESIDENCE->getBeginTime();
$timeEND = $group1_RESIDENCE->getEndTime();

//Get the SQL needed by the residence
$sql=$group1_RESIDENCE->getSQLNeededforDateRange();

//Create Statement
$statement = $conn->prepare($sql);

////Bind Variables
//Set Residence Hall
$statement->bindParam(1,$residence);

//Set the Date Range we need
//Begin Date
$statement->bindParam(2,$beginDATENEEDED);
//End Date
$statement->bindParam(3,$endDATENEEDED);

//Set the Beginning Time
$statement->bindParam(4,$timeBEGIN);
//Set the Ending Time
$statement->bindParam(5,$timeEND);
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
    //Provide Residence location for the link that we will generate with the number.
    //untouched.
    //$residenceLOCATION=$residence;
    //Remove All WhiteSpace
    $residenceLOCATION = preg_replace('/\s+/', '', $residence);

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

    //If the beginning time is the same as the end time, edit the $_GET parameters accordingly.
    //Fix for early hours of 12:00 - 7:59:59 and
    //later hours 5:00 - 11:59:59.
    if($timeBEGINforReport==$timeENDforReport){
        //Add 1 to the end time report.
        //Adjust last $_GET parameter.
        $timeENDforReport =($timeBEGINforReport+1);
        echo "<a href='/report_for_all_dates.php?residence=".$residenceLOCATION."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&endTIME=".$timeENDforReport."'target='_blank')'>$rowCountArray[0]</a>";
    }
    else{
        echo "<a href='/report_for_all_dates.php?residence=".$residenceLOCATION."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&endTIME=".$timeENDforReport."'target='_blank')'>$rowCountArray[0]</a>";
    }



    /*
    //Untouched 06-24-2016 @ 10:23am.
    echo "<a href='/report_for_all_dates.php?residence=".$residenceLOCATION."&dateNEEDEDSTART=".$beginDATENEEDED."&dateNEEDEDEND=".$endDATENEEDED."&beginTIME=".$timeBEGINforReport."&endTIME=".$timeENDforReport."'target='_blank')'>$rowCountArray[0]</a>";
    */
}
//If there are no rows; why would we want to put a link. It wouldn't go any
//where.
else{
    echo $rowCountArray[0];
}
//Close Data Cell
echo "</td>";