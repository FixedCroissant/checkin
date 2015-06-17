<?php

//Grab information from Oracle Connection.
//Below is test environment
include ('oracleconnect.php');

//Provide information so that we can create a roommate check
//and check one's roommate ID, on the basis of their room 
//that they currently are living in.
include('../checkinPopulation.php');

//Production information
//include('../../mysql/psdb.php');

//End Production Information

//Grab the information for the Housing Database to check and see if 
//the roommate has checked into our system.
//Get connection from the housing database.
include('../../mysql/housing_apps_db_pdo.php');

//Variables
$last_name="";

$roommateID=NULL;
$givenBUILDING=NULL;
$givenUNITNUMBER=NULL;


//Create a roommate object
 $group1_RESIDENCE_ROOMMATE = new checkinPopulation();

 //Make sure we use the correct SQL information
 $sqlROOMMATEQUERY= $group1_RESIDENCE_ROOMMATE->getRoommateSQL();
 
 //get $givenUNITNUMBER
 $getUNITNUMBER_INITIAL= $group1_RESIDENCE_ROOMMATE->getSQLUNITNumber();
 
 
 //ID we're looking for ....
    $ID = $_POST['ID'];
    
    //Term we're looking for....
    $term = "2158";    //Fall 2015 = 2158; Spring 2015 == 2148, etc.
 
 
  //Make the connection with the new query.
    
    $statementFORUNIT=oci_parse($connPS,$getUNITNUMBER_INITIAL);
    
    //Production Environment
    //$statement=oci_parse($psconnect,$query);
    //End Production Envrionment.
    
    //Bind variable to the query search.
    //PRODUCTION -- PROVIDE STUDENT ID
     oci_bind_by_name($statementFORUNIT,':searchedSTUDENT',$ID);
 
    //Execute the query.
     oci_execute($statementFORUNIT);
 
     while($rowUNITNEEDED = oci_fetch_array($statementFORUNIT,OCI_ASSOC)){
         //Below message is for testing only.
         
         //echo "This is the building:".$rowUNITNEEDED["BUILDING"]."This is the unit number".$rowUNITNEEDED["NC_HIS_UNIT_NUM"]."This is the unit suffix number".$rowUNITNEEDED["NC_HIS_UNIT_SUFFIX"]; 
         $givenSUFFIX=$rowUNITNEEDED["NC_HIS_UNIT_SUFFIX"];
         $givenBUILDING=$rowUNITNEEDED["BUILDING"];
         $givenUNITNUMBER=$rowUNITNEEDED["NC_HIS_UNIT_NUM"];
     }
     
 //echo $givenUNITNUMBER; 

    //Get Initial Student Information   
    
    //Query to use. (TESTING ENVIRONMENT)
    //Limit results to 1 result, even if there are two people in the table, (due to multiple village requests), just care about 1 returnable row.
    $query="SELECT * FROM PS_NC_HIS_PPE_VW WHERE rownum<=1 AND effective_term= :term AND emplid= :emplid";
    
    //Make the connection with the new query.
    //Testing Environment
    $statement=oci_parse($connPS,$query);
    
    //Production Environment
    //$statement=oci_parse($psconnect,$query);
    //End Production Envrionment.
    
    //Bind variable to the query search.
    //PRODUCTION -- STUDENT ID.
    oci_bind_by_name($statement,':emplid',$ID);

    //PRODUCTION -- TERM
    oci_bind_by_name($statement,':term',$term);
    
    //Execute the query.
    oci_execute($statement);
    
    
    //Get Number of rows returned on the execution of the SQL query and then take the results
    //and put it into a variable called $temp_array.
    $fetch_the_stuff = oci_fetch_all($statement, $temp_array);   

    //Provide a variable to hold up the number or rows that were affected by running the above query.
    $rows_STUDENTLOOKUP=  oci_num_rows($statement);
    //For debugging and testing only.
    //echo "This is the amount of rows".$rows_STUDENTLOOKUP." Rows";
    
    /*********************************
     * END INITIAL STUDENT INFORMATION
     *********************************/
     
     /**********************************
      * GET ROOMMATE ID BASED ON THE STUDENT ID AND THEIR UNIT NUMBER
      ************************************/
     
     //Query to use. (TESTING ENVIRONMENT)
    //$query="SELECT * FROM PS_NC_HIS_PPE_VW WHERE effective_term= :term AND emplid= :emplid";
    
    //Make the connection with the new query.
    //Testing Environment
    $statementROOMMATESEARCH=oci_parse($connPS,$sqlROOMMATEQUERY);    
    
    //Bind variable to the query search.
    //PRODUCTION -- SearchedStudent
    oci_bind_by_name($statementROOMMATESEARCH,':searchedSTUDENT',$ID);

    //PRODUCTION --BUILDING OF SEARCHED STUDENT
    oci_bind_by_name($statementROOMMATESEARCH,':building',$givenBUILDING);
    
    //PRODUCTION -- UNIT Number
    oci_bind_by_name($statementROOMMATESEARCH,':unitNUMBER',$givenUNITNUMBER);
    
    //PRODUCTIOn -- UNIT Suffix Number
    oci_bind_by_name($statementROOMMATESEARCH,':unitSUFFIXNUMBER',$givenSUFFIX);
            
    //Execute the query.
    oci_execute($statementROOMMATESEARCH);
    
    
    //echo "this is under statementROOMMATESEARCH";
    
     //Provide the results as needed: in this case, we will only assign the roommate's ID to Roommate ID, and repeat the 
     //SQL query again to retrieve information about that student.
     while($rowFORROOMMATE = oci_fetch_array($statementROOMMATESEARCH,OCI_ASSOC)){
        //For testing purposes
        //echo  $rowFORROOMMATE["EMPLID"];

        //Assign the roommates' student ID number and run a search on it, to provide the end user with information about the roommate as well.
        $roommateID=$rowFORROOMMATE["EMPLID"];
     }
     
     /**********************************
      * END GET ROOMMATE INFORMATION BASED ON THE STUDENT ID AND THEIR UNIT NUMBER
      */
     
     
     /************************
      * SHOW THE RESULTS HERE!!!!
      ************************/
     
     //PRODUCTION ENVIRONMENT
    
       //foreach($temp_array as $row){  
       //Present information to the left side of the table. This is the information provided by the searched for student.
     
     
     if(isset($temp_array["NC_LAST_NAME_PRI"][0])){
                    
                    echo "<br/>";
                    echo "<div id='initialSTUDENTINFORMATION'>";
                    echo "<span id='results_header'><strong>"."Searched Student Information:"."</strong></span>";
                    echo "<br/>";
                    echo "Last Name:"."<span id=last_name_needed><strong>".$temp_array["NC_LAST_NAME_PRI"][0]."</strong></span>";
                    echo "<br/>";
                    echo "First Name:"."<span id=first_name_needed><strong>".$temp_array["NC_FIRST_NAME_PRI"][0]."</strong></span>";
                    echo "<br/>";
                    echo "Residence Bldg:"."<span id=residence_bldg_needed><strong>".$temp_array["BUILDING"][0]."</strong></span>";
                    echo "<br/>";
                    echo "Residence Room:"."<span id=residence_room_needed><strong>".$temp_array["NC_HIS_UNIT_NUM"][0]."</strong></span>";
                    echo "<br/>";
                    echo "Residence Unit Suffix:"."<span id=residence_unit_suffix_needed><strong>".$temp_array["NC_HIS_UNIT_SUFFIX"][0]."</strong></span>";
                    echo "<br/>";
                    echo "Residence Unit Bed:"."<span id=residence_unit_bed_needed><strong>".$temp_array["NC_HIS_UNIT_BED"][0]."</strong></span>";
                    echo "<br/>";
                     //New Values                        
                    echo "<span id=searched_residence_gender_needed style='display:none;'>".$temp_array["NC_GENDER"][0]."</span>";
                    echo "<br/>";
                    echo "<span id=searched_residence_classification_needed style='display:none;'>".$temp_array["ACAD_LEVEL_BOT"][0]."</span>";
                    //On 06 11 2015,Added email address hidden
                    echo "<br/>";
                    echo "<span id=searched_residence_email_address style='display:none;'>".$temp_array["EMAIL_ADDR"][0]."</span>";

                    //Add checked in time. (Date1), use javascript to set value.
                    echo "<script type='text/javascript'>";
                    echo "$(\"#expected_check_in_date\").val('".$temp_array["DATE1"][0]."');";
                    //echo "<span id=searched_residence_expected_check_in_time style='display:none;'>".$temp_array["DATE1"][0]."</span>";
                    echo "</script>";
                    //End New Values
                    
                    
                    //04-20-2015 -- Provide a Way to Not Allow students to check in, if their expected
                    //check-in date has not passed or the user has not checked t he "Allow Check-In Early" checkbox
                    //at the top of the page.
                     echo "<script src='js/expectedDateCheck.js'></script>";   
                    //End -- provide expected check-in date
                    
                    
                    //Set roomnumber
                    $givenUNITNUMBER=$temp_array["NC_HIS_UNIT_NUM"][0];
     }
                    //echo $givenUNITNUMBER;
                    //echo "This is the id:".$roommateID;
                    if($roommateID!=NULL && $rows_STUDENTLOOKUP===1){
                            $roommateID = $roommateID;
                            //echo "This is their roommate ID  ".$roommateID;
                            //echo "test";
                    }
                    //If a student's name appears more than once when looked up, make a statement. There are some students (e.g. 200050088 - Jeremy Mason that have a possible 2 village choices).
                    //April 20, 2015 - Commenting the below information out, as we are limiting the Oracle/PeopleSoft results to 1 row.
                    //Regardless of whether there is multiple entries for a student, due to making multiple village requests, the web application
                    //will only match up 1 roommate per 1 student.
                    /*
                    else if($rows_STUDENTLOOKUP===2){
                        echo "</div>";
                        echo "<div id='roommateINFORMATION'>";
                        echo "<span id=results_header style='font-weight:bold;'>"."Roommate Information:"."</span>";
                        echo "<br/>";
                        echo "This student likely has two Village Choices in his/her application. Therefore, his/her roommate match will likely not be correct.";
                        echo "<br/>";
                        echo "</div>";
                    }*/
                    
                    else if ($rows_STUDENTLOOKUP===0){
                        //For testing only!
                        //echo $rows_STUDENTLOOKUP;
                        //End testing
                        //Disable the submit button.
                        echo "<script type='text/javascript'>";
                        //echo "submit_button.disabled=true";
                        echo "$('#submit_button').prop('disabled',true);";
                        echo "</script>";
                        
                        //Post a new div that tells the end user that there are no results and to doub check the the student ID.//
                        echo "<div>";
                        echo "<div id='no_results'>We do not recognize this Student ID for the Summer Term II semester. Please double check the student ID again. Use the reset button below to start over.</div>";
                        echo "</div>"; //Close the "#results" div tag.
                    }
                    
                    else{
                        //If there is no roommate assigned, let's write that on the right hande column and let the user know.
                        //Close the DIV that contains the selected student's information.
                        echo "</div>";
                        echo "<div id='roommateINFORMATION'>";
                        echo "<span id=results_header style='font-weight:bold;'>"."Roommate Information:"."</span>";
                        echo "<br/>";
                        echo "We currently don't appear to have a roommate assigned to this student.";
                        echo "<br/>";
                        echo "<br/>";
                        echo "Students residing in <strong>Wolf Ridge</strong> or <strong>Wolf Village</strong> apartments do not have traditional roommates.";
                        echo "</div>";
                    }
                    echo "</div>";
                
     /********************************
     * GET ROOMMATE INFORMATION
     *********************************/
    //Query to use, limit the results to one row.
    $query_ROOMMATE="SELECT * FROM PS_NC_HIS_PPE_VW WHERE effective_term= :term AND emplid= :emplid AND rownum<=1";
    
    //Make the connection with the new query.
    $statementROOMMATE=oci_parse($connPS,$query_ROOMMATE);
    
    //Bind variable to the query search-- get the roommate's information, based on what is provided
    //in their student ID. The $roommmateID is found on line 107.
    oci_bind_by_name($statementROOMMATE,':emplid',$roommateID);
    
    //PRODUCTION -- TERM
    oci_bind_by_name($statementROOMMATE,':term',$term);

     //Execute the query.
     oci_execute($statementROOMMATE);
     
          
     /********************************
     * GET ROOMMATE INFORMATION
     *********************************/
                
                /********
                * SHOW THE ROOM MATE RESULTS HERE!!!!
                */        
          
                while($row = oci_fetch_array($statementROOMMATE,OCI_ASSOC)){
                    //If the person looked for shows up twice, then the match between this person and their potential
                    //roommmates does not look right. If this is the case, don't show any roommmate information as it might not be correct.
                    if($rows_STUDENTLOOKUP===2){
                        
                   
                    }
                    //Instead, if the person only shows up once in the table and are not associated with multiple choices for a particular village option.
                    //Let's go ahead and show the roommmate information.
                    //A special condition is created for students that residence in Wolf Ridge & Wolf Village (see line 313). We have to make sure not to display
                    //'roommate information' for students that are residing in Building for Wolf Ridge or Wolf Village
                    else if($rows_STUDENTLOOKUP===1 && ($row["BUILDING"]!=="Wolf Vlg A"&&$row["BUILDING"]!=="Wolf Vlg B"&&$row["BUILDING"]!=="Wolf Vlg C"&&$row["BUILDING"]!=="Wolf Vlg D"&&$row["BUILDING"]!=="Wolf Vlg E"&&$row["BUILDING"]!=="Wolf Vlg F"&&$row["BUILDING"]!=="Wolf Vlg G"&&$row["BUILDING"]!=="Wolf Vlg H"&&$row["BUILDING"]!=="WR Grove"&&$row["BUILDING"]!=="WR Innovat"&&$row["BUILDING"]!=="WR Lakevw"&&$row["BUILDING"]!=="WR Plaza"&&$row["BUILDING"]!=="WR Tower"&&$row["BUILDING"]!=="WR Valley")){
                        echo "<div id='roommateINFORMATION'>";
                        echo "<span id=results_header style='font-weight:bold;'>"."Roommate Information:"."</span>";
                        echo "<br/>";
                        echo "Roommate Last Name:"."<strong>".$row["NC_LAST_NAME_PRI"]."</strong>";
                        echo "<br/>";
                        echo "Roommate First Name:"."<strong>".$row["NC_FIRST_NAME_PRI"]."</strong>";
                        echo "<br/>";
                        echo "Residence Bldg:"."<strong>".$row["BUILDING"]."</strong>";
                        echo "<br/>";
                        echo "Residence Room:"."<strong>".$row["NC_HIS_UNIT_NUM"]."</strong>";
                        echo "<br/>";
                        echo "Residence Unit Suffix:"."<span id=residence_room_needed><strong>".$row["NC_HIS_UNIT_SUFFIX"]."</strong></span>";
                        //New information added on 6 11 2015.
                        echo "<br/>";
                        echo "Residence Unit Bed:"."<strong>".$row["NC_HIS_UNIT_BED"]."</strong>";
                        //New lines to accompany the hidden values of Searched for student's gender and classification
                        //Two line breaks.
                        echo "<br/>";
                        echo "<br/>";
                        echo "</div>";
                    }
                    
                    //4-27-2015, Add a condition that checks and see if they're a Wolf Ridge or Wolf Village residenct.
                    else if($rows_STUDENTLOOKUP===1 && ($row["BUILDING"]==="Wolf Vlg A"||$row["BUILDING"]==="Wolf Vlg B"||$row["BUILDING"]==="Wolf Vlg C"||$row["BUILDING"]==="Wolf Vlg D"||$row["BUILDING"]==="Wolf Vlg E"||$row["BUILDING"]==="Wolf Vlg F"||$row["BUILDING"]==="Wolf Vlg G"||$row["BUILDING"]==="Wolf Vlg H")||($row["BUILDING"]==="WR Grove"||$row["BUILDING"]==="WR Innovat"||$row["BUILDING"]==="WR Lakevw"||$row["BUILDING"]==="WR Plaza"||$row["BUILDING"]==="WR Tower"||$row["BUILDING"]==="WR Valley"))
                        {                    
                            echo "<div id='roommateINFORMATION'>";
                            echo "<strong>";
                            echo "This student resides in an Apartment (Wolf Ridge or Wolf Village) and as such does not have a roommate.";
                            echo "</strong>";
                            echo "</div>";
                        }
                    
                    //Comment out for testing
                    
                    /*
                    
                    //ROOMMATE INFORMATION
                    echo "<div id='roommateINFORMATION' style='float:right; background-color:#FFCCCC; width: 50%; text-align:center;'>";
                    echo "<span id=results_header style='font-weight:bold;'>"."Roommate Information:"."</span>";
                    echo "<br/>";
                    echo "Roommate Last Name:"."<strong>".$row["NC_LAST_NAME_PRI"]."</strong>";
                    echo "<br/>";
                    echo "Roommate First Name:"."<strong>".$row["NC_FIRST_NAME_PRI"]."</strong>";
                    echo "<br/>";
                    echo "Residence Bldg:"."<strong>".$row["BUILDING"]."</strong>";
                    echo "<br/>";
                    echo "Residence Room:"."<strong>".$row["NC_HIS_UNIT_NUM"]."</strong>";
                    echo "<br/>";
                    echo "Residence Unit Suffix:"."<span id=residence_room_needed><strong>".$row["NC_HIS_UNIT_SUFFIX"]."</strong></span>";
                    echo "<br/>";
                    echo "</div>";
                   */
                }
                //Provide the number of rows needed.
                //echo "Total Number of Rows:"."<span id=number_of_rows_needed>". oci_num_rows($statement)."</span>";



//} //CLOSE IF STATEMENT

/*************************************
 * NO LONGER CHECK PEOPLE SOFT DATABASE.
 **************************************/                
                
                
/********************
 * CHECK INTERNAL HOUSING mySQL DATABASE
 ********************/
                
                
//Check mySQL Housing Database to see if the Roommate has Checked In                
$sql='SELECT * FROM welcome_week_signup WHERE cardswipe=?';

//Create Statement
$statementROOMMATECHECK = $connPDO->prepare($sql);

/*******************
 * BIND PARAMETERS
 *****************/
 
//Use the selected Room Mate's ID to see if they've signed in prior.
$statementROOMMATECHECK->bindParam(1,$roommateID);
    
//Execute Statements
$statementROOMMATECHECK->execute();
        

$count=$statementROOMMATECHECK->rowCount();

//echo "This is the amount returned:  ".$count;

//Check and see if any results are returned.
if ($count>0){
    while ($row = $statementROOMMATECHECK->fetch(PDO::FETCH_ASSOC)){
    echo "<br/>";
            
                echo "<script type='text/javascript'>";
                echo "$(\"#roomMATE_CHECKED_IN\").text('Yes');"; 
                echo "$(\"#roomMATE_CHECKED_IN\").css({'font-weight':'bold','color':'green'});"; 
                //echo "alert('".$row["roommate_check_in"]."')";
                echo "</script>";
             
                            
       }//Close WHILE loop
}
else{
                echo "<script type='text/javascript'>";
                echo "$(\"#roomMATE_CHECKED_IN\").text('No');";
                echo "$(\"#roomMATE_CHECKED_IN\").css({'color':'red'});"; 
                echo "</script>";
}
?>