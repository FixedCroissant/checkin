<?php
/**
 * Date: 6/15/2016
 * Time: 10:20 AM
 * Description:
 */
define('ROOTPATH',__DIR__);

//Get database connection.
include('../../../db/mySQLi/connection.php');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//POST PARAMETERS
//Get values from the post
$id = $_POST['chosen_id'];
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
    <?
    //Validate posted item.
    if(empty($id)){
        echo "There's nothing submitted!";
        echo "<br/>";
    }

//There is an ID submitted within the database.
    else{
        /* create prepared statement */
        //DELETE RECORD
        //Start Query
        $query = " DELETE FROM welcome_week_signup_security_users WHERE id=?";
        //End Query

        //Prepare Query
        $stmt = $mysqli->prepare($query);
        /*Bind Parameters*/
        //1 parameter,
        //(i)/integer - id
        /* bind parameters for markers*/
        $stmt->bind_param("i",$id);

        /*execute query*/
        $stmt->execute();

        /*Check for errors on execution*/
        if($stmt ->errno){
            echo "Failure deleting record, error no: ". $stmt->error;
        }
        //No errors updating...
        else{
            echo "Updated".$stmt->affected_rows ." rows";
            echo "<br/>";
            echo "Please click the 'back' link above to go back to the main page.";
            echo "<br/>";
            echo "Or, go "."<a href='../../../index.php'>here</a> to go back to the main Check-In Application";
        }
        //Close connection
        $stmt->close();}
    ?>
</div>
</div>
</body>
</html>

