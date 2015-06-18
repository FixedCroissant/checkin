<?php
$psusername='XXXXXX';
$pspassword='XXXXXX';
$psdb='XXXXXX';
// CONNECT TO THE ORACLE PEOPLESOFT DB
$psconnect=oci_connect($psusername, $pspassword, $psdb);
if (!$psconnect) {
		$e=oci_error();
		echo htmlentities($e['message']);
	}
?>