<?php
/**
 * Created by PhpStorm.
 * User: jjwill10
 * Date: 6/11/2015
 * Time: 9:24 AM
 */

//First, connect to the db table.
//This is Report View


$psusername='josh';
$pspassword='Beamer2016';

$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521))(CONNECT_DATA=(SID=xe)))';




// CONNECT TO THE ORACLE PEOPLESOFT DB
$psconnect=oci_connect($psusername, $pspassword, $psdb);
if (!$psconnect) {
    $e=oci_error();
    echo htmlentities($e['message']);
}

//Query
//Looking for Cell Phone Numbers in the current term.

/*$query = "SELECT COLUMN_NAME FROM PS_NC_HIS_PP2_VW WHERE EFFECTIVE_TERM='2156'";*/

//$query = "SELECT * FROM PS_NC_HIS_PPE_VW WHERE EFFECTIVE_TERM='2158'";

$query="select COLUMN_NAME from  ALL_TAB_COLUMNS where TABLE_NAME ='PS_NC_HIS_PPE_VW'";


//Make the connection with the new query.
$statement=oci_parse($psconnect,$query);

//Execute the query.
oci_execute($statement);


while($row = oci_fetch_array($statement,OCI_ASSOC)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "<td> $item";
    }
}

// Close the Oracle connection
oci_close($psconnect);