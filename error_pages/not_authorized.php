<!DOCTYPE html>
<!--
Author: J. Williams
Date: 6/17/2015
Description: A page that will be displayed to users that are not within the 'welcome_week_signup_security_users' with a 'y' flag. This will state to users that this application
is only for use by specific users within the housing community and to logout.
-->


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NC State University - Housing - Check-In</title>
    <!--Fav Icon Set-->
    <link rel="shortcut icon" href="https://housing.ncsu.edu/images/favicon.ico" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!--Custom CSS-->
    <link rel="stylesheet" href="../css/checkin.css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!--Parsley CSS Theme-->
    <link rek="stylehseet" href="../css/parsley.css">
    <!--Align th new student popup to the right-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="container-fluid">
    <div id="header">
        <input type="button" name="logout" onClick="window.location='https://housing.ncsu.edu/Shibboleth.sso/Logout'"
               value="Logout of Beep System" style="float:right;" />
        <img class="img-responsive" src="../images/logo.png" alt="University Housing">
    </div>
    <h2>North Carolina State University </h2>
    <h3>Housing Check-In Application</h3>

        <div id="application_table">
            <!--Row #1-->
            <div class="row" style="margin-top:50px;">
                <div class="col-sm-3"></div>
                <div class="col-sm-3 col-md-6"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>
            <!--Row #2-->
            <div class="row" style="margin-bottom:350px;">
                <div class="col-sm-3"></div>
                <div class="col-sm-3 col-md-6"><img src="../images/error01.png">&nbsp; &nbsp; This page is only for select members of the University Housing community. Please use the logout button in the above right corner to logout.</div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
            </div>





            <!--END DISPLAY RESULTS -->
        </div> <!--End Application table-->



    <hr>
    <div id="footer">
        <p>
            NC State University Housing Copyright © 2015
        </p>
    </div>


</div><!--End Container Fluid-->


</body>
</html>
