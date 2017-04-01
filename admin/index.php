<?php
    require_once("core/init.php");
?>
<!doctype html>
<html>
<head>
    <?php require_once("common-head.php"); ?>
    <title>Admin Panel - ISL from text</title>
</head>
<body>
<?php require_once("nav.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
               <?php
               if(loggedIn()) {
                    include "includes/sideBar.php";
               } else {
                    include "includes/login-form.php";
               }               
               ?>
            </div>
            <div class="col-md-9">
                <h2>Home page</h2><hr>
                <p>Welcome to admin panel of ISL from text. <br><br>Please contact the project team if you are facing any issues.</p>         
            </div>
        </div>
    </div>    
<?php require_once("footer.php"); ?> 
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
