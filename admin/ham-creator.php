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
                <h2 style="display:inline-block;">HamNoSys Writing Tool</h2>
                <?php 
                    // show back button only when you came to this page 
                    // from the editword.php page
                    if(isset($_GET['wordid'])) {
                ?>
                <a style="float:right; margin-top:20px;" href="editword.php?wordid=<?php echo $_GET['wordid']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-arrow-circle-o-left"></i> Go back</a><br>
                <?php
                    }
                ?>
                <div style="clear:both;"></div>
                <hr>
<?php
/*
    This code can only be run when ham-creator.php was opened using editword.php page

    If save HamNoSys and Generate SigML button has been clicked
    This block should do the following:
    - Save / Update hmnosys
    - Convert hamnosys to sigml 
    - Write new sigml into file using gloss as file name
    - Update sigmlFiles.json in ../js directory to include the new filename

    The file hamkeyboard.php contains the HTML for hamnosys keyboard
*/
    if(isset($_GET['saveham'])) {
        if(isset($_GET['hns']) && isset($_GET['parent']) && isset($_GET['verified']) && isset($_GET['author']) && isset($_GET['glossword'])) {
            $notation = $_GET['hns'];
            $parent = $_GET['parent'];
            $verified = $_GET['verified'];
            // $author = $_GET['author'];
            $author = getUsername($_SESSION['userId']);
            $glossword = $_GET['glossword'];
            
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

            // hamnosys has been saved for future use
            // convert to sigml from here
            // write the sigml file in front end ../SignFiles

            try {
                $res = hamconvert($notation, $glossword);
             
                // replace every space in gloss word with underscore
                $fileName = preg_replace('/\s+/', '_', $glossword);

                // open file to write sigml to it
                try {
                    $fp = fopen("../SignFiles/".$fileName.".sigml", "w");
                    fwrite($fp, $res);
                    fclose($fp);
                } catch(Exception $e) {
                    echo "ERROR while writing sigml to file";
                    echo $e->getMessage();
                    exit();
                }

                // update sigmlFiles.json in ../js
                // read names of all sigml files in ../SignFiles directory  
                // convert them to json and write in sigmlFiles.json file
                // format for json
                // {"sid": 999,"name": "talktomyhand","fileName": "talktomyhand.sigml"}
                $files = array();
                $filesList = glob('../SignFiles/*.sigml');
                $sid = 0;
                foreach ($filesList as $file) {
                    $sigmlFileName = explode("/", $file);
                    $sigmlFileName = $sigmlFileName[2];
                    $signName = explode(".", $sigmlFileName);
                    $signName = $signName[0];
                    $arr = array("sid" => $sid, "name" => $signName, "fileName" => $sigmlFileName);
                    
                    array_push($files, $arr);

                    $sid++;
                }

                $jsonData = json_encode($files);

                try {
                    $fp = fopen("../js/sigmlFiles.json", "w");
                    fwrite($fp, $jsonData);
                    fclose($fp);

                    // read revision number and update the revision when getting the
                    // sigmlFiles.json
                    
                } catch(Exception $e) {
                    echo "ERROR while writing JSON data to sigmlFiles.json";
                    echo $e->getMessage();
                    exit();
                }

                header("Location: editword.php?wordid=".$_GET['parent']);
                exit();
                
            } catch(Exception $e) {
                echo "Error while convert HamNoSys to SigML";
                echo $e->getMessage();
                exit();
            }
            
            $db = null;
        }
    }
?>                
<?php
/*
    Use the wordid in the GET parameter to 
    extract the hamnosys notation 
*/
if(isset($_GET['wordid'])) {
    $parent = $_GET['wordid'];
    $db = connect();
    $sql2 = "select * from hamnosys where parent = ".$_GET['wordid'];
    $stmt = $db->prepare($sql2);
    $stmt->execute(array());
    $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
    $ham_notation = $result2['notation'];
    // $author = $result2['author'];
    $author = getUsername($_SESSION['userId']);
    $verified = $result2['verified'];

    $db = null;

    // if record is verified the send back to its 
    // edit page
    if($verified == 1) {
        header("Location: editword.php?wordid=".$parent);
        exit();
    }
}
?>                
                <?php require_once("hamkeyboard.php"); ?>          
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>

<script>
/*
    Button to erase hamnosys one chracter at a time
    that were typed using hamnosys virtual keyboard
*/
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
