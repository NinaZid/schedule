<?php
session_start();
include "database.php";

if(isset($_POST['task_id']) && (isset($_POST['day'])) && (isset($_POST['hour'])) && (isset($_POST['priority'])) && (isset($_POST['name'])) && (isset($_POST['user_id'])))
{
    updateTask($_POST['task_id'], $_POST['day'], $_POST['hour'], $_POST['priority'], $_POST['name'], $_POST['user_id']);
}