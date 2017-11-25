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
    <title>Examples Editor</title>
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
                <h2>Examples Editor</h2><hr>
                <form action="" method="post">
                    <textarea style="width:100%; min-height:350px;" name="egs"><?php
                                echo trim(file_get_contents("examples.txt"));
                    ?></textarea>
                    <button type="submit" name="egsave">Save Examples</button>
                </form>                        
                <?php
                if(isset($_POST['egsave'])) {
                    try {
                        $text = trim($_POST['egs']);
                        $fp = fopen("examples.txt", "w");
                        fwrite($fp, $text);
                        fclose($fp);
                        echo "Examples saved! Please wait .... redirecting to updated file ...";
                        //header("Location: egeditor.php");
                        echo '<script>setTimeout(function() { location.replace("egeditor.php")}, 2000);</script>';
                    } catch(Exception $e) {
                        echo "Some error occured !";
                    }
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
