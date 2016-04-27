<?php
include "config.php";

$status="";

// Read tasks from DB
function readTasks(){
    $con = connection();
    $data=[];

    if ($result = $con->query("SELECT * FROM tasks")) {
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[$row['day'].'_'.$row['hour']]=$row;
        }
    }
    return $data;
}

// Insert task in DB
function insertTask($day, $hour, $priority, $name){
    $con = connection();

    $result = $con->query("INSERT INTO tasks (`day`, `hour`, `priority`, `name`) VALUES (".$day.",".$hour.",'".$priority."','".$name."' )");
}

// Login with username and password executed from DB
function login($username, $password){
    $con = connection();

    $result = $con->query("SELECT * FROM users");

    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        if($username == $row['username'] && $password == $row['password']){
            //correct
            //login + set session
            $_SESSION['username'] = $username;

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

    $result = $con->query("INSERT INTO users (`username`, `password`, `role`) VALUES ('".$username."', '".$password."', '1')");

    $status = "User successfully created!";
    return $status;
}

if(isset($_POST['add_task'])){
    $day = $_POST['day_select'];
    $hour = $_POST['hour_select'];
    $priority = $_POST['info_select'];
    $name = $_POST['text_description'];

    insertTask($day, $hour, $priority, $name);
}