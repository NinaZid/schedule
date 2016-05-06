<?php
include "config.php";

$status="";

// Insert task in DB
function insertTask($day, $hour, $priority, $name, $id){
    $con = connection();

    $result = $con->query("INSERT INTO tasks (`day`, `hour`, `priority`, `name`, `user_id`) VALUES (".$day.",".$hour.",'".$priority."','".$name."', '".$id."')");
    if(isset($result)){
        $status = "Your task has been successfully added.";
    }
    return $status;
}

// Login with username and password executed from DB
function login($username, $password){
    $con = connection();

    $result = $con->query("SELECT * FROM users");

    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        if($username == $row['username'] && $password == $row['password']){
            //login + set session
            $id = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            header("Location: calendar.html"); //redirect

            $status = "";
        }
        else {
            $status = "Wrong username or password.";
        }
    }
    return $status;
}

// Register new user
function register($username, $password){
    $con = connection();

    $result = $con->query("INSERT INTO users (`username`, `password`, `role`) VALUES ('".$username."', '".$password."', '2')");

    $status = "User successfully created!";
    return $status;
}

if(isset($_POST['add_task'])){
    $day = $_POST['day_select'];
    $hour = $_POST['hour_select'];
    $priority = $_POST['info_select'];
    $name = $_POST['text_description'];
    $id = $_SESSION['id'];

    $status = insertTask($day, $hour, $priority, $name, $id);
}

// Get all tasks by session id
function getTasksById($id){
    $con = connection();
    $data=[];

    if ($result = $con->query("SELECT * FROM tasks WHERE user_id = '.$id.'")) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[$row['day'].'_'.$row['hour']]=$row;
        }
    }
    return $data;
}
