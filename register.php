<?php
include "database.php";

session_start();

$con = connection();

// Register button
if(isset($_POST['register-btn'])){
    if(!($_POST['password'] === $_POST['passwordRe'])){
        $status = "Password doesn't match.";
    }
    elseif(($result = $con->query("SELECT * FROM users WHERE  username = '" .$_POST['username']. "'"))) {
        if($result-> rowCount() > 0) {
            $status = "This username already exists.";
        }
        else
        {
            $status = register($_POST['first-name'], $_POST['last-name'], $_POST['username'], $_POST['password']);
        }
    }
}

// Print the status
if(isset($status)):
    return $status;
endif;