<?php
//just checking
include "database.php";

session_start();

// Login button
if(isset($_POST['login-btn'])){
    if($_POST['username'] == "" || $_POST['password'] == ""){
        $status = "Please fill all the fields.";
    }else{
        $status = login($_POST['username'], $_POST['password']);
    }
}

// Register button
if(isset($_POST['register-btn'])){
    header("Location: register.html");
}

// Print the status
if(isset($status)):
    echo $status;
endif;