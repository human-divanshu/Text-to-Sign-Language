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
    <title>Hamnosys 2 Sigml Tool</title>
    <style>
        @font-face {
            font-family: "My Custom Font";
            src: url(HamNoSysUnicode.ttf) format("truetype");
        }
        .customfont { 
            font-family: "My Custom Font", Verdana, Tahoma;
        }    
    </style>    
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
                <h2>Hamnosys 2 Sigml Tool</h2><hr>

            <form action="" method="post">
                <label for="ham">Paste HamNoSys Here<br><small>(Use HamNoSys Writing Tool to create / edit HamNoSys)</small></label>
                <textarea name="ham" class="customfont" autofocus style="height:80px; width:80%; font-size:30px;"></textarea><br><br>
                <label for="glossword">Enter gloss word here</label>
                <input name="gloss" id="gloss" class="form-control" style="width:80%;">
                <button type="submit" name="convert" class="btn btn-primary">Convert</button>
            </form>

<br>
<p><strong>Output sigml : </strong></p>
<?php

if(isset($_POST['convert'])) {
    $res = hamconvert($_POST['ham'], $_POST['gloss']);
    echo "<pre>";
    $res = str_replace("<","&lt;", $res);
    $res = str_replace("/>","/&gt;", $res);
    $res = str_replace(">","&gt;", $res);
    echo $res;
    echo "</pre>";
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
