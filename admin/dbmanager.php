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
    <title>Word Manager - ISL</title>
    <style>
    .eng_word0 {
        display: inline-block; background: red; color:white; padding:10px 15px; margin: 5px; width:130px;
    }
    .eng_word0 a{color:white!important;}
    .eng_wordnull {
        display: inline-block; background: red; color:white; padding:10px 15px; margin: 5px; width:130px;
    }
    .eng_wordnull a{color:white!important;}
    .eng_word1 {
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
                <h2>Word Manager</h2><hr>
<?php
$db = connect();

//$stmt = $db->prepare("select * from englishwords order by wordname");
$stmt = $db->prepare("select wordname, wordid, hamnosys.verified from englishwords left join hamnosys on englishwords.wordid = hamnosys.parent order by englishwords.wordname");
$stmt->execute(array());
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$eng_json = json_encode($result);

$db = null;
?>
<p>Type in box below to filter the list and click word to edit its details:</p>
<form action="" method="get">
<input type="hidden" id="eng_json" value='<?php echo $eng_json; ?>'>                       
<input style="display:inline-block;" type="text" autofocus id="search" name="search" placeholder="Type to filter the list below"> &nbsp;&nbsp;
(<a href="addengword.php">Add new word</a>)
<br>
<span style="background:red;">&nbsp; &nbsp;</span> - background means HamNoSys Unverified or Missing &nbsp; &nbsp;
<span style="background:#ccc;">&nbsp; &nbsp;</span> - background means HamNoSys Verified<br>
<br>
<span id="searchhint" style="color:red;">Words have been loaded. Use filter box above to find words.</span>
</form>
<div id="output">

</div>
            </div>
        </div>
    </div>   
<?php require_once("footer.php"); ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
    window.onload = function() {
    var eng_words;
    var len;

    function filter()
    {
        $("#searchhint").show();
        search_term = $("#search").val();
        $("#output").html("");

        if(search_term.length == 0) {
            // display everything
            // for(ctr = 0; ctr < len; ctr++) {
            //     currhtml = $("#output").html();
            //     newhtml = '<span class="eng_word'+eng_words[ctr]['verified']+'"><a href="editword.php?wordid=' + eng_words[ctr]['wordid'] + '">' + eng_words[ctr]['wordname'] + '</a></span>';
            //     $("#output").html(currhtml + newhtml);
            // }
        } else {
            // display only matching term
            for(ctr = 0; ctr < len; ctr++) {
                w = eng_words[ctr]['wordname'];
                if(w.indexOf(search_term) != -1) {
                    currhtml = $("#output").html();
                    newhtml = '<span class="eng_word'+eng_words[ctr]['verified']+'"><a href="editword.php?wordid=' + eng_words[ctr]['wordid'] + '">' + w + '</a></span>';
                    $("#output").html(currhtml + newhtml);
                }
            }
        }
        // $("#searchhint").hide();
    }

    $(document).ready(function() {
        eng_words = JSON.parse($("#eng_json").val());
        len = eng_words.length;
        //filter();
    });

    $("#search").keyup(function () {
        filter();
    });

};
    </script>
</body>
</html>
