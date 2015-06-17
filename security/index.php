<?php
//Get required log-in information
//In the file, the connection is called $mysqli
include('../../mysql/housing_apps_db_mysqli.php');


//Those that can access the file.

$access_WEB;
$access_WEB = array();

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
//Query to utilize
$query = "SELECT unityID FROM welcome_week_signup_security_users WHERE allow_to_check_in='Y'";
$result = $mysqli->query($query);

/* associative array */
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
//lowercase unityid put inside my array.
$access_WEB[] = (strtolower($row['unityID']));
}

//check array.
//ok works.
//var_dump($access_WEB);



function checkSecurityTable($valueToSearch){
    global $access_WEB;

    if(in_array($valueToSearch,$access_WEB,false)){
        //for testing only
        //echo "It's in there!";
        return "y";
    }else{
        //for testing only.
        //echo "Nope, not there";
        return "n";
    }

}

//checkSecurityTable('pecousin',$access_WEB);
