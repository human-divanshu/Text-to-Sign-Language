<?php

// connect to database now this can used anywhere

function connect() {
    $db = new PDO('mysql:host=localhost;dbname=text2sign;charset=utf8', 'root', 'root');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}
?>
