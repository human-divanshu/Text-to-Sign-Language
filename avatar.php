<!DOCTYPE html>
<html manifest="manifest.appcache">
    <head>
    	<?php require_once("include.php"); ?>
        <title>ISL : Avatar Page</title>
        <meta http-equiv="Access-Control-Allow-Origin" content="*">
        <meta http-equiv="Access-Control-Allow-Methods" content="GET">
        <link rel="stylesheet" href="css/cwasa.css" />

        <script type="text/javascript">
        
        // GLOBAL variable for session cache
        // This is test feature

        // will hold gloss value
        // animation response will be cached using current gloss value
        var currentGlossValue;
        // var AvatarCache = {};

        </script>
        <script type="text/javascript" src="js/allcsa.js"></script>
        <script language="javascript">
			
        // Initial configuration for the avatar to be loaded
  			var initCfg = {
  				"avsbsl" : ["luna", "siggi", "anna", "marc", "francoise"],
  				"avSettings" : { "avList": "avsbsl", "initAv": "marc" }
  				};
  				
  			// global variable to store the sigmal file list
        // this list is searched for presence of some sigml file during parsing
  			var sigmlList = null;

        // global variable to tell if avatar is ready or not
        var tuavatarLoaded = false;
  		  </script>

<!-- Next script is used for English to hindi conversion on the fly; starts here -->
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
<!-- script for english to hindi conversion on fly end here -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
 
    <body onload="CWASA.init(initCfg);" >
    
    <?php
      // navigation for the website
    	include_once("nav.php");
    ?>      
    
    <!-- message to be shown when the avatar is loading in the browser -->

    <div id="loading" class="container"><div class="row text-center"><span style="background-color:#ebf8a4; padding: 8px 20px;">
      <i class="fa fa-spinner fa-spin"></i> Loading application. Please wait...</div></div></div>
    
    <!-- left side division starts here -->
		<div style="width:40%; padding:15px; float:left; margin-left:14%; display:none;" id="leftPanel">

      <ul class="nav nav-tabs nav-justified" id="navi">
        <li role="presentation"><a href="#" id="menu1-h" onclick="activateTab('menu1-h', 'menu1');">English to Sign Language</a></li>
        <li role="presentation"><a href="#" id="menu2-h" onclick="activateTab('menu2-h', 'menu2');">Hindi to Sign Language</a></li>
        <!--<li role="presentation"><a href="#" id="menu3-h" onclick="activateTab('menu3-h', 'menu3');">Alphabets</a></li>
        <li role="presentation"><a href="#" id="menu4-h" onclick="activateTab('menu4-h', 'menu4');">Numbers</a></li>-->
      </ul>

      <div id="menu1">
      <br>
      <label for="inputText">Enter the text to convert to sign language:</label><br>
      <textarea id="inputText" style="width:100%; height:80px;" autofocus></textarea><br><br>
      <button type="button" id="btnRun" class="btn btn-primary">Parse and Generate Play Sequence</button>
      <button type="button" id="btnClear" class="btn btn-default">Clear</button>
      </div>

      <div id="menu2">
      <br>
      <label for="transliterateTextarea">Type text to convert to hindi:</label><br>
      <textarea id="transliterateTextarea" name="transliterateTextarea" style="width:100%; height:80px;"></textarea><br><br>
      <button type="button" id="btnClearHindi" class="btn btn-default">Clear</button>
      </div>

      <!--<div id="menu3">
      <br>
      Alphabets will be displayed here
      </div>

      <div id="menu4">
      <br>
      Number will be displayed here
      </div>-->

      <div id="debuggercontainer" style="margin-top:10px; border-top:3px solid black;">
      	<br><strong>Debugger</strong></br>
      	<div id="debugger"></div>
      </div>
		</div>
    <!-- left side division ends here -->

    <!-- right side divison start here; contains the avatar -->
    <script language="javascript" src="js/animationPlayer.js"></script>		
		<?php 
			// This is the main player where the animation happens	
			include_once("animationPlayer.php"); 
		?>
    <!-- right side divison ends here -->

<!-- player.js contains code that is used to control the avatar -->
<script type="text/javascript" src="js/player.js"></script>

<script type="text/javascript">

/*
	Load sigmlFiles.json file which contains list of all the available
  sigml files that can be played
*/
sigmlFileListURL = "js/sigmlFiles.json?version=" + Date.now();
$.getJSON(sigmlFileListURL, function(json){
    sigmlList = json;
});

// clear button for english input 
$("#btnClear").click(function() {
	$("#inputText").val("");
});

// clear button for hindi input
$("#btnClearHindi").click(function() {
  $("#transliterateTextarea").val("");
});

// code to check if avatar has been loaded or not
// and hide the loading sign and show the leftPanel 
// for input for text
var loadingTout = setInterval(function() {
    if(tuavatarLoaded) {
        $("#loading").hide();
        $("#leftPanel").show();
        clearInterval(loadingTout);
        console.log("Avatar loaded successfully !");
    }
}, 1000);


// code to animate tabs
// to swich between english and hindi input
alltabhead = ["menu1-h", "menu2-h", "menu3-h", "menu4-h"];
alltabbody = ["menu1", "menu2", "menu3", "menu4"];

function activateTab(tabheadid, tabbodyid)
{
    for(x = 0; x < alltabhead.length; x++)
        $("#"+alltabhead[x]).css("background-color", "white");
    $("#"+tabheadid).css("background-color", "#d5d5d5");
    for(x = 0; x < alltabbody.length; x++)
        $("#"+alltabbody[x]).hide();
    $("#"+tabbodyid).show();
}

activateTab("menu1-h", "menu1"); // activate first menu by default

</script>
<?php include_once("footer.php"); ?>
<?php 
/*
  Test mode
  When the test mode will be active then 

  add code to write the gloss from GET paramter to box and 
  press run button
*/
echo "abc";
if(isset($_GET['mode']) && isset($_GET['gloss'])) {
  
  echo "<input type='hidden' name='wordToPlay' value='".$_GET['gloss']."' id='wordToPlay'>";
?>

<script type="text/javascript">
$(document).ready(function(){
  wordToPlay = $("#wordToPlay").val();
  $("#inputText").val(wordToPlay);
});
</script>  

<?php
} // if block ends here for test mode
?>
</body>
</html>