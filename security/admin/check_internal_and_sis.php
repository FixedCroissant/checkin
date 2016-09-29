<?php
/***
 * Author: J.Williams
 * Date: June 16, 2016
 * Version: 1.25 
 * Filename: check_internal_and_sis.php
 * Description: This file checks the internal MySQL database table called "welcome_week_signup_security_users"
 * and checks to see whether or not the person's UnityID exists within the table. If it does, the person it eligibile to utilize
 * the University Housing Check-In/Beep application during Fall terms.
 * The application also checks for whether or not the students ID (not UnityID) exists within the "PS_NC_HIS_STAFF" table regardless of their
 * role as a RA/CA/CAC, etc. 
 *
 *
 *
 * Update on: July 11, 2016
 * Thirdly, it also checks the 24hour service desk list for a matching student or employee ID. If the person has a matching emplid within the 
 * 24 hour service desk area, they will have access as well. 
 *
 *
 * IN A NUTSHELL: If the person exists within either the PeopleSoft/MyPackPortal (by Employee ID) OR the "welcome_week_signup_security_users" (by UnityID) they will
 * have access to the application. If they do not exist in either one of the 3 areaa, they will be redirected to a page that states they do not have access.
 ***/

//Get required log-in information
//In the file, the connection is called $mysqli

//Set rootpath
define('ROOTPATH',__DIR__);

//Get log-in credentials (mySQLi and Oracle)
//When running from the main application folder, use these proper connects to get access to both database connections.
if(ROOTPATH=="/home/housing/public_html/apps/checkin"){
    include(ROOTPATH.'/db/mySQLi/connection.php');
    //Get log-in credentials for PeopleSoft DV1.
    //Development...
    //include('../mysql/psdb-DV1.php');    
    
    //Get log-in credentials for PeopleSoft PRD.
    //Production information     
    include('../mysql/psdb-PROD.php'); 
}
//Get log-in credentials (mySQLi and Oracle)
//When using the admin security page that changes and removes users from the security table, change the rootpath.
//Pull up the same information when using https://housing.ncsu.edu/apps/development/checkin2/security/index.php
else{
    include(ROOTPATH.'/apps/checkin/db/mySQLi/connection.php');
    //Get log-in crdentials for PeopleSoft DV1 View.
    //include(ROOTPATH.'/apps/mysql/psdb-DV1.php');
    
    
    //Get log-in credentials for PeopleSoft PRD.
    //Production information    
    include(ROOTPATH.'/apps/mysql/psdb-PROD.php');
    }


//Those that can access the file are stored within one (or both) of these two arrays.
$access_WEB;
$access_WEB = array();

//New Array to utilize when editing and altering users.
$access_WEB_EDIT_USERS = array();

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
//Query to utilize
$query = "SELECT id,unityID,building,last_name,first_name FROM welcome_week_signup_security_users
          ORDER BY building";
$result = $mysqli->query($query);

/* associative array */
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    //lowercase unityid put inside my array.
    $access_WEB[] = (strtolower($row['unityID']));

    //Access Array by internal ID in the table and display the last name and first name.
    //This array will be used within the /security/admin/index.php file to add and remove people from the security table.
    $access_WEB_EDIT_USERS[$row['id']]= (strtoupper($row['building']).':'.ucfirst($row['last_name'])).','.(ucfirst($row['first_name']));
}
/**
 * END CHECKING INTERNAL DATABASE TABLE WITH MYSQL.
 */

/**
 * CHECK PEOPLE SOFT INFORMATION
 * THIS PART CHECKS THE RA/CAC TABLE. 
 */

//my id.
//$studentID='XXXREMOVEDXXXX';
//students id
//$studentID = 'XXXREMOVEDXXX';

//IMPORTANT -- MUST SET THIS....
//Semester we are looking for students within the PeopleSoft view.
$semesterToLookForStudentsInPeopleSoft = "2168"; //Fall 2016.

//Create a third array to utilize any store employee Ids if their student ID provided matches anything within the "PS_NC_HIS_STAFF" table.
$access_WEB_ORACLE = array();

//Connection name.... = CONN
//DEVELOPMENT CONNECTION.
//$conn = oci_connect($oracle_USERNAME,$oraclePASSWORD,$host);
//PRODUCTION CONNECTION VARIABLE IS CALLED $psconnect.
//Check for connection errors.
if(!$psconnect){
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//SQL query.
//PeopleSoft View Name: PS_NC_HIS_STAFF
$sql = 'SELECT emplid,building FROM PS_NC_HIS_STAFF WHERE emplid = :studentID AND EFFECTIVE_TERM = :termLOOKINGFOR';

//Parse the connection
$stid = oci_parse($psconnect,$sql);

//Add named parameters
//Parameter 001
//Bind the student ID.
$parameters001 = oci_bind_by_name($stid,":studentID",$studentID);
//Parameter 002
//Bing the semester that we are looking for.
$parameters002 = oci_bind_by_name($stid,":termLOOKINGFOR",$semesterToLookForStudentsInPeopleSoft);

//Execute query.
oci_execute($stid);

//Dump Information
//COMMENTED OUT ON 06-20-2016 as cannot modify headers with this echo statement.
//echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    //Assign any found studentIDs and put them inside my array.
    //Note: To remove check of RA/CAC students, just comment out the below line.
	$access_WEB_ORACLE[] = ($row['EMPLID']);
}
//echo "</table>\n";
//Development only....
//Commented out on 06/20/2016
//var_dump($access_WEB_ORACLE);


/**
 * CHECK PEOPLE SOFT INFORMATION
 * THIS PART CHECKS THE 24 Hour Service Desk table. 
 */


//Create a third array to utilize any store employee Ids if their student ID provided matches anything within the "PS_NC_HIS_STAFF" table.
//Using the same $access_WEB_ORACLE array as above. 
//Commented out this array creation.
//$access_WEB_ORACLE = array();

//Connection name.... = CONN
//DEVELOPMENT CONNECTION.
//$conn = oci_connect($oracle_USERNAME,$oraclePASSWORD,$host);
//PRODUCTION CONNECTION VARIABLE IS CALLED $psconnect.
//Check for connection errors.
if(!$psconnect){
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//SQL query.
//PeopleSoft View Name: PS_NC_HIS_24STF_VW
$sql = 'SELECT emplid,building FROM PS_NC_HIS_24STF_VW WHERE emplid = :studentID';

//Parse the connection
$connection_to_look_for_24_hour_desk_users = oci_parse($psconnect,$sql);

//Add named parameters
//Parameter 001
//Bind the student ID that is provided through Shibboleth.
$parameters001 = oci_bind_by_name($connection_to_look_for_24_hour_desk_users,":studentID",$studentID);

//Execute query.
//Query looks for those emplids that exist within the PS_NC_HIS_24STF view.
oci_execute($connection_to_look_for_24_hour_desk_users);

//ASSIGN INFORMATION FOUND IN THE PS_NC_HIS_24STF_VW INTO OUR ARRAY
//AND PROVIDE PROPER ACCESS IF THEIR EMPLID IS FOUND WITHIN THE ORACLE/PEOPLESOFT VIEW.
while ($row = oci_fetch_array($connection_to_look_for_24_hour_desk_users, OCI_ASSOC+OCI_RETURN_NULLS)) {
    //Assign any found studentIDs and put them inside my array.
    //Note: To remove check of 24hour desk workers, just comment out the below line.
	$access_WEB_ORACLE[] = ($row['EMPLID']);
}

/**
 * END CHECK PEOPLE SOFT INFORMATION
 */


/**
 * Function that searches 2 different arrays 
 * @param $UnityIDToSearch   --- ($UnityIDToSearch) contains UnityIDs of those within the internal database table within mySQL.
 * $param $StudentIDToSearch --- ($StudentIDToSearch) contains studentIDs of those within the internal database table within mySQL.
 * @return string
 */
function checkSecurityTable($UnityIDToSearch,$StudentIDToSearch){
    //Array that stores UnityIDs if their unityID is found within the internal MySQL table.
    global $access_WEB;
    //Array that stores student IDs/emplids if they happen to be in the correct PeopleSoft table.
    global $access_WEB_ORACLE;

    //Check internal database table and the peoplesoft table and if they exist in either (not one or the other EITHER)
    //they should have access to the application.
    if(in_array($UnityIDToSearch,$access_WEB,false)||in_array($StudentIDToSearch,$access_WEB_ORACLE,false)){
        //for testing only
        //echo "Security access granted. Access available through the MySQL Internal table or PeopleSoft view.!";
        return "y";
    }
    //If the UnityID or the StudentID is not found in either one of the two tables. Assign the $authorization variable. (It's used within the main index file)
	//
    else{
        //for testing only.
        //echo "Nope, not there";
        return "n";
    }
}
