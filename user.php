<?php
include "database.php";

if(!getUserById($_GET['user'])){
    header("Location: admin.html");
}

// Call the function for inserting task
if(isset($_POST['add_task'])){
    $day = $_POST['day_select'];
    $hour = $_POST['hour_select'];
    $priority = $_POST['info_select'];
    $name = $_POST['text_description'];
    $id = $_GET['user'];
    
    $status = insertTask($day, $hour, $priority, $name, $id);
}