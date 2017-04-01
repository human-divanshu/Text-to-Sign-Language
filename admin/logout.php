<?php
// logout script
session_start();
session_destroy();
header('Location: index.php');
?>
