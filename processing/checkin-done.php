<?php
//Redirect  Browser after 3 seconds
//header( 'refresh: 3; url=http://housing.ncsu.edu/apps/checkin/index.php' );

//Get connection from the housing database.
include('../../mysql/housing_apps_db_mysqli.php');

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

//Let's set the residence Group based on what is passed by the building.
//setResidenceGroup($residence);


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
 * INSERT QUERY
 */

//Query Statement
//Old SQL when using the cellphone and key_code information.
//$sql="INSERT INTO welcome_week_signup (cardswipe,date_of_swipe,time_of_swipe,key_code,roommate_check_in,cellphone_new) VALUES ('$cardswipe', '$today','$time','$keycode','$roommate_check_in','$cellphone_new')";

//Working SQL
//$sql="INSERT INTO welcome_week_signup (residence,residence_room,resident_fname,resident_lname,cardswipe,date_of_swipe,time_of_swipe) VALUES ('$residence','$residence_room','$student_signedin_firstname','$student_signedin_lastname','$cardswipe', '$today','$time')";

//$sql="INSERT INTO welcome_week_signup (residence_group,residence,residence_room,resident_fname,resident_lname,cardswipe,date_of_swipe,time_of_swipe) VALUES ('$residenceGROUP','$residence','$residence_room','$student_signedin_firstname','$student_signedin_lastname','$cardswipe', '$today','$time')";

//Updated on 4-28-2015; added a column in the database that allows for capture of the SIS actual date they signed in.
$sql="INSERT INTO welcome_week_signup (residence_campus_area,residence_group,residence,residence_room,residence_suffix,residence_bed_number,resident_fname,resident_lname,gender,classification,cardswipe,date_of_swipe,time_of_swipe,cellphone_new) VALUES ('$residence_campus_area','$residenceGROUP','$residence','$residence_room','$resident_suffix','$resident_unit_number','$student_signedin_firstname','$student_signedin_lastname','$studentgender','$studentclassification','$cardswipe', '$today','$time','$cellphone_new')";



//If the person is already in the housing database system, let them know.
if($row_count>=1){
    //Go to a different page if the user has already checked in.
    header('Location: http://housing.ncsu.edu/apps/checkin/error_pages/erroruserinsystem.php');
}

//Only execute the insert to the 'welcome_week_signup" talbe if there are NO ROWS at all.
//If there are any rows at all, go to the erroruserinsystem.php page.
if($row_count===0){

//MySqli Insert Query
    $insert_row = $mysqli->query($sql);


    if($insert_row){
        //If everything is okay, print out a statement.
        //print 'Success! ID of last inserted record is : ' .$mysqli->insert_id .'<br />';
    }else{
        //Problems, proceed to explain the error.
        die('Error : ('. $mysqli->errno .') '. $mysqli->error);
    }
}




/********
 * UPDATE 4-28-2015 -- CHECK ACTUAL DATE FROM SIS DATABASE & SEE IF A VALUE IS PRESENT, IF SO DO NOT UPDATE
 * ALSO, IF THERE IS A DATE, TAKE THAT VALUE & PLACE INTO THE HOUSING DATABASE TABLE "welcome_week_signup" (below)
 */

//all work will be housed in this file//
//temporarily commented out //
//The file below is supposed to check the DATE_1 number in SIS and if there is a value available update in the mySQL table.//
//include('../update/check_actual_record.php');

//Provide the Information to the Check Actual Date Function
//So that we can check and see if there is an actual date already in the system.
//And if there is, assign it to appropriate column in the housing system.
//We have set the returning rows to 1, just in case there are multiple
//records of the same student that come up in the SIS Database table (PS_NC_HIS_PPE_VW).


//comment out
/*


$termWENEED = 2158;
$dateNeededToAssign = getActualDate($cardswipe,$termWENEED,1);

//Check if the returned Value is Empty.
//if the Value is empty, we do not care.
//However, if there is something in the system, we need to update this value with the arrival time
//from the SIS DATABASE
if(empty($dateNeededToAssign)){
    echo "The Actual Date of Arrival Is Empty!!";

}
//If the returned searched value for the Arrival Date is not empty, let's date that value returned
//and update our database table,welcome_week_signup,
else if(!empty($dateNeededToAssign)){

    //Replace '/' with a '-' in the incoming variable, dateNeededToAssign.
    $dateReplace_Slash = str_replace("-","/",$dateNeededToAssign);
    //Reformat the above variable, dateReplace_Slash, to a format 1995-04-01
    //and assign the value to another variable called dateNeededToUpdate.
    //Reformat the date so that it is explicitly YYYY-MM-DD.
    $dateNeededToUpdate=date('Y-m-d', strtotime($dateReplace_Slash));


$update_SQL_DATE_ARRIVAL = "UPDATE welcome_week_signup SET date_of_swipe='$dateNeededToUpdate' WHERE cardswipe='$cardswipe'";

//Run Update Query
$mysqli->query($update_SQL_DATE_ARRIVAL);
}


//Close Statement
$statement_check->close();
*/


?>
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/secureform.dwt.php" codeOutsideHTMLIsLocked="false" -->
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
<p>Student Record input into Check-In System, redirecting to check-in form in 3 seconds.</p>
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