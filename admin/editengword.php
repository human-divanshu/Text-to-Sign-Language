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
    <title>Edit English Word</title>    
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
                <h2>Edit English Word</h2><hr>
<?php
// update hindi word
if(isset($_POST['engword']) && isset($_POST['wordid']) ) {
 
    $db = connect();

    $wordid = $_POST['wordid'];
    $wordname = $_POST['engword'];

    $sql = "update englishwords set wordname = '".$wordname."' where wordid = ".$wordid;
    $stmt = $db->prepare($sql);
    $stmt->execute(array());
    //$result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $db = null;

    header("Location: editword.php?wordid=".$wordid);
    exit();
}
?>  

<?php
if(isset($_GET['wordid'])) {
    $db = connect();
    $sql = "select * from englishwords where wordid = ".$_GET['wordid'];
    $stmt = $db->prepare($sql);
    $stmt->execute(array());
    $result = $stmt->fetch(PDO::FETCH_ASSOC);  
    $db = null;
}
?>                
            <form action="" method="post">
                <input type="hidden" name="wordid" value="<?php echo $_GET['wordid']; ?>">
                <label>Edit the word and press save</label>
                <textarea id="engword" name="engword" style="font-size:20px; width:80%;" autofocus><?php echo $result['wordname']; ?></textarea><br><br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>  
                    
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
