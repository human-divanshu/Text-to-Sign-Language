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
    <title>Delete Hindi Word</title>    
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
                <h2>Delete Hindi Word</h2><hr>
             
<?php
// update hindi word
if(isset($_GET['wordname']) && isset($_GET['parent'])) {
 
    $db = connect();

    $parent = $_GET['parent'];
    $wordname = $_GET['wordname'];

    $sql = "delete from hindiwords where wordname = '".$wordname."' and parent = ".$parent;
    $stmt = $db->prepare($sql);
    $stmt->execute(array());
    //$result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $db = null;

    header("Location: editword.php?wordid=".$parent);
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
