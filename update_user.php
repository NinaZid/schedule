<?php
include "database.php";

if(isset($_POST['id']) && (isset($_POST['first_Name'])) && (isset($_POST['last_Name'])) && (isset($_POST['username'])) && (isset($_POST['password'])) && (isset($_POST['role_id'])))
{
    updateUser($_POST['id'],$_POST['first_Name'],$_POST['last_Name'],$_POST['username'],$_POST['password'],$_POST['role_id']);
}