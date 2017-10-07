<!DOCTYPE html>
<html><head>
<?php require_once("include.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ISL : Avatar Page</title>

<meta http-equiv="Access-Control-Allow-Origin" content="*">
<meta http-equiv="Access-Control-Allow-Methods" content="GET">

<link rel="stylesheet" href="css/cwasa.css">
<script type="text/javascript" src="avatar_files/allcsa.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
/*
  Global variable to tell if avatar is loaded or not
*/
var TUavatarLoaded = false;
var avatarbusy = false;

</script>
</head>
<body onload="CWASA.init();">

<?php
  include_once("nav.php");
?>
<div class="container" id="loading">
  <div class="row">
    <div class="col-md-12 text-center">
      <span style="background-color:#ebf8a4; padding: 8px 20px;">
      <i class="fa fa-spinner fa-spin"></i> Loading application. Please wait...</span>
    </div>
  </div>
</div>

<div class="container" id="avatar_wrapper" style="display:none;">
  <div class="row">
    <div class="col-md-6">
        <h1 id="hellomsg" style="font-weight:bold;">Hello ! I am your ISL avatar.</h1>
          <div id="leftSide" style="display:none;">
            <label>Enter English text here</label>
            <textarea id="engtext" class="form-control"></textarea><br>
            <button type="button" id="playeng" class="btn btn-primary">Play</button>
            <br><br>
            <label>Debugger:</label>
            <div id="debugger"></div>
          </div>
    </div>

    <div class="col-md-6">
      <div class="CWASAPanel av0" align="center">
        <div class="divAv av0">
          <canvas class="canvasAv av0" ondragstart="return false" width="374" height="403"></canvas>
        </div> 
      </div>
    </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
/*
  Global SigmlData is a 
  javascript object
*/
var SigmlData;
var lookup = {};

$(document).ready(function() {

  var loadingTout = setInterval(function() {
      if(TUavatarLoaded) {
        clearInterval(loadingTout);
        console.log("Avatar loaded successfully !");

        setTimeout(function() {
          /*
            When the avatar has loaded
            the loading message is hidden and main wrapper is shown
          */
          $("#loading").hide();
          $(".divCtrlPanel").hide();
          $("#avatar_wrapper").show();

          /*
            As the avatar is shown a hello test is started
            in order to load all the avatar playing dependencies
          */
          console.log("Starting hello test.");
          $(".bttnPlaySiGMLURL").click();
          console.log("Ending hello test");
      
          /*
            After the hello has been played the main control 
            panel is displayed      
          */
          setTimeout(function() {
            $("#hellomsg").hide();
            $("#leftSide").slideDown();
          }, 9000);
    
        }, 6000);
      }
  }, 1000);

  // keep loading things here
  // load all sigml files into cache

  $.getJSON( "SignFiles/signdump.php", function( data ) {
    SigmlData = data;

    
    for (i = 0, len = SigmlData.length; i < len; i++) {
        lookup[SigmlData[i].w] = SigmlData[i].s;
    }
  });

});  

/*
  Code for the avatar player goes here
*/

/*
  When play english button is clicked
*/
$("#playeng").click(function() {

  console.log("Started parsing");

  input = $("#engtext").val();

  console.log("sending request to get root words");

  $.getJSON( "engstemmer/engstem.php?l=" + input, function(data) {
    console.log("Got root words");
    console.log(data);
    $("#debugger").text(data);

    /*
      Code to play avatar
    */
    i = 0;
    var playtimeout = setInterval(function() {
        if(i >= data.length) {
          clearInterval(playtimeout);
          console.log("Clear play interval");
        }
        if(avatarbusy == false) {
          avatarbusy = true; // this is set to flase in allcsa.js
          console.log("Playing sign :" + data[i]);
          data2play = lookup[data[i]];
          console.log(data2play);
          $(".txtaSiGMLText").val(data2play);
          $(".bttnPlaySiGMLText").click();
          i++;
        } else {
          console.log("Avatar is still busy");
        }
    }, 500);

  });

});

</script>


</body></html>