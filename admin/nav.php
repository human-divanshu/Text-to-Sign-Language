<?php
    $pageName = pageName();
?>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="navbar-brand" href="#" style="padding:0;padding-left:10px; padding-right:30px;">
<h1 style="margin:0; padding-top:15px;">Admin Panel</h1>
</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
          <ul class="nav navbar-nav navbar-right">
 <li <?php if($pageName=="index.php") echo 'class="active"';?>><a href="index.php">Home <span class="glyphicon glyphicon-home"></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

