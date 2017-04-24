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
    <title>Missing Hindi</title>
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
                <h2>Words Hindi Missing</h2><hr>
                <?php
                    $db = connect();
                    $stmt = $db->prepare("select wordid, wordname from englishwords where wordid not in (select parent from hamnosys)");
                    $stmt->execute(array());
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $db = null;

                    foreach ($result as $word) {
                        echo '<a href="editword.php?wordid='.$word['wordid'].'" class="btn btn-primary" style="margin:5px;">'.$word['wordname'].'</a>';
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
