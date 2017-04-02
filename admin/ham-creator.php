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
    <title>HamNoSys Writing Tool</title>
    <link href="css/hamnosys.css" rel="stylesheet" />
    <link href="css/tabs.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.tools.min.js"></script>
    <script type="text/javascript" src="js/jquery-fieldselection.js"></script>
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
                <h2>HamNoSys Writing Tool</h2><hr>
<?php
    if(isset($_GET['saveham'])) {
        if(isset($_GET['hns']) && isset($_GET['parent']) && isset($_GET['verified']) && isset($_GET['author'])) {
            $notation = $_GET['hns'];
            $parent = $_GET['parent'];
            $verified = $_GET['verified'];
            $author = $_GET['author'];
            
            $db = connect();
            $sql = "select count(*) as count from hamnosys where parent = ".$parent;
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if($result['count'] == 0) {
                // insert
                $sql = "insert into hamnosys(notation, parent, author, verified) values('".$notation."', ".$parent.", '".$author."', ".$verified.")";
            } else {
                // update
                $sql = "update hamnosys set notation = '".$notation."', verified = ".$verified.", author = '".$author."' where parent = ".$parent;
            }

            //echo $sql;
            $stmt = $db->prepare($sql);
            $stmt->execute(array());
            
            $db = null;
        }
        header("Location: editword.php?wordid=".$_GET['parent']);
        exit();
    }
?>                
<?php
if(isset($_GET['wordid'])) {
    $parent = $_GET['wordid'];
    $db = connect();
    $sql2 = "select * from hamnosys where parent = ".$_GET['wordid'];
    $stmt = $db->prepare($sql2);
    $stmt->execute(array());
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
    $ham_notation = $result2['notation'];
    $author = $result2['author'];
    $verified = $result2['verified'];

    $db = null;
}
?>                
                <?php require_once("hamkeyboard.php"); ?>          
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>

<script>
$("#erasechar").click(function() {
    haminput = $("#hns").val();
    len = haminput.length;
    if (len == 0)
        return;
    $("#hns").val("");
    for(ctr = 0; ctr < len - 1; ctr++) {
        currinput = $("#hns").val();
        $("#hns").val(currinput + haminput[ctr]);
    }
});
</script>
</body>
</html>
