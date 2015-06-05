<?php require_once('../mysql/housing_apps_db_mysqli.php'); ?>
<?php
/* 
 * Author: J. Williams
 * Date: 03/06/2014
 * Version: 1.00
 * Description: A basic report that lists all the students that have told University Housing that they're going to be doing a Co-Op in the upcoming term..
 */

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
<html>
<head>
<title>
University Housing - Welcome Week Sign Up
</title>
<!--jQuery Import - minified-->
<script src='//code.jquery.com/jquery-1.11.1.min.js' type='text/javascript'></script>
<!--jQuery DataTable script-->
<script src='//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js' type='text/javascript'></script>
<!--jQuery DataTable CSS Import -->
<link rel='stylesheet' type='text/css' href='//cdn.datatables.net/1.10.4/css/jquery.dataTables.css'>
<link rel='stylesheet' type='text/css' href='css/report.css'>
<!--Fav Icon-->
<link rel="icon" type="image/png" href="favicon.ico">
</head>
<body>
<br/>
<br/>
<p><img src="https://housing.ncsu.edu/secure/images/logo.png" alt="University Housing logo" title="NC State University Housing" /></p>
<div id = "header"><h4>Welcome Week Check-In</h4>
</div>
<table id="welcome_week_checkin" border="1">
 <thead>
  <!--Arrival Time-->
 <th>
    Residence Hall 
 </th>    
 <!--8:00-9:00-->
 <th>
     8-9 am
 </th>
 <!--9:00-10:00-->
 <th>
     9-10 am
 </th>
 <!--10:00-11:00-->
 <th>
     10-11 am
 </th>
 <!--11:00-12:00-->
 <th>
     11-12 n
 </th>
 <!--12:00-1:00p-->
 <th>
     12-1 pm
 </th>
 <!--1:00-2:00-->
 <th>
     1-2 pm
 </th>
 <!--2:00-3:00-->
 <th>
     2-3 pm
 </th>
 <!--3:00-4:00-->
 <th>
     3-4 pm
 </th>
 <!--4:00-5:00-->
 <th>
     4-5 pm
 </th>

 <th>
     Totals:
 </th>

</thead>   
<tbody>
    
    
    <?php     
    $residence = "Alexander";    
    $count_Alexander = 0;    
    $beginTIME = 0;
    $endTIME = 0;
    
    
    //Beggining Times
    $timesNEEDED_BEGIN = array("8:00","9:00","10:00","11:00","12:00","1:00","2:00","4:00");
    
    //Ending Times
    $timesNEEDED_ENDING = array("9:00","10:00","11:00","12:00","1:00","2:00","3:00","5:00");
    
    $arrayLENGTH=count($timesNEEDED_BEGIN);
    
    for($i=0;$i<$arrayLENGTH;$i++){
    //Time Needed
    $sql="SELECT * FROM welcome_week_signup WHERE residence='".$residence."' && time_of_swipe >='".$timesNEEDED_BEGIN[$i]."' && time_of_swipe <'".$timesNEEDED_ENDING[$i]."'";
    
    
    
    //Execute the query and store the results in the variable result.   
   $result = $conn->query($sql);
   
   
   
   //Get Number of Rows
   $number_of_rows_LIST=array(mysqli_num_rows($result));
   
   echo $sql;
    }
    
    
    
   
    
    
    ?>   
    
    
    <!--<tr>
        <td>
            Alexander            
        </td>
    </tr>-->
    
</tbody>   
    
<?php

if ($result->num_rows > 0) {
    
    
    
    
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr >";
        //echo "<td >" . $row["id"]. "</td>" . "<td >".$row["timestamp"]."</td>". "<td >".$row["name"]."</td>". "<td >".$row["student_id"]."</td>". "<td >".$row["email"]."</td>". "<td >".$row["company"]."</td>". "<td >".$row["company_location"]."</td>". "<td >".$row["cooperative_education_begin_date"]."</td>". "<td >".$row["cooperative_education_end_date"]."</td>". "<td >".$row["signature_student"]."</td>". "<td >".$row["signature_student_date_sign"]."</td>". "<td >".$row["signature_co_op_coordinator"]."</td>". "<td >".$row["signature_co_op_coordinator_date_sign"]."</td>";
    //From 10:00 - 11:00 am
        
    echo   $number_of_rows_LIST[0];
        
        echo "</tr>";        
    }
    
} else {
    echo "0 results";
}
$conn->close();
?>
</tbody>
</table>
</body>
<html>
