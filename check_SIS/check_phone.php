<?php
/**
 * Created by PhpStorm.
 * User: jjwill10
 * Date: 6/11/2015
 * Time: 9:24 AM
 */

//First, connect to the db table.
//This is Report View

$psusername='XXXXXX';
$pspassword='XXXXXX';

$psdb='(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=cs900rpt.et.ncsu.edu)(PORT=16210))(CONNECT_DATA=(SID=CS900RPT)))';

// CONNECT TO THE ORACLE PEOPLESOFT DB
$psconnect=oci_connect($psusername, $pspassword, $psdb);
if (!$psconnect) {
    $e=oci_error();
    echo htmlentities($e['message']);
}

//Query
//Looking for Cell Phone Numbers in the current term.

//QUERY LOOKING AT CURRENT AND THE OPTION OF FUTURE TERMS TOO. (ps_nc_his_pp2_vw)
//$query = "SELECT EFFECTIVE_TERM,EMPLID,PHONE,NC_LAST_NAME_PRI,NC_LAST_NAME_PRI FROM PS_NC_HIS_PP2_VW WHERE EFFECTIVE_TERM='2156'";

//QUERY LOOKING AT THE CURRENT TERM ONLY.
//CURRENTLY WORKS FOR 2156, BUT NOT 2157, 2158, ETC.
$query = "SELECT EFFECTIVE_TERM,EMPLID,PHONE,NC_LAST_NAME_PRI,NC_LAST_NAME_PRI FROM PS_NC_HIS_PPE_VW WHERE EFFECTIVE_TERM='2157'";
//$query="select COLUMN_NAME from  ALL_TAB_COLUMNS where TABLE_NAME ='PS_NC_HIS_PP2_VW'";

//Make the connection with the new query.
$statement=oci_parse($psconnect,$query);

//Execute the query.
oci_execute($statement);


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


while($row = oci_fetch_array($statement,OCI_ASSOC)) {
    //Create new Row
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "<td> $item";
    }
}

// Close the Oracle connection
oci_close($psconnect);