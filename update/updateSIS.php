<?php

/* 
 * Author: J.Williams
 * Date: April 29, 2015
 * Description: A function to update the People Soft table, based on their ID.
 */




/*
 * Function getSQLNeeded()
 * Description: Function that returns the SQL we need to utilize a proper update in PeopleSoft or Oracle.
 *  
 */
function getSQLNeeded(){
    //OLD OLD OLD
    //TEMP UPDATE PS_NC_HIS_PPE_VW.DATE1 FROM PS_NC_HIS_PPE_VW WHERE PS_NC_HIS_PPE_VW.EMPLID=:neededSTUDENT AND PS_NC_HIS_PPE_VW.EFFECTIVE_TERM=:term
    
    //PS_NC_HIS_PPE_VW IS A VIEW AND IS ONLY BEING USED TEMPORARILY
    //WILL NEED TO BE UPDATED WITH THE ACTUAL TABLE THAT THIS DATE IS BEING HOUSED IN.
    
    $sql_NEEDED_FOR_UPDATE_RECORD_IN_SIS = "UPDATE PS_NC_HIS_PPE_VW SET PS_NC_HIS_PPE_VW.DATE1 = :dateUPDATE_NEW WHERE PS_NC_HIS_PPE_VW.EMPLID=:neededSTUDENT AND PS_NC_HIS_PPE_VW.EFFECTIVE_TERM=:term";

    return $sql_NEEDED_FOR_UPDATE_RECORD_IN_SIS;
}



function updateRecordSIS($studentID,$term,$dateTOupdate){
    
    //Blank Variable -- Initially
    //$actualDateInSystem =array("Date1"=>'',"Date2"=>'');
    
    //Test Enviroment ONLY, only use when testing the file individually.
    //and running the file on it's own.
    include('../db/oracleconnect.php');
    
    //Test Environment ONLY
    //When included with 'checkin-done.php', we need to use this inclusion.
    //include('db/oracleconnect.php');
    
    //ALL COMMENTED OUT
    /*
    //Production Environment
        //RPT
    include('../../mysql/psdb.php');
        //DV1  
    include('../../mysql/psdb-DEVELOPMENT.php');
        //PRE
    include('../../mysql/psdb-PRE.php');
    */
    
    //Create Oracle PeopleSoft Connection
    //Test Enviroment
    //REMEMBER PRODUCTION ENVIRONMENT USESES $PSconnect as it's connection variable.
     $statementUPDATE_DATE_IN_SIS=oci_parse($connPS ,  getSQLNeeded());

     //Prodcution line (commented out, 4-28-2015)
     //$statementActualDateLookup=oci_parse($PSconnect,$sql_NEEDED_FOR_ACTUAL_DATE_LOOKUP);

   //temp
   //$sql_NEEDED = "SELECT DATE1 FROM PS_NC_HIS_PPE_VW WHERE EMPLID=200050088 AND EFFECTIVE_TERM=2158 ;";
   
     
   //Bind Variables
   //StudentID
   oci_bind_by_name($statementUPDATE_DATE_IN_SIS,':neededSTUDENT',$studentID);
   //Term
   oci_bind_by_name($statementUPDATE_DATE_IN_SIS,':term',$term);
   //Specify the Date to Update
   oci_bind_by_name($statementUPDATE_DATE_IN_SIS,':dateUPDATE_NEW',$dateTOupdate);
   
   
   //Execute the query.
   oci_execute($statementUPDATE_DATE_IN_SIS);
   
   
   //Notify the end user of the updated and how many rows have been changed 
   //as the result of the query update.
   echo oci_num_rows($statementUPDATE_DATE_IN_SIS). " rows have been updated.";
   
   //Clear connection
   $statementUPDATE_DATE_IN_SIS=null;
     
     //return $dateNeededToAssign;
    
}

//Initialize a new update
//Set the student ID
//Remember to enclose the studentID with '', so that the 00s don't get whiped out
//in the beginning of the update
$studentID='001068812';

$dateTOUpdate='08-24-2005';

//Go ahead and update the record.
updateRecordSIS($studentID, 2158, $dateTOUpdate);