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
    <title>Add Hindi Word</title>
<script src="https://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load("elements", "1", {
      packages: "transliteration"
    });
    function onLoad(){
      var options = {
        sourceLanguage: google.elements.transliteration.LanguageCode.ENGLISH,
        destinationLanguage: [google.elements.transliteration.LanguageCode.HINDI],
        shortcutKey: 'ctrl+g',
        transliterationEnabled: true
    };
    var control = new google.elements.transliteration.TransliterationControl(options);
    control.makeTransliteratable(['transliterateTextarea']);
    
  }
  google.setOnLoadCallback(onLoad);
  function myread(){
       var text=document.conversion.transliterateTextarea;
        var tcontent=text.value;
      window.alert(tcontent);
      return tcontent;
  }
  
</script>    
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
                <h2>Add Hindi Word</h2><hr>
            <form action="" method="post">
                <input type="hidden" name="parent" value="<?php echo $_GET['parent']; ?>">
                <label>Type word and press space to convert to hindi</label>
                <textarea id="transliterateTextarea" name="transliterateTextarea" style="font-size:20px; width:80%;" autofocus></textarea><br><br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
<?php
// process form, save hindi word
if(isset($_POST['transliterateTextarea']) && isset($_POST['parent'])) {
 
    $db = connect();

    $parent = $_POST['parent'];
    $hword = trim($_POST['transliterateTextarea']);

    if(strlen($hword) > 0) {
      $sql = "insert into hindiwords(wordname, parent) values('".$hword."', ".$parent.")";
      $stmt = $db->prepare($sql);
      $stmt->execute(array());      
      $db = null;
    }

    header("Location: editword.php?wordid=".$parent);
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
