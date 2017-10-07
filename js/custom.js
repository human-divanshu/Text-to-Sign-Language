<script>
/*
  Global SigmlData is a 
  javascript object
*/
var SigmlData;

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

          $('.type-it').typeIt({
            strings: ['Hello ! I am your ISL avatar.']
          });
        
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
          }, 8000);
    
        }, 5000);
      }
  }, 1000);

  // keep loading things here
  // load all sigml files into cache

  $.getJSON( "SignFiles/signdump.php", function( data ) {
    SigmlData = data;
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

  $.getJSON( "engstemmer/engstem.php?l=" + input, function( data ) {
    console.log("Got root words");
    console.log(data);
    $("#debugger").text(data);
  });
  
});

</script>