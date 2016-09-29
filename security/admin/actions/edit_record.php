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
        <a class='btn-sm btn' href="../index.php">Back</a>
    </div>
</div>
<br/>
<!--Recommended Way of adding users-->
<div class="row">
        <div class="col-md-3">
            &nbsp;
        </div>
        <div class="col-md-6">
            <p>
                The recommended way of providing other access to this system is through the <span style="text-decoration: underline;">MyPack Portal System</span>, as the University Housing Check In Application will check both areas for a single approval.
                This is used as a backup method of granting access to others within the University Housing community.
            </p>
        </div>
        <div class="col-md-3">
            &nbsp;
        </div>
</div>
<!--Alternate way of adding users-->
<div class="row">
    <div class="col-md-3">
        Instructions:
    </div>
    <div class="col-md-6">
       <p>
           Please provide the updated information that you want signing into the Check-In Application. Please make sure the <span style="color: red; font-weight:bold; text-decoration:underline;">unityID is correct</span>, as the application will compare
            this value upon logging via the Shibboleth log-in system. All other information is used for identification purposes only.
       </p>
    </div>
    <div class="col-md-3">
        &nbsp;
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
    //Start Query
    $query = " SELECT id,unityID,building,staff_position,last_name,first_name FROM welcome_week_signup_security_users WHERE id=?";
    //End Query
        /*create a prepared statement*/
        if($stmt = $mysqli->prepare($query))
        {
            /* bind parameters for markers*/
            $stmt->bind_param("s",$id);
            /* execute query */
            $stmt->execute();
            /*bind result variables */
            $stmt->bind_result($retrievedID,$retrievedUnityID,$retrievedBUILDING,$retrievedSTAFF_POSITION,$retrievedLAST_NAME,$retrievedFIRST_NAME);
            /*fetch value*/
            $stmt->fetch();
            /*close statement*/
            $stmt->close();
        }
}
?>
    <form class="form-horizontal" action="update_record.php" method="post">
        <!--ID-->
        <input type="hidden" class="form-control" id="id" name="ID"value=<?php echo $retrievedID; ?>>
        <!--UnityID-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="UnityID">UnityID:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="UnityID" name="UnityID" maxlength="8" value=<?php echo $retrievedUnityID; ?>>
            </div>
        </div>
        <!--Building-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="Building">Building</label>
            <div class="col-sm-6">
                <input type="text" class="form-control"  id="building" name="building" value=<?php echo $retrievedBUILDING; ?>>
            </div>
        </div>
        <!--STAFF POSITION-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="Staff_Position">Position</label>
            <div class="col-sm-6">
                <select class="form-control" id="staff_position" name="staff_position">

                    <option value="">Select ...</option>
                    <option value="RD"      <?php if (strtolower($retrievedSTAFF_POSITION) == 'rd'    )  echo 'selected' ; ?>>Resident Director</option>
                    <option value="RA"      <?php if (strtolower($retrievedSTAFF_POSITION) == 'ra'    )  echo 'selected' ; ?> >Resident Assistant</option>
                    <option value="CA"      <?php if (strtolower($retrievedSTAFF_POSITION) == 'ca'    )  echo 'selected' ; ?>>Community Assistant</option>
                    <option value="CAC"     <?php if (strtolower($retrievedSTAFF_POSITION) == 'cac'   )  echo 'selected' ; ?>>Community Assistant Coordinator</option>
                    <option value="SD"      <?php if (strtolower($retrievedSTAFF_POSITION) == 'sd'    )  echo 'selected' ; ?>>Service Desk</option>
                    <option value="AD"      <?php if (strtolower($retrievedSTAFF_POSITION) == 'ad'    )  echo 'selected' ; ?>>Assistant Director</option>
                    <option value="ASD"     <?php if (strtolower($retrievedSTAFF_POSITION) == 'asd'   )  echo 'selected' ; ?> >Associate Director</option>
                    <option value="Admin"   <?php if (strtolower($retrievedSTAFF_POSITION) == 'admin' )  echo 'selected' ; ?> >Admin</option>
                    <option value="other"   <?php if (strtolower($retrievedSTAFF_POSITION) == 'other' )  echo 'selected' ; ?>>Other</option>
                </select>


            </div>
        </div>

        <!--Last Name-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="LastName">Last Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="last_name" name="LastName" value=<?php echo $retrievedLAST_NAME?>>
            </div>
        </div>
        <!--First Name-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="FirstName">First Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="first_name" name="FirstName" value=<?php echo $retrievedFIRST_NAME?>>
            </div>
        </div>
        <!--Submit button-->
        <input type = 'submit' value='Save Record' class="btn btn-sm">
        <!--Back button-->
        <a href="../index.php">Back</a>
</form>
</div>
</div>
</body>
</html>

