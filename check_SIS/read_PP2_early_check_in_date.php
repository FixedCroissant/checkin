<?php
/**
 * Author: J.Williams
 * Date: 6/16/2015
 * Time: 8:35 AM
 * Description:
 */

//Read information for the database.
//Production information
include ('../../mysql/psdb-PROD.php');


//First, connect to the db table.
//This is Report View

//Comment out
/*
$psusername='josh';
$pspassword='Beamer2016';

$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521))(CONNECT_DATA=(SID=xe)))';


// CONNECT TO THE ORACLE PEOPLESOFT DB
$psconnect=oci_connect($psusername, $pspassword, $psdb);
if (!$psconnect) {
    $e=oci_error();
    echo htmlentities($e['message']);
}
*/

//Connection name is $psconnect.

//Query
//Looking for Cell Phone Numbers in the current term.

//QUERY LOOKING AT CURRENT AND THE OPTION OF FUTURE TERMS TOO. (ps_nc_his_pp2_vw)
//$query = "SELECT ,EFFECTIVE_TERM,EMPLID,PHONE,NC_LAST_NAME_PRI,NC_LAST_NAME_PRI FROM PS_NC_HIS_PP2_VW WHERE EFFECTIVE_TERM='2157'";

//QUERY LOOKING AT THE CURRENT TERM ONLY.
//CURRENTLY WORKS FOR 2156, BUT NOT 2157, 2158, ETC.
//$query = "SELECT EFFECTIVE_TERM,EMPLID,PHONE,NC_LAST_NAME_PRI,NC_LAST_NAME_PRI FROM PS_NC_HIS_PPE_VW WHERE EFFECTIVE_TERM='2157'";


//Get new column name.
$query="SELECT * FROM PS_NC_HIS_PP2_VW";


//Make the connection with the new query.
$statement=oci_parse($psconnect,$query);

//Execute the query.
oci_execute($statement, OCI_DESCRIBE_ONLY);             //Use OCI_DESCRIBE_ONLY if not fetching rows.


echo "<table border=\"1\">\n";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Type</th>";
echo "<th>Length</th>";
echo "</tr>\n";



$ncols = oci_num_fields($statement);

for ($i = 1; $i <= $ncols; $i++) {
    $column_name  = oci_field_name($statement, $i);
    $column_type  = oci_field_type($statement, $i);

    echo "<tr>";
    echo "<td>$column_name</td>";
    echo "<td>$column_type</td>";
    echo "</tr>\n";
}





//Create table

/*

echo "<table border='1'>\n";
echo "<tr>";
echo "<th>";
echo "Effective_Term";
echo "</th>";
echo "<th>";
echo "ID";
echo "</th>";
echo "<th>";
echo "Last Name";
echo "</th>";
echo "<th>";
echo "First Name";
echo "</th>";
echo "</tr>";

*/
