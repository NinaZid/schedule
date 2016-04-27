<?php
include "database.php";

session_start();

// Register button
if(isset($_POST['register-btn'])){
    if(!($_POST['password'] === $_POST['passwordRe'])){
        $status = "Password doesn't match.";
    }else{
        $status = register($_POST['username'], $_POST['password']);
    }
}

// Print the status
if(isset($status)):
    return $status;
endif;