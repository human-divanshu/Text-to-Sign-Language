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
    <title>Add English Word</title>   
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
                <h2>Add English Word</h2><hr>
            <form action="" method="post">              
                <label>Type word below and press save</label>
                <textarea id="engword" name="engword" style="font-size:20px; width:80%;" autofocus></textarea><br><br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
<?php
// process form, save hindi word
if(isset($_POST['engword'])) {
 
    $db = connect();

    $eword = trim($_POST['engword']);

    if(strlen($eword) > 0) {
      $sql = "insert into englishwords(wordname) values('".$eword."')";
      $stmt = $db->prepare($sql);
      $stmt->execute(array());      

      $sql = "select wordid as id from englishwords order by wordid desc limit 1";
      $stmt = $db->prepare($sql);
      $stmt->execute(array());

      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $id = $result['id'];

      $db = null;
    }

    header("Location: editword.php?wordid=".$id);
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
