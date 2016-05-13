<?php
session_start();
include "database.php";

if((isset($_POST['first_Name'])) && (isset($_POST['last_Name']))  && (isset($_POST['password'])))
{
    updateUserInfo($_SESSION['id'],$_POST['first_Name'],$_POST['last_Name'],$_POST['password']);
}