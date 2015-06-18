<?php

//Grab information from Oracle Connection.
//Below is test environment
//include ('oracleconnect.php');


//Production information
//include('../../mysql/psdb.php');


//Testing
//Query to use.
//$query="SELECT * FROM TEST_STUDENTS";


//Production
//$query="";

//Make the connection with the new query.
$statement=oci_parse($conn,$query);

//Execute the query.
oci_execute($statement);

echo "<table border='1'>\n";
echo "<tr>";
echo "<td>";
echo "No.";
echo "</td>";
echo "<td>";
echo "First Name";
echo "</td>";
echo "<td>";
echo "Last Name";
echo "</td>";
echo "<td>";
echo "Major";
echo "</td>";
echo "<td>";
echo "Residence";
echo "</td>";
echo "<td>";
echo "Room";
echo "</td>";
echo "<td>";
echo "PO Box";
echo "</td>";
echo "</tr>";
while($row = oci_fetch_array($statement,OCI_ASSOC)){
    echo "<tr>\n";
    foreach ($row as $item){
        echo "<td> $item";
    }
}


// Close the Oracle connection
oci_close($conn);