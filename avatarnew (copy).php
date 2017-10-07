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


<!-- CWA signing avatar panel 0 -->
<!--================================================================-->
<div class="CWASAPanel av0" align="center"><table class="avTable av0"><tbody><tr>
<td align="center" style="display:none;">
  <div class="divCtrlPanel">
  <!--========================================================-->
<<span class="spanPlayA av0">
Avatar:
<select class="menuAv av0">
<option value="anna">anna</option>
<option value="beatrice">beatrice</option>
<option value="candy">candy</option>
<option value="darshan">darshan</option>
<option value="francoise">francoise</option>
<option value="genie">genie</option>
<option value="luna">luna</option>
<option value="marc" selected="selected">marc</option>
<option value="max">max</option>
<option value="monkey">monkey</option>
<option value="otis">otis</option>
<option value="robotboy">robotboy</option>
<option value="siggi">siggi</option>
</select>
</span><!--class="spanPlayA av0"-->
<br>
<!--========================================================-->
<span class="spanSpeed av0">
Speed (log<sub>2</sub> scale):
<input class="txtLogSpeed av0" value="+0.0" type="text">
<input value="-" class="bttnSpeedDown av0" type="button">
<input value="+" class="bttnSpeedUp av0" type="button">
<input value="Reset" class="bttnSpeedReset av0" disabled="disabled" type="button">
</span>  <!--class="spanSpeed av0"-->
<br>
<hr style="height:1px;">
<span align="center" class="divSiGML av0">
SiGML URL:<br>
<input class="txtSiGMLURL av0" value="scotland-H.sigml" type="text"><br>

SiGML Text:<br>
<textarea class="txtaSiGMLText av0" rows="4">

&lt;sigml&gt;

  &lt;hns_sign gloss="hello"&gt;
    &lt;hamnosys_nonmanual&gt;
      &lt;hnm_mouthpicture picture="hVlU"/&gt;
    &lt;/hamnosys_nonmanual&gt;
    &lt;hamnosys_manual&gt;
      &lt;hamflathand/&gt;
      &lt;hamthumboutmod/&gt;
      &lt;hambetween/&gt;
      &lt;hamfinger2345/&gt;
      &lt;hamextfingeru/&gt;
      &lt;hampalmd/&gt;
      &lt;hamshouldertop/&gt;
      &lt;hamlrat/&gt;
      &lt;hamarmextended/&gt;
      &lt;hamswinging/&gt;
      &lt;hamrepeatfromstart/&gt;
    &lt;/hamnosys_manual&gt;
  &lt;/hns_sign&gt;

&lt;/sigml&gt;


</textarea>
</span>  <!--class="divSiGML av0"-->
<br>
<!--========================================================-->
<span class="spanSiGMLCtrlA av0">
<!--input type="button" value="Play CAS" class="bttnPlayCAS av0" /-->
<input value="Play SiGML URL" class="bttnPlaySiGMLURL av0" type="button">
<input value="Play SiGML Text" class="bttnPlaySiGMLText av0" type="button">
&nbsp;
<input value="Stop" class="bttnStop av0" disabled="disabled" type="button">
</span>  <!--class="spanSiGMLCtrlA av0"-->
<br>
<span align="center" class="spanSiGMLCtrlB av0">
<input value="Suspend" class="bttnSuspend av0" disabled="disabled" type="button">
<input value="Resume" class="bttnResume av0" disabled="disabled" type="button">
&nbsp;
Frames:
<input value="-1" class="bttnPrevF av0" disabled="disabled" type="button">
<input value="+1" class="bttnNextF av0" disabled="disabled" type="button">
</span>  <!--class="spanSiGMLCtrlB av0"-->
<br>
<!--========================================================-->
<hr style="height:1px;">
<!--========================================================-->
<span class="spanInfo av0">
Sign/Frame:
<input class="txtSF av0" value="2/110" type="text">
&nbsp;
Gloss:
<input class="txtGloss av0" value="i" type="text">
&nbsp;
FPS:
<input class="txtFPS av0" value="40.37" type="text">
</span>  <!--class="spanInfo av0"-->
<br>
<!--========================================================-->
<span class="spanInfo av0">
Status:
<input class="statusExtra av0" value="Client: Playing complete" type="text">
</span>  <!--class="spanInfo av0"-->
</div>
</td>
<td width="8"></td>
<td height="320" width="384">
  <div class="divAv av0">
  <canvas class="canvasAv av0" ondragstart="return false" width="374" height="403"></canvas>
</div>  <!--class="divAv av0"-->
</td>
</tr></tbody></table></div>
<!--================================================================-->
<hr>

<!-- CWA signing avatar panel 1 -->
<!--================================================================-->
<!--div class="CWASAPanel av1" align="center" ></div-->
<!--================================================================-->
<!--hr-->


<!-- Hidden SToCA applet element panel -->
<!--================================================================-->
<div class="SToCA" align="center"></div>
<!--================================================================-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
<script type="text/javascript">
$(document).ready(function() {
  startPlayer("SignFiles/boy.sigml");
});  

</script>


</body></html>