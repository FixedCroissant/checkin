<?php
/**
 * Date: 6/15/2016
 * Time: 10:20 AM
 */
define('ROOTPATH',__DIR__);


//Get database connection.
include('../../../db/mySQLi/connection.php');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//POST PARAMETERS
//Get values from the post
$id = $_POST['ID'];
$UnityID = $_POST['UnityID'];
$Building = $_POST['building'];
$staff_position = $_POST['staff_position'];
$LastName = $_POST['LastName'];
$FirstName = $_POST['FirstName'];
?>
<html>
<head>
    <title>
        NC State University Housing - Your Results
    </title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">

</head>
<body>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <a href="../index.php">Back</a>
    </div>
</div>
<br/>
<br/>




<?
//Validate posted item.
if(empty($id)){
    echo "There's nothing submitted!";
    echo "<br/>";
}

//There is an ID submitted within the database.
else{
    /* create prepared statement */
    //Start Query
    $query = " UPDATE welcome_week_signup_security_users SET unityID=?,building=?,last_name=?,first_name=?,staff_position=? WHERE id=?";
    //End Query

    //Prepare Query
    $stmt = $mysqli->prepare($query);


    /*Bind Parameters*/
    //6 parameters,
    //(s)-string - unityID
    //(s) - string - building
    //(s) - string - last name
    //(s) - string - first name
    //(s) - string - staff position
    //(i)/integer - id

    /* bind parameters for markers*/
    $stmt->bind_param("sssssi",$UnityID,$Building,$LastName,$FirstName,$staff_position,$id);

    /*execute query*/
    $stmt->execute();

    /*Check for errors on execution*/
   if($stmt ->errno){
       echo "Failure Updating Record, error no: ". $stmt->error;
   }
   //No errors updating...
   else{
       echo "Updated".$stmt->affected_rows ." rows";
       echo "<br/>";
       echo "Please click the 'back' link above to go back to the main page.";
       echo "<br/>";
       echo "Or, go "."<a href='../../../index.php'>here</a> to go back to the main Check-In Application";
   }
   //Close connection
   $stmt->close();}
?>
</div>
</div>
</body>
</html>

