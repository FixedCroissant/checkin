<?php
/**
 * User: jjwill10
 * Date: 6/15/2016
 * Time: 9:10 AM
 * Description: TODO add description for this file.
 */

//Set ROOT PATH for project using the document root.
define('ROOTPATH',$_SERVER['DOCUMENT_ROOT']);
//Get information from the internal security table and the PeopleSoft/Oracle View.
include(ROOTPATH.'/apps/checkin/security/admin/check_internal_and_sis.php');
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
    <div class="row" style="margin-bottom: 126px; margin-top:25px;">
        <div class="col-md-3">
            &nbsp;
        </div>
        <div class="col-md-6">
             <a  class='btn btn-default' href="https://shib.ncsu.edu/idp/logoutredir.jsp?return_url=https://housing.ncsu.edu/Shibboleth.sso/Logout?return=/apps/loggedout.php">Log Out of Security Screen</a>
        </div>
        <div class="col-md-3">
            &nbsp;
        </div>
    </div>
    <div class="row" style="margin-bottom: 126px;">
        <div class="col-md-2">
            &nbsp;
        </div>
        <div class="col-md-8">
            <p>
			It is recommended that staff accessing the University Housing check-in system by adding the staff's  ID to the RA/CAC table in <a href='https://mypack.ncsu.edu/' title='Go to MyPack Portal'>My Pack Portal</a>. 
			<br/>
			<br/>
			This is an area to allow other staff on campus access as needed to the Check-In system if they do not fit within the RA/CAC role. 
			<br/>
			<br/>
			
			As long as you are in <strong>either</strong> the MyPack Portal system (for RAs & CAs) or 
			this list of users, you will have access to the <a href='https://housing.ncsu.edu/apps/checkin/index.php' title='Click to go to Check-In (aka BEEP!!!) Application'>NC State Housing Check-In</a> system.
			<br/>
			</p>
        </div>
        <div class="col-md-2">
            &nbsp;
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            &nbsp;
        </div>
        <div class="col-md-6">
            <form action="actions/view_record.php" method="post" class="form-group">
               Total Users: <?php echo count($access_WEB_EDIT_USERS)?>
                <br/>
				<br/>				
				<label for="security_id">Security Table List for Check-In:</label>
                <br/>
                <select name="security_id" class="form-control">
                    <option value=''>Select ...</option>
                    <?php
                    foreach($access_WEB_EDIT_USERS as $key=>$myInternalSecurityList)
                    {
                        echo "<option value='$key'>$myInternalSecurityList</option>";
                    }
                    ?>
                    </option>
                </select>
                <br/>
                <input type="submit" value="Go" class="btn-sm btn">
        </form>
        </div>
        <div class="col-md-3">
            &nbsp;
        </div>
    </div>
    <br/>
    <br/>
    <div class="row" style="padding-top: 100px; margin-bottom: 50px;">
        <div class="col-md-3">
            &nbsp;
        </div>
        <div class="col-md-6">
            <p style='text-align:center;'>
                Create new person to access Check-In Application?				
            </p>
        </div>
        <div class="col-md-3">
            &nbsp;
        </div>
    </div>
    <br/>
    <div class="row" style="padding-top: 25px; margin-bottom:10px;">
    <div class="col-md-3">
            &nbsp;
        </div>
        <div class="col-md-6">
            <p style='text-align:center;'>
                Go <a href='https://housing.ncsu.edu/apps/checkin/security/admin/create.php' title='Click Here to create a New User in the Security Table'>here</a> to create a new user.
		    </p>
        </div>
        <div class="col-md-3">
            &nbsp;
        </div>
    </div>
</div>
</html>