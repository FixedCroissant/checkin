<?php
// Create connection to Oracle
$connPS = oci_connect("josh", "Beamer2016", "//localhost/xe");
if (!$connPS) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
//print "Connected to Oracle!";
}
// Close the Oracle connection
//oci_close($conn);
?>