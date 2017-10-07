<?php
    require_once("core/init.php");
    
    if(!loggedIn()) {
        header('Location: accessDenied.php');
        exit();
    }
?>
<!doctype html>
<html>
<head>
    <?php require_once("common-head.php"); ?>
    <title>Delete Word</title>    
</head>
<body>
<?php require_once("nav.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
               <?php
               if(loggedIn()) {
                    include "includes/sideBar.php";
               }               
               ?>
            </div>
            <div class="col-md-9">
                <h2>Delete Word</h2><hr>
             
<?php
// update hindi word
if(isset($_GET['wordid'])) {
 
    $db = connect();

    $wordid = $_GET['wordid'];

    $sql = "delete from englishwords where wordid = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($wordid));

    $sql = "delete from hamnosys where parent = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($wordid));

    $sql = "delete from hindiwords where parent = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($wordid));
    
    $db = null;

    header("Location: dbmanager.php");
    exit();
}
?>                      
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
