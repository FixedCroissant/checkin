<?php
/**
 * Date: 6/15/2016
 * Time: 10:20 AM
 */
//Get database connection.
include('../../../db/mySQLi/connection.php');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}


//POST PARAMETERS
//Get values from the post
$id = $_POST['security_id'];
?>
<html>
<head>
    <title>
        NC State University Housing - Your Results
    </title>
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">

</head>
<body>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <a href="../index.php">Back</a>
    </div>
</div>
<br/>
<br/>
<div class="row">
    <table class="table">
        <thead>
        <th>
            ID
        </th>
        <th>
            UnityID
        </th>
        <th>
            Building
        </th>
        <th>
            Last Name
        </th>
        <th>
            First Name
        </th>
        <th>
            Edit
        </th>
        <th>
            Remove
        </th>
        </thead>
        <tbody>
<?
//Validate posted item.

if(empty($id)){
    echo "There's nothing submitted! Please go back and try again.";
    echo "<br/>";
    echo "<br/>";
}

//There is an ID submitted within the database.
else{
    /* create prepared statement */
    //Start Query
    $query = " SELECT id,unityID,building,last_name,first_name FROM welcome_week_signup_security_users WHERE id=?";
    //End Query

        /*create a prepared statement*/
        if($stmt = $mysqli->prepare($query))
        {
            /* bind parameters for markers*/
            $stmt->bind_param("s",$id);

            /* execute query */
            $stmt->execute();

            /*bind result variables */
            $stmt->bind_result($retrievedID,$retrievedUnityID,$retrievedBUILDING,$retrievedLAST_NAME,$retrievedFIRST_NAME);

            /*fetch value*/
            $stmt->fetch();

            echo "\t <tr> \n";
            echo "\t <td> \n";
                echo $retrievedID;
            echo "\n</td>\n";
            echo "<td>\n";
                echo $retrievedUnityID;
            echo "</td> \n";
            echo "<td>\n";
                echo $retrievedBUILDING;
            echo "\t </td>";
            echo "<td>";
                echo $retrievedLAST_NAME;
            echo "</td>";
            echo "<td>";
                echo $retrievedFIRST_NAME;
            echo "\t </td>";
            //Edit the Record
            echo "\t <td>\n\n";
                    echo "<form action='edit_record.php' method='post'>\n";
                    echo "<input type='hidden' name='chosen_id' value=$retrievedID>";
                    echo "<input type='submit' class='btn btn-sm' value='edit'>";
                    echo "\n</form>\n";
            echo "</td>\n";
            //Delete the Record
            echo "\t <td>\n\n";
            echo "<form action='delete_record.php' method='post'>\n";
                    echo "<input type='hidden' name='chosen_id' value=$retrievedID>";
                    echo "<input type='submit' class='btn btn-sm' value='remove'>";
                    echo "\n</form>\n";
            echo "</td>\n";
            echo "</tr>\n";
            /*close statement*/
            $stmt->close();
        }
}
?>
</tbody>
</table>
</div>
</div>
</body>
</html>

