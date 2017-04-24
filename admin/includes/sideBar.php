<?php
    $pageName = pageName();
?>

<h2>Menu</h2><hr>
<ul id="sideBar">
    <li <?php if($pageName=="index.php") echo 'class="active"';?>><a href="index.php">Home</a></li>
    <li <?php if($pageName=="filters.php") echo 'class="active"';?>><a href="filters.php">Filters</a></li>
    <li <?php if($pageName=="stats.php") echo 'class="active"';?>><a href="stats.php">Database Stats</a></li>  
    <li <?php if($pageName=="dbmanager.php") echo 'class="active"';?>><a href="dbmanager.php">Word Manager</a></li>    
    <li <?php if($pageName=="ham-creator.php") echo 'class="active"';?>><a href="ham-creator.php">HamNoSys Writing Tool</a></li>
    <li <?php if($pageName=="h2s.php") echo 'class="active"';?>><a href="h2s.php">HamNoSys 2 Signml Tool</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
