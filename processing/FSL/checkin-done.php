<?php
//Date: 04-10-2015
//FileName: checkin-done.php
//Specifically for Fraternity and Sorority life.
//This is the file that updates the internal welcome_week_signup table and updates the cell phone number if provided.
//The actual date arrived within the Student Information System is not updated.
//The page will redirect back to the FSL front page after each successfull check-in, error or attempt at entering a person
//already in the system.


//Redirect  Browser after 5 seconds
//This will redirect back to the Fraternity & Sorority Life Page FSL) check-in page.
header( 'refresh: 5; url=http://housing.ncsu.edu/apps/checkin/FSL/index.php' );

//Get connection (MySQLi) from the housing database.
include('../../../mysql/housing_apps_db_mysqli.php');
//Get connection (PDO) from the housing database.
//Version 2.0 of BEEP system.


//See if we can connect to the database
if($mysqli->connect_error){
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

//Get post variables
//Residence or Location
$residence=$_REQUEST["searched_residence_location"];
$residence_room=$_REQUEST["searched_residence_room"];

//Residence Group
$residenceGROUP=setResidenceGroup($residence);

//Set Residence's Campus area;
$residence_campus_area = setCampusArea($residence);


/**
 * Function that changes the building name provided by PeopleSoft and creates separate groups of buildings.
 * If, for instance, AFC - A is pulled, then the resident group will be Avent Ferry. If it's Becton, then residence group will be
 * named Becton Hall.
 * @return string residenceGroup
 **/
function setResidenceGroup($buildingName){
    if($buildingName==="AFC - A" || $buildingName==="AFC - B" || $buildingName==="AFC - E"||$buildingName==="AFC - F" ){
        $residenceGROUP="Avent Ferry";
    }
    if($buildingName==="Wolf Vlg A" || $buildingName==="Wolf Vlg B" || $buildingName==="Wolf Vlg C"||$buildingName==="Wolf Vlg D"||$buildingName==="Wolf Vlg E"||$buildingName==="Wolf Vlg F"||$buildingName==="Wolf Vlg G"||$buildingName==="Wolf Vlg H"){
        $residenceGROUP="Wolf Village";
    }
    if($buildingName==="Wood - A" || $buildingName==="Wood - B" ){
        $residenceGROUP="Wood Hall";
    }
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


//Swiped in student's first name and last name from the Oracle DB.
//Protect user inputs against escaped strings.
//Get student's first name.
$student_signedin_firstname = mysqli_real_escape_string($mysqli,$_REQUEST["searched_residence_fname"]);

//Get student's last name.
$student_signedin_lastname=  mysql_escape_string($_REQUEST["searched_residence_lname"]);

//Get Student's Gender
$studentgender = $_REQUEST["searched_residence_gender"];
//Get Student's Classification
$studentclassification = $_REQUEST["searched_residence_classification"];
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


//If the person's cell phone is incorrect, let's provide a correct phone number.
//Format cell phone number
$cellphone_new=preg_replace('/\D+/', '',$_REQUEST["cellphone_new"]);

//RUN WENJI'S Function
//IF THE CELL PHONE VALUE IS EMPTY, THEN DO NOT RUN AND UPDATE THE CELL PHONE SIS
//UPDATE FUNCTION.
if(empty($_REQUEST["cellphone_new"])){
//If the cell phone is empty do nothing.

}

//IF CELL PHONE HAS NEW TEXT IN THE TEXTBOX, GO AHEAD AND UPDATE.
if (!empty($_REQUEST["cellphone_new"])){
//If the phone number is not empty, go ahead and update the number in SIS.

//First, connect to the db table.
    $psusername='XXXREMOVEDXXXX';
    $pspassword='XXXREMOVEDXXXX';

//Commented out on July 16 @ 12:30p
//$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//TESTING ENVIRONMENT.

//Production Server for PeopleSoft.
    $psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=XXXREMOVEDXXX)(PORT=XXXREMOVEDXXX))(CONNECT_DATA=(SID=XXXREMOVEDXXX)))';	//PRODUCTION ENVIRONMENT.
//END PRODUCTION ENVIRONMENT.


// CONNECT TO THE ORACLE PEOPLESOFT DB
//$psconnection=oci_connect($psusername, $pspassword, $psdb);

//If there is any error in connecting to the Oracle DB, let's display the error.
    if (!$psconnection) {
        $e=oci_error();
        echo htmlentities($e['message']);
    }

    /**
     *  UPDATE CELL PHONE NUMBER IN PRODUCTION
     **/

    //Set up SQL query for CellPhone Update.
    $sql = 'BEGIN cs.nc_his_echeck_cell_phone(:emplid, :phone,:term ,:message); END;';

//Parse the SQL connection statement.
    $statement = oci_parse($psconnection,$sql);

//Bind the input parameter
    oci_bind_by_name($statement,':emplid',$emplid,9);

//Bind the input parameter
    oci_bind_by_name($statement,':phone',$phone,10);

//Bind the term parameter
    oci_bind_by_name($statement,':term',$term,4);

//Bind the output parameter
    oci_bind_by_name($statement,':message',$message,100);

//Assign a value to the input

    $emplid = $cardswipe; 	//card swipe is the student id from the system.

    $phone = $cellphone_new; //phone number that we will be updating is called "cellphone_new" in the check-in web-application.

//Currently set to Fall 2016.
    $term='2168';

//Summer I 2156
//Summer II 2157
//Fall 2015 2158

//Execute the statement.
    oci_execute($statement);

// $message is now populated with the output value
//Ignore message.
//Commented out on July 10 at 12:45p
//print "$message\n";

}//End if statement for Cell Phone Not Empty.

//END WENYI'S PHONE UPDATE FUNCTION

/***************************************
 * END ACTUAL DATE UPDATE TO SIS DATABASE.
 * PRODUCTION
 ****************************************/

//SINCE THIS IS FRATERNITY AND SORORITY LIFE, WE DO NOT CARE ABOUT UPDATING THE ACTUAL DATE OF ARRIVAL IN PEOPLESOFT.

/**********
 * INSERT QUERY IN HOUSING DATABASE TABLE (MYSQL)
 **********/

//Switched to PDO for 2016.
$servername = "localhost";
$username = "XXXREMOVEDXXXX";
$password = "XXXREMOVEDXXXX";
$dbname = "XXXREMOVEDXXXX";

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
//If any are blank, do not update the information into the Internal table.
/**
 * CHECK FOR EMPTY INPUT VALUES AND NOT STRICTLY RELY ON JAVASCRIPT VALIDATION
 */

//Check student-signed in cardswipe
if(empty($cardswipe))
{
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
    //Display a link to the end-user to go back to FSL Checkin-Page.
    echo "Please go ". "<a href='http://housing.ncsu.edu/apps/checkin/FSL/index.php'>back</a>"                    ." and double check your entries.";
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
        echo "Please use the following link to go <a href='http://housing.ncsu.edu/apps/checkin/FSL/index.php' title='Go back to the FSL Check In page.'>back</a> to the FSL Check In application.";
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

        //Notice of redirection
        echo "<br/>";
        echo "<br/>";
        echo "You will now be redirected back to the FSL front page in 5 seconds.";
        echo "<br/>";
        echo "<br/>";
        echo "</p>";


    }/*Close if statement*/

}/*Close row_count>=1*/





//If the error array is empty and the student doesn't already, go ahead and insert the student information into the table.
if (empty($errors) && $row_count===0) {

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
    echo "<a href ='https://housing.ncsu.edu/apps/checkin/FSL/index.php'>Back to FSL check-in page.</a>";
    echo "<br/>";
    echo "<p>Student Record input into Check-In System, redirecting back to the Fraternity & Sorority Life check-in webpage in 5 seconds.</p>";
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
<script src="../../js/timer.js"></script>