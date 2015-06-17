<?php
/**
 * Created by PhpStorm.
 * User: jjwill10
 * Date: 6/11/2015
 * Time: 8:14 AM
 * Description: A way of updating the phone number and actual date through the housing checkin program.
 */

//First, connect to the db table.
//This is the testing environment.
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