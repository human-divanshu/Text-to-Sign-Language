<?php
require_once("database.php");

// functions dealing with user processes such as login and logout

function loggedIn() {
    return (isset($_SESSION['userId'])) ? true : false;
}


function userExists($emailId) {
    $db = connect();
    $stmt = $db->prepare("select count(*) as count from users where emailid = ?");
    $stmt->execute(array($emailId));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $db = null;
    return ($result['count'] != 0) ? true : false;
}

function login($emailId, $password) {
    $db = connect();
    $stmt = $db->prepare("select * from users where emailid = ?");
    $stmt->execute(array($emailId));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $db = null;
    if($result['password'] == $password) {
        return $result['userid'];
    } else {
        return false;
    }
}
?>
