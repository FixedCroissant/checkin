<?php
/* 
 * Author: J.Williams
 * Date: 04 28 2015
 * Description: Check Actual Date of Check-In & make determination whether or not it is necessary to update the column field.
 */

/*Variables Here*/


//Retreive access to the PeopleSoft System
//Test Enviroment
//include('../db/oracleconnect.php');

//Production Environment
//PRODUCTION SIDE
//include('../mysql/psdb.php');
//PRE SITE
//include('../mysql/psdb-PRE.php');
//DEVELOPMENT DV1
//include('../mysql/psdb-DEVELOPMENT.php');

//parameter 1 -> Student ID
//parameter 2 -> Term
//parameter 3 ->If More than 1, how many rows to return
//There are dates for this person
//Person Name: Jeremy Mason
//echo getActualDate(200050088, 2158,2);

//$dateNeededToAssign = getActualDate(200050088, 2158,2);

//Person Name: Marissa Nixon
//There are NO dates for this person.
//$dateNeededToAssign = getActualDate(200074047,2158,1);
//echo getActualDate(200074047,2158,1);

//QUERY NEEDED BELOW
//$sql_NEEDED_FOR_ACTUAL_DATE_LOOKUP = "SELECT PS_NC_HIS_PPE_VW.DATE1 FROM PS_NC_HIS_PPE_VW WHERE PS_NC_HIS_PPE_VW.EMPLID=:neededSTUDENT and PS_NC_HIS_PPE_VW.EFFECTIVE_TERM=:term";


//provide a getter for SQL Lookup
function getSQLNeeded(){
    $sql_NEEDED_FOR_ACTUAL_DATE_LOOKUP = "SELECT PS_NC_HIS_PPE_VW.DATE1 FROM PS_NC_HIS_PPE_VW WHERE PS_NC_HIS_PPE_VW.EMPLID=:neededSTUDENT AND PS_NC_HIS_PPE_VW.EFFECTIVE_TERM=:term AND ROWNUM<=:rows_NEEDED";

    return $sql_NEEDED_FOR_ACTUAL_DATE_LOOKUP;
}


/*
 * Function getActualDate
 * Function that will return the actualDate of Arrival
 * @studentID (int) provide studentID to search for
 * @term (int) provide the term we need to look for this student
 * @limitROWS (int) If by chance the student in the view list multiple times due to wanting different villages, we can limit the results returned by
 * returning this value to 1. If we want all rows given we can just change the number as needed. 
 */
function getActualDate($studentID,$term,$limitROWS){
    //Blank Variable -- Initially
    $actualDateInSystem =array("Date1"=>'',"Date2"=>'');
    
    //Test Enviroment ONLY, only use when testing the file individually.
    //and running the file on it's own.
    //include('../db/oracleconnect.php');
    
    //Test Environment ONLY
    //When included with 'checkin-done.php', we need to use this inclusion.
    include('db/oracleconnect.php');
    
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
     $statementActualDateLookup=oci_parse($connPS ,  getSQLNeeded());

     //Prodcution line (commented out, 4-28-2015)
     //$statementActualDateLookup=oci_parse($PSconnect,$sql_NEEDED_FOR_ACTUAL_DATE_LOOKUP);

   //temp
   //$sql_NEEDED = "SELECT DATE1 FROM PS_NC_HIS_PPE_VW WHERE EMPLID=200050088 AND EFFECTIVE_TERM=2158 ;";
   
     
   //Bind Variables
   //StudentID
   oci_bind_by_name($statementActualDateLookup,':neededSTUDENT',$studentID);
   //Term
   oci_bind_by_name($statementActualDateLookup,':term',$term);
   //Specify How Many Rows to Limit
   oci_bind_by_name($statementActualDateLookup,':rows_NEEDED',$limitROWS);
   
   
   //Execute the query.
   oci_execute($statementActualDateLookup);
   
   //Get Whatever is executed and put into an array.
   $fetch_the_stuff = oci_fetch_all($statementActualDateLookup, $temp_array_of_actual_dates);
   
   //How many results do we have?
   $row_TOTAL_FOR_STUDENTS_ACTUAL_DATE=  oci_num_rows($statementActualDateLookup);
   
   
   //Close Connection
   oci_close($statementActualDateLookup);
   
   //echo "Here is how many results we have ".$row_TOTAL_FOR_STUDENTS_ACTUAL_DATE;
   //echo "<br/>";
   
   //For Testing Only
   //var_dump ($temp_array_of_actual_dates);
   
   
     //Condition if there is something in the array.
     if(isset($temp_array_of_actual_dates["DATE1"][0])){
        echo "<br/>";
            for($x=0;$x<$row_TOTAL_FOR_STUDENTS_ACTUAL_DATE;$x++){
               //echo $temp_array_of_actual_dates["DATE1"][$x];
               //echo "<br/>";
            }
            //Since there IS a date in the system, let's take this date and capture it for our own records.
                //This value will be housed in the mySQL database for housing and it should be the same date that is representative
                //from the SIS side.
                //For reference, the variable, dateNeededToAssign is being assigned the value in the Oracle/PS column called
                //DATE1 and the first value in the system.
                $dateNeededToAssign =$temp_array_of_actual_dates["DATE1"][0];
     }
     else if(!isset($temp_array_of_actual_dates["DATE1"][0])){
         //For Testing, commented out.
         //echo "<br/>";
         //echo "There are no actual dates in the system";
         
         //Since there are no dates in the system for the actual date, we can go ahead and assign the date.
         //$dateNeededToAssign = "None In SIS during Check-In";
         $dateNeededToAssign="";
     }
     
//                while($row_ACTUALDATENEEDED = oci_fetch_array($statementActualDateLookup,OCI_ASSOC)){
//                     $actualDateInSystem=$row_ACTUALDATENEEDED["DATE1"];
//                   
//                     //Input the values into the array.
//                     //$actualDateInSystem[]=
//
//                    //testing -- commented out 4,28,2015 
//                   echo $actualDateInSystem;
//                   echo "<br/>";
//                     
//                   // return $actualDateInSystem;
//                }
                
            
     //return $actualDateInSystem;
     
     return $dateNeededToAssign;
    
}
