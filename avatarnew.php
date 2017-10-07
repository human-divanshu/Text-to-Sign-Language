<!DOCTYPE html>
<html>
<head>
<?php 
  /*
    This includes the common external CSS, JS files
    and meta HTML tags
  */
  require_once("include.php"); 
?>
<title>ISL : Avatar Page</title>
<meta http-equiv="Access-Control-Allow-Origin" content="*">
<meta http-equiv="Access-Control-Allow-Methods" content="GET">
<link rel="stylesheet" href="css/cwasa.css">
<script type="text/javascript" src="avatar_files/allcsa.js"></script>

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
<!-- script for english to hindi conversion on fly ENDS here -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
/*
  TUavatarLoaded : Global variable to tell if avatar is loaded or not

  This will be set to TRUE in allcsa.js after the avatar
  would have loaded successfully
*/
var TUavatarLoaded = false;

/*
  avatarbusy : Binary lock variable to be checked before
  giving control to next word to be played  
*/
var avatarbusy = false;

/*
  weblog function to write into the debugger area of the
  avatar
*/
function weblog(line)
{
    weblogid = document.getElementById("debugger");
    weblogid.innerHTML=line+"<br>"+weblogid.innerHTML;
}
</script>
</head>
<body onload="CWASA.init();">
<?php
  /*Page navigation menu*/
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

            <ul class="nav nav-tabs nav-justified" id="navi">
              <li role="presentation"><a href="#" id="menu1-h" onclick="activateTab('menu1-h', 'menu1');">English to ISL</a></li>
              <li role="presentation"><a href="#" id="menu2-h" onclick="activateTab('menu2-h', 'menu2');">Hindi to ISL</a></li>
              <li role="presentation"><a href="#" id="menu3-h" onclick="activateTab('menu3-h', 'menu3');">Examples</a></li>
              <!--<li role="presentation"><a href="#" id="menu4-h" onclick="activateTab('menu4-h', 'menu4');">Numbers</a></li>-->
            </ul>

            <div id="menu1">
            <br>
            <label>Enter English text here</label>
            <textarea id="engtext" class="form-control" style="width:100%; height:80px;"></textarea><br>
            <button type="button" id="playeng" class="btn btn-primary">Play</button>
            <button type="button" id="btnClearEng" class="btn btn-default">Clear</button>

            </div>
            <div id="menu2">
            <br>
            <label for="transliterateTextarea">Type text to convert to hindi:</label><br>
            <textarea class="form-control" id="transliterateTextarea" name="transliterateTextarea" style="width:100%; height:80px;"></textarea><br>
            <textarea id="hinditext" class="form-control" style="width:100%; height:80px; display:none;"></textarea>
            <button type="button" id="playhindi" class="btn btn-primary">Play</button>
            <button type="button" id="btnClearHindi" class="btn btn-default">Clear</button>
            </div>

            <div id="menu3" style="max-height:250px; overflow-y:scroll;">
              <br>
              <label>Example Sentences</label>
<?php
    require_once("show_examples.php");
?>              
            </div>


            <div id="showdebugger" style="position:fixed; left:0px; top:50%; display:none;">
              <button id="btnshowdebugger" alt="Show Debugger" title="Show Debugger" type="button" class="btn btn-danger"><i class="glyphicon glyphicon-cog"></i></button>
            </div>

            <br><br>
            <div id="debugpane">
            <label>Debugger:</label>
            <button type="button" id="clrDebugger" style="float:right;" class="btn btn-sm btn-small">Clear Debugger</button>
            <button type="button" id="hideDebugger" style="float:right;margin-right:10px;" class="btn btn-sm btn-danger">Hide Debugger</button>
            <div style="clear:both;"></div>
            <div id="debugger"></div>
            </div>
          


          </div><!--left side multi menu pane ends here-->

    </div>

    <div class="col-md-6">
      <div class="CWASAPanel av0" align="center">
        <div class="divAv av0">
          <canvas class="canvasAv av0" ondragstart="return false" width="374" height="403"></canvas>
        </div> 
      </div>
      <div id="currentWord" class="alert alert-warning"></div>
    </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/hindiconvert.js"></script>
<script>
/*
  Hide debugger
*/
$("#hideDebugger").click(function() {
    $("#debugpane").hide();
    $("#showdebugger").show();
    $("#menu3").css("max-height","420px");
});

$("#btnshowdebugger").click(function() {
    $("#debugpane").show();
    $("#showdebugger").hide();
    $("#menu3").css("max-height","250px");
});

/*
Monitor hindi text area
*/
$("#hinditext").on('keypress', function(e) {
    var code = e.keyCode || e.which;
    if(code==32){ // space has been pressed
        hinditext = $("#hinditext").val();
        converttohindi(hinditext);        
    }
});

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
        console.log("MSG: Avatar loaded successfully !");

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
          console.log("MSG: Starting hello test.");
          $("#currentWord").text("Hello");
          $(".txtaSiGMLText").val('<sigml><hns_sign gloss="hello"><hamnosys_nonmanual><hnm_mouthpicture picture="hVlU"/></hamnosys_nonmanual><hamnosys_manual><hamflathand/><hamthumboutmod/><hambetween/><hamfinger2345/><hamextfingeru/><hampalmd/><hamshouldertop/><hamlrat/><hamarmextended/><hamswinging/><hamrepeatfromstart/></hamnosys_manual></hns_sign></sigml>');
          $(".bttnPlaySiGMLText").click();
          console.log("MSG: Ending hello test");
      
          /*
            After the hello has been played the main control 
            panel is displayed      
          */
          setTimeout(function() {
            $("#hellomsg").hide();
            $("#leftSide").slideDown();
          }, 10000);
    
        }, 6000);
      }
  }, 2000);

  // keep loading things here
  // load all sigml files into cache

  $.getJSON( "SignFiles/signdump.php", function( data ) {
    SigmlData = data;

    // make the lookup table
    for (i = 0, len = SigmlData.length; i < len; i++) {
        lookup[SigmlData[i].w] = SigmlData[i].s;
    }
  });

});  

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

// clear button code
$("#btnClearEng").click(function(){
    $("#engtext").val("");
});
$("#btnClearHindi").click(function(){
    $("#transliterateTextarea").val("");
});
$("#clrDebugger").click(function(){
    $("#debugger").html("");
});
/*
  Code for the avatar player goes here
*/

/*
  When play english button is clicked
*/
$("#playeng").click(function() {

  console.log("Started parsing");

  input = $("#engtext").val().trim().replace(/\r?\n/g, ' '); // change newline to space while reading

  if(input.length == 0)
    return;

  input = input.toLocaleLowerCase();

  console.log("sending request to get root words");

  $.getJSON( "engstemmer/engstem.php?l=" + input, function(data) {
    console.log("Got root words");
    console.log(data);
    $("#debugger").text("Play sequence " + JSON.stringify(data));

    /*
      Code to play avatar
    */
  
    playseq = Array();
    for(i = 0; i < data.length; i++)
      playseq.push(data[i]);

    // start playing only if length of data received
    // was more than 0

    if(data.length > 0) {
      var playtimeout = setInterval(function() {

          if(playseq.length == 0 || data.length == 0) {
            clearInterval(playtimeout);
            console.log("Clear play interval");
            avatarbusy=false;
            return;
          }

          if(avatarbusy == false) {
            avatarbusy = true; // this is set to flase in allcsa.js      

            word2play = playseq.shift();    
            weblog("Playing sign :" + word2play);
            if(lookup[word2play]==null) {
              weblog("<span style='color:red;'>SiGML not available for word : " + word2play + "</span>");
              avatarbusy=false;
              
              // break word2play into chars and unshift them to playseq
                for(i = word2play.length - 1; i >= 0; i--)
                  playseq.unshift(word2play[i]);
            

            } else {
              data2play = lookup[word2play];
              console.log(data2play);
              $("#currentWord").text(word2play);
              $(".txtaSiGMLText").val(data2play);
              $(".bttnPlaySiGMLText").click();
            }
          } else {
            console.log("Avatar is still busy");

            // check if error occured then reset the avatar to free
            errtext = $(".statusExtra").val();
            if(errtext.indexOf("invalid") != -1) {
              weblog("<span style='color:red;'>Error: " + errtext + "</span>");
              avatarbusy = false;
            }
          }
      }, 500);
    }

  });

});

$("#playhindi").click(function() {
    input = $("#transliterateTextarea").val().trim().replace(/\r?\n/g, ' '); // change newline to space while reading
    processed_input = "";
    for(i = 0; i < input.length; i++) {
      if(input[i].charCodeAt(0).toString(16) == "964" || input[i].charCodeAt(0).toString(16) == "3f" || input[i].charCodeAt(0).toString(16) == "7c")
        processed_input = processed_input + " ";
      else
        processed_input = processed_input + input[i];
    }

    console.log("MSG : Sending request to get hindi root words");

    $.getJSON( "hindiparser/hparse.php?l=" + input, function(data) {
        console.log("Got root words");
        console.log(data);
        $("#debugger").text("Play sequence " + JSON.stringify(data));
    });

});

/*
  function to play example sentences
*/
function playsign(line)
{
  $("#engtext").val(line);
  $("#playeng").click();
}

/*window.onerror = function() {
    alert("Error caught");
};*/
</script>
</body></html>