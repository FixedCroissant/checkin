<?php
/**
 * Date: 6/15/2016
 * Time: 10:20 AM
 */
//Get database connection.
include('../../../db/mySQLi/connection.php');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//POST PARAMETERS
//Get values from the post
$stu_id = $_POST['student_ID'];
$staff_position = $_POST['staff_position'];
$UnityID = $_POST['UnityID'];
$Building = $_POST['building'];
$LastName = $_POST['LastName'];
$FirstName = $_POST['FirstName'];
//By default allow every newly created user access to the system.
$allow_to_check_in = 'Y';

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
<div class="row">
        <div class="col-md-12">
            &nbsp;
        </div>
</div>
<div class="row">
        <div class="col-md-12">
            &nbsp;
        </div>
</div>
<div class="row">
        <div class="col-md-12">
            &nbsp;
        </div>
</div>


<?
//Validate posted item.
$errors = array();

//Add to the array.
if(empty($UnityID))
{
    $errors[]=1;
}if(empty($Building))
{
    $errors[]=2;
}
if(empty($LastName))
{
    $errors[]=3;
}
if(empty($FirstName))
{
    $errors[]=4;
}


echo "<div class='col-md-12'>";
echo "<ul>";

if(empty($errors)){
    /*Create new entry*/
    $sql = "INSERT INTO welcome_week_signup_security_users (stu_id,unityID,building,staff_position,last_name,first_name,allow_to_check_in)
            VALUES (?,?,?,?,?,?,?)";
    /*Prepare query*/
    $stmt = $mysqli->prepare($sql);

    var_dump($stmt);
    /*Bind Parameters*/
    //7 parameters,
    //(i) - integer - stu_id
    //(s) - string - unity_id
    //(s) - string - building
    //(s) - string - staff_position
    //(s) - string - last name
    //(s) - string - first_name
    //(s) - string - allow to check in

    /*bind parameters for markers*/
    $stmt->bind_param("issssss",$stu_id,$UnityID,$Building,$staff_position,$LastName,$FirstName,$allow_to_check_in);

    /*execute query*/
    $stmt->execute();




    /*Check for errors on the execution*/
    /*Check for errors on execution*/
    if($stmt ->errno){
        echo "Failure Creating Record, error no: ". $stmt->error;
    }
    //No errors updating...
    else{
        echo "New user created!";
        echo "<br/>";
    }



}
//There are errors in the submission... go ahead and let the user know of the errors.
else{
    //Check array for errors.
//UnityID
    if(in_array(1,$errors))
    {
        echo "<li>";
        echo "Missing UnityID";
        echo "</li>";
    }
//Building
    if(in_array(2,$errors))
    {
        echo "<li>";
        echo "Missing Building";
        echo "</li>";
    }
//LastName
    if(in_array(3,$errors))
    {
        echo "<li>";
        echo "Missing Last Name";
        echo "</li>";
    }
//First Name
    if(in_array(4,$errors))
    {
        echo "<li>";
        echo "Missing First Name";
        echo "</li>";
    }


}



//End checking array for errors
echo "</ul>";
echo "</div>";
?>
</div>
</div>
</body>
</html>

