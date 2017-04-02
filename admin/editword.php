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
    <title>Edit Panel - ISL</title>
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
                <h2>Edit Panel - ISL</h2><hr>
<?php
if(!isset($_GET['wordid'])) {
    echo "Falat error : wordid missing. Please contact team with details of the word you were trying to edit.";
} else {
    $wordid = $_GET['wordid'];

    $db = connect();
    
    // get the english word
    $sql1 = "select * from englishwords where wordid = ".$wordid;
    $stmt = $db->prepare($sql1);
    $stmt->execute(array());
    $result1 = $stmt->fetch(PDO::FETCH_ASSOC);

    // get hamnosys
    $sql2 = "select * from hamnosys where parent = ".$wordid;
    $stmt = $db->prepare($sql2);
    $stmt->execute(array());
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);

    // get hindi word
    $sql3 = "select * from hindiwords where parent = ".$wordid;
    $stmt = $db->prepare($sql3);
    $stmt->execute(array());
    $result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;
}
?>      
<table class="table table-striped">
<tr>   
    <td>Word ID (Read only)</td>
    <td> <input name="wordid" style="display:inline-block;" value="<?php echo $wordid; ?>" readonly> </td>
</tr>
<tr>
    <td>English word (<a href="editengword.php?wordid=<?php echo $wordid; ?>">Edit</a>)</td>
    <td> <input type="text" name="eng_wordname" value="<?php echo $result1['wordname']; ?>"> </td>
</tr>
<tr>
    <td>HamNoSys (<a href="ham-creator.php?wordid=<?php echo $wordid; ?>">Edit</a>)</td>
    <td><input type="text" style="font-size:20px;" class="customfont" name="hamnosys" value="<?php echo $result2['notation']; ?>" readonly> </td>
</tr>   
<tr>
    <td>Associated Hindi words<br>
    (<a href="addhindiword.php?parent=<?php echo $wordid; ?>">Add Hindi Word</a>)
    </td>
    <td>
        <?php
            foreach ($result3 as $hword) {
                echo "<p>";
                echo "(<a href='edithindiword.php?wordname=".$hword['wordname']."&parent=".$hword['parent']."'>Edit</a>)&nbsp; &nbsp; &nbsp; ";
                echo "(<a href='delhindiword.php?wordname=".$hword['wordname']."&parent=".$hword['parent']."'>Delete</a>)&nbsp; &nbsp; &nbsp; ";
                echo $hword['wordname'];
                echo "</p>";
            }
        ?>
    </td>
</tr> 
</table>          
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
