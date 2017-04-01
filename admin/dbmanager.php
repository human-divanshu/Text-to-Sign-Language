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
    <title>Database Manager - ISL</title>
    <style>
    .eng_word {
        display: inline-block; background: #ccc; padding:10px 15px; margin: 5px; width:130px;
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
                <h2>Database Manager</h2><hr>
<?php
$db = connect();

$stmt = $db->prepare("select * from englishwords");
$stmt->execute(array());
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$eng_json = json_encode($result);

$db = null;
?>
<p>Type in box below to filter the list and click word to edit its details:</p>
<form action="" method="get">
<input type="hidden" id="eng_json" value='<?php echo $eng_json; ?>'>                       
<input type="text" autofocus id="search" name="search" placeholder="Type to filter the list below">
</form>
<div id="output">

</div>
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    var eng_words;
    var len;

    function filter()
    {
        search_term = $("#search").val();
        $("#output").html("");

        if(search_term.length == 0) {
            // display everything
            for(ctr = 0; ctr < len; ctr++) {
                currhtml = $("#output").html();
                newhtml = '<span class="eng_word"><a target="_blank" href="editword.php?wordid=' + eng_words[ctr]['wordid'] + '">' + eng_words[ctr]['wordname'] + '</a></span>';
                $("#output").html(currhtml + newhtml);
            }
        } else {
            // display only matching term
            for(ctr = 0; ctr < len; ctr++) {
                w = eng_words[ctr]['wordname'];
                if(w.indexOf(search_term) != -1) {
                    currhtml = $("#output").html();
                    newhtml = '<span class="eng_word"><a target="_blank" href="editword.php?wordid=' + eng_words[ctr]['wordid'] + '">' + w + '</a></span>';
                    $("#output").html(currhtml + newhtml);
                }
            }
        }
    }

    $(document).ready(function() {
        eng_words = JSON.parse($("#eng_json").val());
        len = eng_words.length;
        filter();
    });

    $("#search").keyup(function () {
        filter();
    });
    </script>
</body>
</html>
