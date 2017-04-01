<?php
    require_once("core/init.php");
?>
<!doctype html>
<html>
<head>
    <?php require_once("common-head.php"); ?>
    <title>Login to access this area</title>
</head>
<body>
<?php require_once("nav.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Access Denied</h2><hr>
                
                <p>Please login to view this page. <a href="index.php">Click here</a> to login.</p>
            </div>        
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
