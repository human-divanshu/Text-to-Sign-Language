<?php
    // login script
    $errors = array();
    
    if(isset($_POST['login'])) {
        $emailId = $_POST['emailid'];
        $password = $_POST['password'];
        
        if(!empty($emailId) && !empty($password)) {
            if(!userExists($emailId)) {          
                $errors[] = "Email ID not registered.";
            } else {
                $userId = login($emailId, $password);
                if($userId === false) {
                    $errors[] = "EmailId and password combintation wrong.";
                } else {
                    // login here
                    $_SESSION['userId'] = $userId;
                    header('Location: index.php');
                }
            }
        }    
    }
?>
<h2>Login here</h2><hr>
<form action="" method="post">
    <label>Username</label>
    <input type="text" name="emailid" id="emailid" autofocus autocomplete="off"/>
    <label>Password</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login" name="login" class="btn btn-primary">                   
</form>
<div id="errorDisplay">
<?php
       if(!empty($errors)) {
            foreach($errors as $e) {
                echo "<p class='alert alert-warning'>$e</p>";
            }
       }
?>
</div>
