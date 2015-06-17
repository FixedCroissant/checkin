<?php
/**
 * Created by PhpStorm.
 * User: jjwill10
 * Date: 6/11/2015
 * Time: 4:50 PM
 * Description: A way of checking if the student has a valid early check-in request.
 * Works as intended.
 
 */

//First, connect to the db table.
//This is the TESTING (DV1) environment.
$psusername='XXXXXX';
$pspassword='XXXXXX';
$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=cs900dv1.et.ncsu.edu)(PORT=15210))(CONNECT_DATA=(SID=CS900DV1)))';

// CONNECT TO THE ORACLE PEOPLESOFT DB
$psconnect=oci_connect($psusername, $pspassword, $psdb);

//If there is any error, lets display the error.
if (!$psconnect) {
    $e=oci_error();
    echo htmlentities($e['message']);
}

/**
*	TESTING WENYI's EARLY CHECK-IN FUNCTION THAT DETERMINES IF THE PERSON HAS A VALID CHECK-IN REQUEST.
*/
/*
Function Name: CS.NC_HIS_ECHECK_VALID
PURPOSE: Checks students have valid early check-in request or not.
FUNCTION RETURN VALUES:
		0 --- No Early check-in request but have a valid assignment.
		1 --- Valid early check-in request
		2 --- No housing assignment yet but have housing application.
		3 --- Error
*/

$sql='select cs.nc_his_echeck_valid (\'200090440\') from dual';


$stmt = oci_parse($psconnect,$sql);

//Execute the statement.
$test = oci_execute($stmt);

//Print the result;
echo $test;
/**
 * END TESTING WENYI's EARLY CHECK-IN FUNCTION THAT DETERMINES IF THE PERSON HAS A VALID CHECK-IN REQUEST.
 * 
 **/
