<?php
session_start();
include "database.php";

if(isset($_POST['task_id'])) {
    deleteTask($_POST['task_id']);
}