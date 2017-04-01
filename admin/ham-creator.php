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
