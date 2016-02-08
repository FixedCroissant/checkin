<?php
//Redirect  Browser after 5 seconds
//main page.
header( 'refresh: 5; url=http://housing.ncsu.edu/apps/checkin/index.php' );

//Get connection from the housing database.
include('../../mysql/housing_apps_db_mysqli.php');

//See if we can connect to the database
if($mysqli->connect_error){
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

//Get POST variables
//Residence or Location
$residence=$_REQUEST["searched_residence_location"];		//Residence Location
$residence_room=$_REQUEST["searched_residence_room"];		//Residence Room

//Residence Group
//Let's set the residence Group based on what is passed by the building.
$residenceGROUP=setResidenceGroup($residence);				//Residence Grouping, Apartment Group, Residence Hall Name+ [Hall], Greek Building Name to Organization name.

//Set Residence's Campus area;
$residence_campus_area = setCampusArea($residence);

//Variable used to let us know whether or not the person is trying to sign into an apartment area.
//Check if we're pulling a student from an apartment.
$apartmentGroup=isApartmentRequested($residenceGROUP);

//Commented out on July 14 2015.
//Below is for testing.
//echo "This is the residence group:".$residenceGROUP;
//echo "<br>";
//echo "This is the apartment group:".$apartmentGroup;


function setResidenceGroup($buildingName){
    if($buildingName==="AFC - A" || $buildingName==="AFC - B" || $buildingName==="AFC - E"||$buildingName==="AFC - F" ){
        $residenceGROUP="Avent Ferry";
    }
    //Apartment Group 1
    if($buildingName==="Wolf Vlg A" || $buildingName==="Wolf Vlg B" || $buildingName==="Wolf Vlg C"||$buildingName==="Wolf Vlg D"||$buildingName==="Wolf Vlg E"||$buildingName==="Wolf Vlg F"||$buildingName==="Wolf Vlg G"||$buildingName==="Wolf Vlg H"){
        $residenceGROUP="Wolf Village";
    }
    if($buildingName==="Wood - A" || $buildingName==="Wood - B" ){
        $residenceGROUP="Wood Hall";
    }
    //ApartmentGroup 2
    if($buildingName==="WR Grove" || $buildingName==="WR Innovat"|| $buildingName==="WR Lakevw"|| $buildingName==="WR Plaza"|| $buildingName==="WR Tower" || $buildingName==="WR Valley"){
        $residenceGROUP="Wolf Ridge";
    }
    if($buildingName==="Alexander"){
        $residenceGROUP="Alexander Hall";
    }
    if($buildingName==="Bagwell"){
        $residenceGROUP="Bagwell Hall";
    }
    if($buildingName==="Becton"){
        $residenceGROUP="Becton Hall";
    }
    if($buildingName==="Berry"){
        $residenceGROUP="Berry Hall";
    }
    if($buildingName==="Bowen"){
        $residenceGROUP="Bowen Hall";
    }
    if($buildingName==="Bragaw"){
        $residenceGROUP="Bragaw Hall";
    }
    if($buildingName==="Carroll"){
        $residenceGROUP="Carroll Hall";
    }
    if($buildingName==="Gold"){
        $residenceGROUP="Gold Hall";
    }
    if($buildingName==="Lee"){
        $residenceGROUP="Lee Hall";
    }
    if($buildingName==="Metcalf"){
        $residenceGROUP="Metcalf Hall";
    }
    if($buildingName==="North"){
        $residenceGROUP="North Hall";
    }
    if($buildingName==="Owen"){
        $residenceGROUP="Owen Hall";
    }
    if($buildingName==="Sullivan"){
        $residenceGROUP="Sullivan Hall";
    }
    if($buildingName==="Syme"){
        $residenceGROUP="Syme Hall";
    }
    if($buildingName==="Tucker"){
        $residenceGROUP="Tucker Hall";
    }
    if($buildingName==="Turlington"){
        $residenceGROUP="Turlington Hall";
    }
    if($buildingName==="Watauga"){
        $residenceGROUP="Watauga Hall";
    }
    if($buildingName==="Welch"){
        $residenceGROUP="Welch Hall";
    }
    /*Set all Greek Organizations to campus area Greek*/
    if($buildingName==="Grk Vlg-01"){
        $residenceGROUP="Lambda Chi Alpha";
    }
    if($buildingName==="Grk Vlg-02"){
        $residenceGROUP="Sigma Kappa";
    }
    if($buildingName==="Grk Vlg-03"){
        $residenceGROUP="Kappa Alpha";
    }
    if($buildingName==="Grk Vlg-04"){
        $residenceGROUP="Delta Zeta";
    }
    if($buildingName==="Grk Vlg-05"){
        $residenceGROUP="Phi Gamma Delta";
    }
    if($buildingName==="Grk Vlg-07"){
        $residenceGROUP="Sigma Phi Epsilon";
    }
    if($buildingName==="Grk Vlg-08"){
        $residenceGROUP="Alpha Delta Pi";
    }
    if($buildingName==="Grk Vlg-09"){
        $residenceGROUP="Demolished House";
    }
    if($buildingName==="Grk Vlg-11"){
        $residenceGROUP="Kappa Sigma";
    }
    if($buildingName==="Grk Vlg-12"){
        $residenceGROUP="Delta Gamma";
    }
    if($buildingName==="Grk Vlg-13"){
        $residenceGROUP="Kappa Alpha Theta";
    }
    if($buildingName==="Grk Vlg-14"){
        $residenceGROUP="Pi Beta Phi";
    }
    if($buildingName==="Grk Vlg-15"){
        $residenceGROUP="Alpha Tau Omega";
    }
    if($buildingName==="Grk Vlg-16"){
        $residenceGROUP="Sigma Phi Epsilon";
    }
    //SIGMA NU - NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    if($buildingName==="Grk Vlg-2A"){
        $residenceGROUP="Sigma Nu";
    }
    //KAPPA DELTA -- NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    if($buildingName==="Grk Vlg-2C"){
        $residenceGROUP="Kappa Delta";
    }
    return $residenceGROUP;
}

function setCampusArea($buildingName){
    if($buildingName==="AFC - A" || $buildingName==="AFC - B" || $buildingName==="AFC - E"||$buildingName==="AFC - F" ){
        $residence_campus_area="east";
    }
    if($buildingName==="Wolf Vlg A" || $buildingName==="Wolf Vlg B" || $buildingName==="Wolf Vlg C"||$buildingName==="Wolf Vlg D"||$buildingName==="Wolf Vlg E"||$buildingName==="Wolf Vlg F"||$buildingName==="Wolf Vlg G"||$buildingName==="Wolf Vlg H"){
        $residence_campus_area="apt";
    }
    if($buildingName==="Wood - A" || $buildingName==="Wood - B" ){
        $residence_campus_area="east";
    }
    if($buildingName==="WR Grove" || $buildingName==="WR Innovat"|| $buildingName==="WR Lakevw"|| $buildingName==="WR Plaza"|| $buildingName==="WR Tower" || $buildingName==="WR Valley"){
        $residence_campus_area="apt";
    }
    if($buildingName==="Alexander"){
        $residence_campus_area="central";
    }
    if($buildingName==="Bagwell"){
        $residence_campus_area="east";
    }
    if($buildingName==="Becton"){
        $residence_campus_area="east";
    }
    if($buildingName==="Berry"){
        $residence_campus_area="east";
    }
    if($buildingName==="Bowen"){
        $residence_campus_area="central";
    }
    if($buildingName==="Bragaw"){
        $residence_campus_area="west";
    }
    if($buildingName==="Carroll"){
        $residence_campus_area="central";
    }
    if($buildingName==="Gold"){
        $residence_campus_area="east";
    }
    if($buildingName==="Lee"){
        $residence_campus_area="west";
    }
    if($buildingName==="Metcalf"){
        $residence_campus_area="central";
    }
    if($buildingName==="North"){
        $residence_campus_area="east";
    }
    if($buildingName==="Owen"){
        $residence_campus_area="central";
    }
    if($buildingName==="Sullivan"){
        $residence_campus_area="west";
    }
    if($buildingName==="Syme"){
        $residence_campus_area="east";
    }
    if($buildingName==="Tucker"){
        $residence_campus_area="central";
    }
    if($buildingName==="Turlington"){
        $residence_campus_area="central";
    }
    if($buildingName==="Watauga"){
        $residence_campus_area="east";
    }
    if($buildingName==="Welch"){
        $residence_campus_area="east";
    }

    /*Set all Greek Organizations to campus area Greek*/
    /*Set all Greek Organizations to campus area Greek*/
    if($buildingName==="Grk Vlg-01"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-02"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-03"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-04"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-05"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-07"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-08"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-09"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-11"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-12"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-13"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-14"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-15"){
        $residence_campus_area="greek";
    }
    if($buildingName==="Grk Vlg-16"){
        $residence_campus_area="greek";
    }
    //SIGMA NU - NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    //BELOW IS SIGMA NU HOUSE
    if($buildingName==="Grk Vlg-2A"){
        $residence_campus_area="greek";
    }
    //KAPPA DELTA -- NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    //Below is KAPPA DELTA HOUSE
    if($buildingName==="Grk Vlg-2C"){
        $residence_campus_area="greek";
    }

    return $residence_campus_area;

}//close set campus area.

//Check if the student being submitted is in an apartment or greek building.
function isApartmentRequested($residenceGROUP){
    if($residenceGROUP==="Wolf Village"||$residenceGROUP==="Wolf Ridge"){
        $apartmentGroup="Y";
    }
    else{
        $apartmentGroup="N";
    }

    return $apartmentGroup;
}


//Swiped in student's first name and last name from the Oracle DB.
//Protect user inputs against escaped strings.
//Get student's first name.
$student_signedin_firstname = mysqli_real_escape_string($mysqli,$_REQUEST["searched_residence_fname"]);

//$student_signedin_lastname = $_REQUEST["searched_residence_lname"];
//Get student's last name.
$student_signedin_lastname=  mysql_escape_string($_REQUEST["searched_residence_lname"]);

//Get Student's Gender
$studentgender = mysql_escape_string($_REQUEST["searched_residence_gender"]);

//Get Student's Classification
$studentclassification = mysql_escape_string($_REQUEST["searched_residence_classification"]);

//Get Resident Suffix
$resident_suffix=$_REQUEST["searched_residence_suffix"];

//Get Resident Unit Number
$resident_unit_number = $_REQUEST["searched_residence_bed_number"];

//Cardswipe
$cardswipe = $_REQUEST["student_cardswipe"];
//Today's Date
$today = date("Y-m-d");
//Let's change to today's date (of June 26 2015 to June 27 2015 and see if this update functions).
//Change to June 27 2015. (Tomorrow, June 27, 2015).
//$today = date("Y-m-d",mktime(0, 0, 0, 6, 27, 2015));

//Today's Time
$time = $_REQUEST["current_time"];

//Keycode (Not implementing yet).
//$keycode = $_REQUEST["key_code"];
//Roommate Check-In (If App.)
//$roommate_check_in = $_REQUEST["roommate_check_in"];
//If the person's cell phone is incorrect, let's provide a correct phone number.
//Format cell phone number
$cellphone_new=preg_replace('/\D+/', '',$_REQUEST["cellphone_new"]);

//RUN WENJI'S Function
//IF THE CELL PHONE VALUE IS EMPTY, THEN DO NOT RUN AND UPDATE THE CELL PHONE SIS
//UPDATE FUNCTION.
if(empty($_REQUEST["cellphone_new"])){
//If the cell phone is empty do nothing.
//Eventually will need to comment this message out.
//Commented out on 07 14 07:54a
//echo "cell phone provided was empty, but actual date should have updated, only if it was a Residence Hall.";
}

//IF CELL PHONE HAS NEW TEXT IN THE TEXTBOX, GO AHEAD AND UPDATE.
if (!empty($_REQUEST["cellphone_new"])){
//If the phone number is not empty, go ahead and update the number in SIS.

//First, connect to the db table.
    $psusername='XXXREMOVEDXXXX';
    $pspassword='XXXREMOVEDXXXX';

//Comment out use of the development server on 7/15/2015, 9:47a
//Development Server
//$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//TESTING ENVIRONMENT.

//Production Server
//    $psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//PRODUCTION ENVIRONMENT.
//END PRODUCTION ENVIRONMENT.


// CONNECT TO THE ORACLE PEOPLESOFT DB
    $psconnection=oci_connect($psusername, $pspassword, $psdb);

//If there is any error in connecting to the Oracle DB, lets display the error.
    if (!$psconnection) {
        $e=oci_error();
        echo htmlentities($e['message']);
    }

    /**
     *	TESTING WENYI's FUNCTION
     *   WORKING
     */
//Set up SQL query.
    $sql = 'BEGIN cs.nc_his_echeck_cell_phone(:emplid, :phone,:term ,:message); END;';
// AS OF 07 13 2015, NOT SURE IF THE CELL PHONE FUNCTION HAS UPDATED. NEED TO CHECK WITH WENYI.

//Parse the SQL connection statement.
    $statement = oci_parse($psconnection,$sql);

//  Bind the input parameter
    oci_bind_by_name($statement,':emplid',$emplid,9);

//  Bind the input parameter
    oci_bind_by_name($statement,':phone',$phone,10);

// Bind the term parameter
    oci_bind_by_name($statement,':term',$term,4);

// Bind the output parameter
    oci_bind_by_name($statement,':message',$message,100);

// Assign a value to the input

    $emplid = $cardswipe; 	//card swipe is the student id from the system.

    $phone = $cellphone_new; //phone number that we will be updating is called "cellphone_new" in the check-in web-application.

    $term='2158';		//Currently set to Fall 2015.

//Summer I 2156
//Summer II 2157
//Fall 2015 2158

//Execute the statement.
//Turn on cell phone update (if it is provided) on July 15 2015 @ 9:47a.
//Removed Cell Phone Update 08-19-2015..
    /*oci_execute($statement);*/

// $message is now populated with the output value
//Ignore message.
//Commented out on July 10 at 12:45p
//print "$message\n";

}//End if statement for Cell Phone Not Empty.

//END WENYI'S PHONE UPDATE FUNCTION


/**
 *
 *  UPDATE ACTUAL DATE IN PRODUCTION
 **/
//First, connect to the db table.
$psusername='XXXREMOVEDXXXX';
$pspassword='XXXREMOVEDXXXX';

//Comment out use of the development server on 7/15/2015, 9:47a
//Development Server
//$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';//DEVELOPMENT SERVER

//Production Server
//$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//PRODUCTION ENVIRONMENT.
//END PRODUCTION ENVIRONMENT

// CONNECT TO THE ORACLE PEOPLESOFT DB
$psconnection_for_actual_date_update=oci_connect($psusername, $pspassword, $psdb);

//UPDATE ACTUAL DATE
$sql = 'begin CS.NC_HIS_ECHECK_INSERT (:emplid, :actual_date,:timestamp, :message);END;';
// AS OF 07 13 2015, NOT SURE IF THE INSERT ACTUAL DATE HAS UPDATED. NEED TO CHECK WITH WENYI.

//prepare statement
$statement_to_update_actual_date = oci_parse($psconnection_for_actual_date_update,$sql);

//Bind the input parameter (student id).
oci_bind_by_name($statement_to_update_actual_date,':emplid',$emplid,9);

//Bind today's date.
oci_bind_by_name($statement_to_update_actual_date,':actual_date',$actualdate_to_send_to_SIS,25);

//Bind today's time.
oci_bind_by_name($statement_to_update_actual_date,':timestamp',$timestamp,25);

//Bind the message
oci_bind_by_name($statement_to_update_actual_date,':message',$message,100);

//Set up and assign the variables for the query.

//Student ID
$emplid = $cardswipe;

//ActualDate, assign it from the today's late listed on line 299 (above).
//This date gets formatted from 2015-06-20 (YYYY-MM-D) to d-MM-y or 26-Jun-15, which
//is the format that is acceptable for updating.
$actualdate=$today;

//test what the actual date looks like:
//Commenting out:
//echo 'This is the actual date that is being sent over: '.$actualdate;
//echo "<br/>";
//Create a date based on the date that is being passed over from the top of the page.
$date_to_format = date_create($actualdate);


//Comment out on 07 07 2015.
//echo "<br/>";
//echo 'Lets change the format to something more appropriate: '.date_format($date_to_format,"m/d/Y");
//echo "<br/><br/>";

//Capture the formatted date in a variable.
$actualdate_to_send_to_SIS=date_format($date_to_format,"m/d/Y");

//Let's see what is being formatted in the actual date that we're going to update.
//Printing out what is hopefully tomorrow, June 27 2015 (Saturday).
//Commented out on 07 14 2015.
//echo "This should be formatted as MM/DD/YYYY"." ".$actualdate_to_send_to_SIS;
//End commenting out things are the top.

//Current Time
$timestamp=$time;

//Check if the person is checking into an apartment or greek house.
//If the person resides within an apartment it is not necessary to update the
//actual date with the student information system.
if($apartmentGroup=="N"){

    //Commented out on 07 14 2015.
    //echo "<br>";
    //echo "student is NOT checking into an apartment, student will have actual date updated.";
    //echo "<br>";

    //Go ahead and execute the update for the actual arrival date.

    //Turn on execution for Residence Halls on July 15 @ 9:47am
    //Turned off on 08 15 2015 @ 8:53am
    //Turn back on 08 15 2015 @ 9:00 am
    //TURN OFF CONNECTION TO SIS
    /*oci_execute($statement_to_update_actual_date);*/

    //Update the actual date. By running this OCI_EXECUTE, THE EXPECTED DATE AND ACTUAL DATE WILL BE UPDATED.
    //Once the update has been done once for a student, it cannot be updated again, regardless of whether or not
    //we have a "success" print back.

    //Return message (ignored)
    //Might want to eventually comment this part out.
    //Commenting out as we do not need this.
    //Commented out on 07 10 2015 @ 1:35p
    //echo 'Actual Date Update Message from function: ';
    //echo "<br>";		//line break.
    //print "$message\n";
}
//If the person resides within the an apartment, do not execute an update of the SIS view.
else if($apartmentGroup=="Y"){
    //Do nothing, as we're not going to want to update the actual date for those residents
    //within a apartment community.

    //Testing
    //Commented out on 07 14 2015.
    //echo "<br>";
    //echo "Student IS checking into an apartment";
    //echo "<br>";
    //echo "Below is what we have within the apartmentGroup variable:";
    //echo "<br>";
    //echo $apartmentGroup;
    //echo "<br>";
    //echo "Actual Arrival Date did not update!";
    //End testing
}
/***************************************
 * END ACTUAL DATE UPDATE TO SIS DATABASE.
 * PRODUCTION
 ****************************************/


//BELOW IS JUST FOR TESTING ONLY.
//echo "<p>";
//echo "Today's Date:".$today;
//echo "<br/>";
//echo "The CardSwipe".$cardswipe;
//echo "<br/>";
//echo "Current Time of Swipe".$time;
//echo "<br/>";
////echo "The keycode in the system:".$keycode;
////echo "<br/>";
////echo "The student's roommate status:".$roommate_check_in;
//echo "<br/>";
////echo "The student's phone number provided is:". $cellphone_new;
////echo "<br/>";
//echo "The person's first name is:".$student_signedin_firstname;
//echo "<br/>";
//echo "The person's last name is".$student_signedin_lastname;
//echo "<br/>";
//echo "The building person is staying in:".$residence;
//echo "<br/>";
//echo "The room the person is staying in:".$residence_room;
//echo "<br/>";
//echo "The resident group the person is staying in is:".$residenceGROUP;
//echo "</p>";

//END TESTING OUTPUT.


// MAKE SURE THAT THE STUDENT HASN'T ALREADY REGISTERED IN SYSTEM.
$sql_check_student="SELECT * FROM welcome_week_signup WHERE cardswipe=?";

//Prepare & Bind Statement
$statement_check=$mysqli->prepare($sql_check_student);

//Bind Parameters
$statement_check->bind_param('s',$cardswipe);

//Execute prepared statement
$statement_check->execute();

//Store result
$statement_check->store_result();

//Get Row Count
$row_count= $statement_check->num_rows;

/**********
 * INSERT QUERY IN HOUSING DATABASE TABLE (MYSQL)
 */

//Query Statement
//Working SQL
$sql="INSERT INTO welcome_week_signup (residence_campus_area,residence_group,residence,residence_room,residence_suffix,residence_bed_number,resident_fname,resident_lname,gender,classification,cardswipe,date_of_swipe,time_of_swipe,cellphone_new)
VALUES ('$residence_campus_area','$residenceGROUP','$residence','$residence_room','$resident_suffix','$resident_unit_number','$student_signedin_firstname','$student_signedin_lastname','$studentgender','$studentclassification','$cardswipe', '$today','$time','$cellphone_new')";

/**********
 * DONE INSERT QUERY IN HOUSING DATABASE (MYSQL).
 */


//If the person is already in the housing database system, let them know.
if($row_count>=1){
    //Go to a different page if the user has already checked in.
    header('Location: http://housing.ncsu.edu/apps/checkin/error_pages/erroruserinsystem.php');
}

//Only execute the insert to the 'welcome_week_signup" talbe if there are NO ROWS at all.
//If there are any rows at all, go to the erroruserinsystem.php page.
/**
 * BELOW NEEDS TO BE FIXED. NEED TO CHECK FOR BLANK STUDENT IDS AND BLANK FIRST NAME AND BLANK LAST NAME
 * DOES NOT RELY ON SERVER VALIDATION. THUS, THERE WAS SKIPPING OF ROWS DURING FIRST IMPLEMENTATION.
 * WOULD ALSO LIKE TO CHANGE FROM MySQLi TO PDO.
 *
 * AS A RESULT, WOULD NEED TO CHANGE THE LOG-IN CONNECTION ON LINE 7 FROM MSQLI TO PDO.
 */
if($row_count===0){
    //MySqli Insert Query
    //Create a variable that will insert the row.
    //Insert the query into the mysql housing database table, welcome_week_signup.
    $insert_row = $mysqli->query($sql);

    //If everything is okay, then display a message. (This message is not displayed in production.)
    if($insert_row){
        //If everything is okay, print out a statement.
        //print 'Success! ID of last inserted record is : ' .$mysqli->insert_id .'<br />';
    }
    //If there are errors on inserting the row, display the errors.
    else{
        //Problems, proceed to explain the error.
        die('Error : ('. $mysqli->errno .') '. $mysqli->error);
    }
}
?>








<!DOCTYPE html>
<html lang="en">
<!-- InstanceBegin template="/Templates/secureform.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" media="screen" href="https://housing.ncsu.edu/secure/includes/secure.css" />
    <link rel="stylesheet" type="text/css" media="print" href="https://housing.ncsu.edu/secure/includes/print.css" />
    <!-- InstanceBeginEditable name="head" -->
    <title>NC State Housing - Confirmation</title>
    <link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
    <!-- InstanceEndEditable -->
</head>
<body style="max-width:770px;">
<p>
    <img src="https://housing.ncsu.edu/secure/images/logo.png" alt="University Housing logo" title="NC State University Housing" />
</p>
<!-- InstanceBeginEditable name="title" -->
<h1>Housing Request Confirmation</h1>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="content" -->
<h2>Thank you!</h2>
<br/>
<br/>
<br/>
<a href ='http://housing.ncsu.edu/apps/checkin/index.php'>Back to check-in page.</a>

<p>Student Record input into Check-In System, redirecting back to check-in form in 5 seconds.</p>
<br/>
Time remaining:<div id="time" name="time" style="font-weight: bold; margin-left:120px; margin-top: -16px;"> </div>
<!-- InstanceEndEditable -->
<p>&nbsp;</p>
<hr />
<p>Copyright &copy; <?php echo date("Y"); ?> NC State University Housing</p>
</body>
<!-- InstanceEnd -->
</html>
<!--Scripts down here-->
<!-- jQuery (necessary for timer) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--Provide a countdown  timer for our users -->
<script src="../js/timer.js"></script>