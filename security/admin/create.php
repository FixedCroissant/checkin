<?php
/**
 * User: jjwill10
 * Date: 6/15/2016
 * Time: 9:10 AM
 * Description: TODO add description for this file.
 */
//Get information from the internal security table.
//Set ROOT PATH for project using the document root.
//define('ROOTPATH',$_SERVER['DOCUMENT_ROOT']);

//Get information from the internal security table.
//include(ROOTPATH.'/apps/checkin/security/admin/get_internal.php');

//for debugging the array only.
//var_dump($access_WEB);
?>
<html>
<head>
<title>
    NC State University - Security
</title>
<!--Bootstrap CSS-->
<link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>
<div class="container">
    <div class="row" style="margin-bottom: 126px;">
        <div class="col-md-3">
            IMPORTANT:
        </div>
        <div class="col-md-6">
            <p>
                The recommended way of providing other access to this system is through the <span style="text-decoration: underline;">MyPack Portal System</span>, as the University Housing Check In Application will check both areas for a single approval.
                This is used as a backup method of granting access to others within the University Housing community.</p>
        </div>
        <div class="col-md-3">
            &nbsp;
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            &nbsp;
        </div>
        <div class="col-md-6">
            <p>
                All fields are required before adding a new user to the system.
            </p>
        </div>
        <div class="col-md-3">
            &nbsp;
        </div>
    </div>
    <form class="form-horizontal" action="actions/create_record.php" method="post">
        <!--StudentID-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="student_ID">Student ID:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="StudentID" name="student_ID" maxlength="9" required>                
            </div>
        </div>
        <!--UnityID-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="UnityID">UnityID:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="UnityID" name="UnityID" maxlength="8" required>
            </div>
        </div>
        <!--Building-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="Building">Building</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="building" name="building" maxlength="20" required>
            </div>
        </div>
        <!--User Position-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="staff_position">Position</label>
            <div class="col-sm-6">
                <select class="form-control" id="staff_position" name="staff_position" required>
                    <option value="">Select ...</option>
                    <option value="RD">Resident Director</option>
                    <option value="RA">Resident Assistant</option>
                    <option value="CA">Community Assistant</option>
                    <option value="CAC">Community Assistant Coordinator</option>
                    <option value="SD">Service Desk</option>
                    <option value="AD">Assistant Director</option>
                    <option value="ASD">Associate Director</option>
                    <option value="Admin">Admin</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <!--Last Name-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="LastName">Last Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="last_name" name="LastName" required>                
            </div>
        </div>
        <!--First Name-->
        <div class="form-group">
            <label class="control-label col-sm-2" for="FirstName">First Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="first_name" name="FirstName" required>                
            </div>
        </div>
        <!--Submit button-->
        <input type = 'submit' value='Create New User' class="btn btn-sm">
        <!--Back button-->
        <a href="index.php">Back to Main Page</a>
    </form>
</div>

</html>