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
//Residence Location
$residence=$_REQUEST["searched_residence_location"];
//Residence Room
$residence_room=$_REQUEST["searched_residence_room"];

//Residence Group
//Let's set the residence Group based on what is passed by the building.
$residenceGROUP=setResidenceGroup($residence);				//Residence Grouping, Apartment Group, Residence Hall Name+ [Hall], Greek Building Name to Organization name.

//Set Residence's Campus area;
$residence_campus_area = setCampusArea($residence);

//Variable used to let us know whether or not the person is trying to sign into an apartment area.
//Check if we're pulling a student from an apartment.
$apartmentGroup=isApartmentRequested($residenceGROUP);


/**
 * Function that changes the building name provided by PeopleSoft and creates separate groups of buildings.
 * If, for instance, AFC - A is pulled, then the resident group will be Avent Ferry. If it's Becton, then residence group will be
 * named Becton Hall.
 * @return string residenceGroup
 **/
function setResidenceGroup($buildingName){
    if($buildingName=="AFC - A" || $buildingName=="AFC - B" || $buildingName=="AFC - E"||$buildingName=="AFC - F" ){
        $residenceGROUP="Avent Ferry";
    }
    //Apartment Group 1
    if($buildingName=="Wolf Vlg A" || $buildingName=="Wolf Vlg B" || $buildingName=="Wolf Vlg C"||$buildingName=="Wolf Vlg D"||$buildingName=="Wolf Vlg E"||$buildingName=="Wolf Vlg F"||$buildingName=="Wolf Vlg G"||$buildingName=="Wolf Vlg H"){
        $residenceGROUP="Wolf Village";
    }
    if($buildingName=="Wood - A" || $buildingName=="Wood - B" ){
        $residenceGROUP="Wood Hall";
    }
    //ApartmentGroup 2
    if($buildingName=="WR Grove" || $buildingName=="WR Innovat"|| $buildingName=="WR Lakevw"|| $buildingName=="WR Plaza"|| $buildingName=="WR Tower" || $buildingName=="WR Valley"){
        $residenceGROUP="Wolf Ridge";
    }
    if($buildingName=="Alexander"){
        $residenceGROUP="Alexander Hall";
    }
    if($buildingName=="Bagwell"){
        $residenceGROUP="Bagwell Hall";
    }
    if($buildingName=="Becton"){
        $residenceGROUP="Becton Hall";
    }
    if($buildingName=="Berry"){
        $residenceGROUP="Berry Hall";
    }
    if($buildingName=="Bowen"){
        $residenceGROUP="Bowen Hall";
    }
    if($buildingName=="Bragaw"){
        $residenceGROUP="Bragaw Hall";
    }
    if($buildingName=="Carroll"){
        $residenceGROUP="Carroll Hall";
    }
    if($buildingName=="Gold"){
        $residenceGROUP="Gold Hall";
    }
    if($buildingName=="Lee"){
        $residenceGROUP="Lee Hall";
    }
    if($buildingName=="Metcalf"){
        $residenceGROUP="Metcalf Hall";
    }
    if($buildingName=="North"){
        $residenceGROUP="North Hall";
    }
    if($buildingName=="Owen"){
        $residenceGROUP="Owen Hall";
    }
    if($buildingName=="Sullivan"){
        $residenceGROUP="Sullivan Hall";
    }
    if($buildingName=="Syme"){
        $residenceGROUP="Syme Hall";
    }
    if($buildingName=="Tucker"){
        $residenceGROUP="Tucker Hall";
    }
    if($buildingName=="Turlington"){
        $residenceGROUP="Turlington Hall";
    }
    if($buildingName=="Watauga"){
        $residenceGROUP="Watauga Hall";
    }
    if($buildingName=="Welch"){
        $residenceGROUP="Welch Hall";
    }
    /*Set all Greek Organizations to campus area Greek*/
    if($buildingName=="Grk Vlg-01"){
        $residenceGROUP="Lambda Chi Alpha";
    }
    if($buildingName=="Grk Vlg-02"){
        $residenceGROUP="Sigma Kappa";
    }
    if($buildingName=="Grk Vlg-03"){
        $residenceGROUP="Kappa Alpha";
    }
    if($buildingName=="Grk Vlg-04"){
        $residenceGROUP="Delta Zeta";
    }
    if($buildingName=="Grk Vlg-05"){
        $residenceGROUP="Phi Gamma Delta";
    }
    if($buildingName=="Grk Vlg-07"){
        $residenceGROUP="Sigma Phi Epsilon";
    }
    if($buildingName=="Grk Vlg-08"){
        $residenceGROUP="Alpha Delta Pi";
    }
    if($buildingName=="Grk Vlg-09"){
        $residenceGROUP="Demolished House";
    }
    if($buildingName=="Grk Vlg-11"){
        $residenceGROUP="Kappa Sigma";
    }
    if($buildingName=="Grk Vlg-12"){
        $residenceGROUP="Delta Gamma";
    }
    if($buildingName=="Grk Vlg-13"){
        $residenceGROUP="Kappa Alpha Theta";
    }
    if($buildingName=="Grk Vlg-14"){
        $residenceGROUP="Pi Beta Phi";
    }
    if($buildingName=="Grk Vlg-15"){
        $residenceGROUP="Alpha Tau Omega";
    }
    if($buildingName=="Grk Vlg-16"){
        $residenceGROUP="Sigma Phi Epsilon";
    }
    //SIGMA NU - NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    if($buildingName=="Grk Vlg-2A"){
        $residenceGROUP="Sigma Nu";
    }
    //KAPPA DELTA -- NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    if($buildingName=="Grk Vlg-2C"){
        $residenceGROUP="Kappa Delta";
    }
    return $residenceGROUP;
}

/**
 * Function that will set the area of campus the building resides.
 * If, for instance, Becton is pulled, the the campus area would be east campus.
 * @return string residence_campus_area
 **/
function setCampusArea($buildingName){
    if($buildingName=="AFC - A" || $buildingName=="AFC - B" || $buildingName=="AFC - E"||$buildingName=="AFC - F" ){
        $residence_campus_area="east";
    }
    if($buildingName=="Wolf Vlg A" || $buildingName=="Wolf Vlg B" || $buildingName=="Wolf Vlg C"||$buildingName=="Wolf Vlg D"||$buildingName=="Wolf Vlg E"||$buildingName=="Wolf Vlg F"||$buildingName=="Wolf Vlg G"||$buildingName=="Wolf Vlg H"){
        $residence_campus_area="apt";
    }
    if($buildingName=="Wood - A" || $buildingName=="Wood - B" ){
        $residence_campus_area="east";
    }
    if($buildingName=="WR Grove" || $buildingName=="WR Innovat"|| $buildingName=="WR Lakevw"|| $buildingName=="WR Plaza"|| $buildingName=="WR Tower" || $buildingName=="WR Valley"){
        $residence_campus_area="apt";
    }
    if($buildingName=="Alexander"){
        $residence_campus_area="central";
    }
    if($buildingName=="Bagwell"){
        $residence_campus_area="east";
    }
    if($buildingName=="Becton"){
        $residence_campus_area="east";
    }
    if($buildingName=="Berry"){
        $residence_campus_area="east";
    }
    if($buildingName=="Bowen"){
        $residence_campus_area="central";
    }
    if($buildingName=="Bragaw"){
        $residence_campus_area="west";
    }
    if($buildingName=="Carroll"){
        $residence_campus_area="central";
    }
    if($buildingName=="Gold"){
        $residence_campus_area="east";
    }
    if($buildingName=="Lee"){
        $residence_campus_area="west";
    }
    if($buildingName=="Metcalf"){
        $residence_campus_area="central";
    }
    if($buildingName=="North"){
        $residence_campus_area="east";
    }
    if($buildingName=="Owen"){
        $residence_campus_area="central";
    }
    if($buildingName=="Sullivan"){
        $residence_campus_area="west";
    }
    if($buildingName=="Syme"){
        $residence_campus_area="east";
    }
    if($buildingName=="Tucker"){
        $residence_campus_area="central";
    }
    if($buildingName=="Turlington"){
        $residence_campus_area="central";
    }
    if($buildingName=="Watauga"){
        $residence_campus_area="east";
    }
    if($buildingName=="Welch"){
        $residence_campus_area="east";
    }

    /*Set all Greek Organizations to campus area Greek*/
    /*Set all Greek Organizations to campus area Greek*/
    if($buildingName=="Grk Vlg-01"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-02"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-03"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-04"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-05"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-07"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-08"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-09"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-11"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-12"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-13"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-14"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-15"){
        $residence_campus_area="greek";
    }
    if($buildingName=="Grk Vlg-16"){
        $residence_campus_area="greek";
    }
    //SIGMA NU - NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    //BELOW IS SIGMA NU HOUSE
    if($buildingName=="Grk Vlg-2A"){
        $residence_campus_area="greek";
    }
    //KAPPA DELTA -- NOT BEING TRACKED THROUGH THE BEEP SYSTEM//
    //Below is KAPPA DELTA HOUSE
    if($buildingName=="Grk Vlg-2C"){
        $residence_campus_area="greek";
    }

    return $residence_campus_area;

}//close set campus area.

//Check if the student being submitted is in an apartment or greek building.
function isApartmentRequested($residenceGROUP){
    if($residenceGROUP=="Wolf Village"||$residenceGROUP=="Wolf Ridge"){
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
    $psusername='XXXXXXX';
    $pspassword='XXXXXXX';

//Development Server
//Commented out on 07/06/2016 @ 4:22pm.
//$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//TESTING ENVIRONMENT.

//Production Server
    $psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//PRODUCTION ENVIRONMENT.
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

//Currently set to Fall 2016.
//Set up on 06-24-2016...
    $term='2168';

//Summer I 2156
//Summer II 2157
//Fall 2015 2158

//Execute the statement.
//Turn on cell phone update (if it is provided) on July 15 2015 @ 9:47a.
//Removed Cell Phone Update 08-19-2015..
//Turned back on 06-27-2016 @ 8:54am.
    oci_execute($statement);

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
$psusername='XXXREMOVEDXXX';
$pspassword='XXXREMOVEDXXX';

//Comment out use of the development server on 7/15/2015, 9:47a
//Commented out on 07/06/2016 @ 4:22pm.
//Development Server
//$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=15210))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';//DEVELOPMENT SERVER

//Production Server
$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=16210))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//PRODUCTION ENVIRONMENT.
//END PRODUCTION ENVIRONMENT

// CONNECT TO THE ORACLE PEOPLESOFT DB
$psconnection_for_actual_date_update=oci_connect($psusername, $pspassword, $psdb);

//UPDATE ACTUAL DATE IN PEOPLESOFT
$sql = 'begin CS.NC_HIS_ECHECK_INSERT (:emplid, :actual_date,:timestamp, :message);END;';


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

//Create a date based on the date that is being passed over from the top of the page.
$date_to_format = date_create($actualdate);

//Capture the formatted date in a variable.
$actualdate_to_send_to_SIS=date_format($date_to_format,"m/d/Y");

//Current Time
$timestamp=$time;

//Check if the person is checking into an apartment or greek house.
//If the person resides within an apartment it is not necessary to update the
//actual date with the student information system.
//If its a resident hall, AFC, Bragaw, etc, apartmentGroup should be set to N.
//And the below portion should be run.
if($apartmentGroup=="N"){

    //Commented out on 07 14 2015.
    //echo "<br>";
    //echo "student is NOT checking into an apartment, student will have actual date updated.";
    //echo "<br>";

    //Go ahead and execute the update for the actual arrival date.

    //Set date for right now as the application is running.
    //date_create() should default to current timezone.
    $rightNOW = date_create();

    //Set Date to STOP SIS Actual Date of Arrival Update.
    //Set to turn off at Friday, August 12, 2016 @ 12:01:00am, EST.
    $dateToStopSISUPDATE = date_create("2016-08-12 00:01:00",timezone_open("America/New_York"));

    //If today ($rightNOW) has passed the day we want to stop the update to People Soft... do nothing
    if($rightNOW > $dateToStopSISUPDATE)
    {
        //Need to comment out....
        //commented out on 06-24-2016
        /*
        echo "<br/>";
        echo "deadline date has PASSED!";
        echo "<br/>";
        echo "SIS has NOT been updated.";
        */
        //DO ABSOLUTELY NOTHING....
    }

    //Not past the stopping date, keep updating the date of arrival into the Student Information System.
    else{
        //Below will still update to SIS.
        //DEADLINE HAS NOT PASSED.
        //FOR DEBUGGING.
        //echo "DEADLINE TO TURN OFF SIS HAS NOT PASSED.";

        //TURN OFF CONNECTION TO SIS
        //Turned back on at 06/27/2016 @ 8:56am.
        oci_execute($statement_to_update_actual_date);

        //Update the actual date. By running this OCI_EXECUTE, THE EXPECTED DATE AND ACTUAL DATE WILL BE UPDATED.
        //Once the update has been done once for a student, it cannot be updated again, regardless of whether or not
        //we have a "success" print back.

        //Return message (ignored)
        //Might want to eventually comment this part out.
        //Commenting out as we do not need this.
        //Commented out on 07 10 2015 @ 1:35p
        //echo 'Actual Date Update Message from function: ';
        //echo "<br>";      //line break.
        //print "$message\n";
    }

}
//If the person resides within the an apartment, DO NOT execute an update of the SIS view.
else if($apartmentGroup=="Y"){
    //Do nothing, as we're not going to want to update the actual date for those residents
    //within a apartment community.
}
/***************************************
 * END ACTUAL DATE UPDATE TO SIS DATABASE.
 * PRODUCTION
 ****************************************/


/***********************************************
 * INSERT QUERY IN HOUSING DATABASE TABLE (MYSQL)
 **********************************************/

//Switched to PDO for 2016.
$servername = "localhost";
$username = "XXXREMOVEDXXX";
$password = "XXXREMOVEDXXX";
$dbname = "XXXREMOVEDXXX";

//Added 06-23-2016.
$sql_check_student="SELECT * FROM welcome_week_signup WHERE cardswipe=:emplid";

//If there are no errors in the error array... see if the person is already in the system..
//PDO STATEMENT.
$connectionTOCHECKSTUDENTS = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
$connectionTOCHECKSTUDENTS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Our PDO statement
$statementToCheckForStudent = $connectionTOCHECKSTUDENTS->prepare($sql_check_student);
//BIND THE STUDENT'S CARD.
$statementToCheckForStudent->bindParam(':emplid',$cardswipe);
//Execute statement
$statementToCheckForStudent->execute();
//Get rows
$row_count = $statementToCheckForStudent->rowCount();
//End checking whether the person is in the system or not.




//Only execute the insert to the 'welcome_week_signup" table if there are NO ROWS at all.

//If the person checking in hasn't checked in before in the past.... then go ahead and add them to the table, 'welcome_week_signup'
$errors = array();

//Check for empty rows
//At a minimum, we should have a first name, last name, cardswipe (i.e. emplid), gender if any of these are blank,
/**
 * CHECK FOR EMPTY INPUT VALUES AND NOT STRICTLY RELY ON JAVASCRIPT VALIDATION
 */

//Check student-signed in cardswipe
if(empty($cardswipe))
{
    //Debugging only.
    //echo "cardswipe is empty!";
    //Add to my errors array.
    $errors[] = 1;
}
//Check student-signed in first name
if(empty($student_signedin_firstname))
{
    //Add to my errors array.
    $errors[] = 2;
}
//Check student-signed in last name
if(empty($student_signedin_lastname))
{
    //Add to my errors array.
    $errors[] = 3;
}
//Check empty student gender
if(empty($studentgender))
{
    //Add to my errors array.
    $errors[] = 4;
}
//End check for empty rows.

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
<?php
//There are errors submitting
if (!empty($errors)){
    echo '<h2>Errors....</h2>';
}
//No errors submitting and the student has never been entered into the table before.
elseif (empty($errors) && $row_count<1){
    //Display thank you header at the top.
    echo '<h2>Thank you!</h2>';
}
?>
<br/>
<br/>
<br/>
<?php
//If there are any empty values being submitted.
if (!empty($errors)){
    echo "<div class='errors rounded_corners'>";

    echo "<p>";
    echo "<h5>ERROR SUBMITTING TO DATABASE...</h5>";
    echo "<ul>";
    if(in_array(1,$errors)){
        echo "<li>";
        echo "We are missing the Student ID number. Please go back to the main page and try again. Student was NOT entered in the system.";
        echo "</li>";
    }
    if(in_array(2,$errors)){
        echo "<li>";
        echo "We are missing the student's first name. Please go back to the main page and try again. Student was NOT entered in the system.";
        echo "</li>";
    }
    if (in_array(3,$errors)){

        echo "<li>";
        echo "We are missing the student's last name. Please go back to the main page and try again. Student was NOT entered in the system.";
        echo "</li>";
    }
    if (in_array(4,$errors)){

        echo "<li>";
        echo "We are missing the student's gender. Please go back to the main page and try again. Student was NOT entered in the system.";
        echo "</li>";
    }
    echo "<br/>";
    echo "<br/>";
    //Display a link to the end-user to go back
    echo "Please go ". "<a href='https://housing.ncsu.edu/apps/checkin/index.php'>back</a>"                    ." and double check your entries.";

    echo "</p>";
    echo "</div>";
} //Close of the non-empty error list.


//If the person already exists....

//If the person is already in the housing database system, let them know.
if($row_count>=1){

    //Only make sure this happens if cardswipe is NOT empty.
    if(!empty($cardswipe)){

        //My results from the query.
        $results = $statementToCheckForStudent->fetchAll();

        //Provide Header
        //Student already exists in the welcome_week_signup table ...
        echo '<h2>Student has already been entered....</h2>';
        echo "<br/>";
        echo '<p>It appears that this person already exists in the system. He/she has not been entered, if you should need it, here is the result of when he/she was entered into the check-in system:';
        echo "<br/>";
        echo "<br/>";
        echo "Please use the following link to go <a href='https://housing.ncsu.edu/apps/checkin/index.php' title='Go back to the Check In page.'>back</a> to the University Housing Check In application.";
        echo "<br/>";
        echo "<br/>";
        //Create a side-by-side table that will show the information that exists about the student
        //that is already in the table.
        //Left Side of Column.
        echo "<div style='float:left; margin-left:25%; padding-right:50px;'>";
        echo "Student ID:";
        echo "<br/>";
        echo "Last Name:";
        echo "<br/>";
        echo "First Name";
        echo "<br/>";
        echo "Campus Area";
        echo "<br/>";
        echo "Residence";
        echo "<br/>";
        echo "Room";
        echo "<br/>";
        echo "Gender";
        echo "<br/>";
        echo "Classification";
        echo "<br/>";
        echo "Date Checked In:";
        echo "<br/>";
        echo "Time Checked In:";
        echo "<br/>";
        echo "</div>";

        //Right Side of Column
        foreach($results as $foundStudentResults)
        {
            echo $foundStudentResults['cardswipe'];
            echo "<br/>";
            echo $foundStudentResults['resident_lname'];
            echo "<br/>";
            echo $foundStudentResults['resident_fname'];
            echo "<br/>";
            echo $foundStudentResults['residence_campus_area'];
            echo "<br/>";
            echo $foundStudentResults['residence'];
            echo "<br/>";
            echo $foundStudentResults['residence_room'];
            echo "<br/>";
            echo $foundStudentResults['gender'];
            echo "<br/>";
            echo $foundStudentResults['classification'];
            echo "<br/>";
            echo $foundStudentResults['date_of_swipe'];
            echo "<br/>";
            echo $foundStudentResults['time_of_swipe'];
            echo "<br/>";
        }
        echo "<br/>";
        echo "You will now be redirected back to the University Housing Check-In System in 5 seconds.";
        echo "<br/>";
        echo "</p>";


    }/*Close if statement*/

}/*Close row_count>=1*/





//If the error array is empty and the student doesn't already, go ahead and insert the student information into the table.
if (empty($errors) && $row_count==0) {

    //Try putting the information into the database table.
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO welcome_week_signup (residence_campus_area,residence_group,residence,residence_room,residence_suffix,residence_bed_number,resident_fname,resident_lname,gender,classification,cardswipe,date_of_swipe,time_of_swipe,cellphone_new)
        VALUES
        (:residence_campus_area, :residence_group, :residence,:residence_room,:residence_suffix,:residence_bed_number,:resident_fname,:resident_lname,:gender,:student_classification,:student_cardswipe,:date_of_swipe,:time_of_swipe,:cellphone_new)
        ");

        //Bind the above parameters
        $stmt->bindParam(':residence_campus_area',  $residence_campus_area);
        $stmt->bindParam(':residence_group', $residenceGROUP);
        $stmt->bindParam(':residence', $residence);
        $stmt->bindParam(':residence_room', $residence_room);
        $stmt->bindParam(':residence_suffix',$resident_suffix );
        $stmt->bindParam(':residence_bed_number', $resident_unit_number);
        $stmt->bindParam(':resident_fname', $student_signedin_firstname);
        $stmt->bindParam(':resident_lname', $student_signedin_lastname);
        $stmt->bindParam(':gender', $studentgender);
        $stmt->bindParam(':student_classification', $studentclassification);
        $stmt->bindParam(':student_cardswipe', $cardswipe);
        $stmt->bindParam(':date_of_swipe', $today);
        $stmt->bindParam(':time_of_swipe', $time);
        $stmt->bindParam(':cellphone_new', $cellphone_new);

        //Execute the query and insert the information into the database table.
        $stmt->execute();
    }

        //Catch any errors when inserting into the database.
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    //Turn off connection to MySQL database table.
    $conn = null;

    //If no errors, place a message and link on the following page.
    echo "<a href ='http://housing.ncsu.edu/apps/checkin/index.php'>Back to check-in page.</a>";
    echo "<br/>";
    echo "<p>Student Record input into Check-In System, redirecting back to check-in form in 5 seconds.</p>";
    echo "<br/>";
    echo "Time remaining:<div id='time' name='time' style='font-weight: bold; margin-left:120px; margin-top: -16px;'> </div>";


}/*Close no empty values in the error array.*/

?>
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