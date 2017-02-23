<!DOCTYPE html>
<html>
    <head>
    	<?php require_once("include.php"); ?>
        <title>Avatar Page</title>
        <meta http-equiv="Access-Control-Allow-Origin" content="*">
        <meta http-equiv="Access-Control-Allow-Methods" content="GET">
        <link rel="stylesheet" href="css/cwasa.css" />
        <script type="text/javascript" src="js/allcsa.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script language="javascript">
			// Initial configuration
			var initCfg = {
				"avsbsl" : ["luna", "siggi", "anna", "marc", "francoise"],
				"avSettings" : { "avList": "avsbsl", "initAv": "marc" }
				};
				
			// global variable to store the sigmal list
			var sigmlList = null;
		</script>
    </head>
    <body onload="CWASA.init(initCfg);" >
    <?php
    	// This is the web page header : title, subtile etc
    	include_once("header.php");
    ?>
        <script language="javascript" src="js/animationPlayer.js"></script>
		<div style="width:30%; padding:15px; float:left; margin-left:5%;">
			<h2>Test Animation Interface</h2>
			<label for="inputText">Enter the text to animate</label>
			<textarea id="inputText" style="width:100%; height:80px;" autofocus></textarea>
			<button type="button" id="btnRun">Parse and Generate Play Sequence</button>
			<button type="button" id="btnClear">Clear</button>
			<br><strong>Debugger</strong></br>
			<div id="debugger"></div>
		</div>
		
		<?php 
			// This is the main player where the animation happens	
			include_once("animationPlayer.php"); 
		?>

<script type="text/javascript" src="js/player.js"></script>
<script>
/*
	Load json file for sigml available for easy searching
*/
$.getJSON("js/sigmlFiles.json", function(json){
    sigmlList = json;
});

// code for clear button
$("#btnClear").click(function() {
	$("#inputText").val("");
});
</script>
    </body>
</html>
