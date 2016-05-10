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
            $id = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            $_SESSION['role_id'] = $row['role_id'];
            if ($row['role_id'] == 1){
                header("Location: admin.html");
            }else{
                header("Location: calendar.html");
            }
            $status = "";
        }
        else {
            $status = "Wrong username or password.";
        }
    }
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

// Register new user
function register($firstName, $lastName, $username, $password){
    $con = connection();

    $result = $con->query("INSERT INTO users (`first_name`, `last_name`,`username`, `password`, `role_id` ) VALUES ('".$firstName."','".$lastName."','".$username."', '".$password."', '2')");

    $status = "User successfully created!";
    return $status;
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

// Get all users
function getUsers(){
    $con = connection();

    $result = $con->query("SELECT * FROM users");
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $username = $row['username'];
        $password = $row['password'];
        $roleId = $row['role_id'];

        echo '<div class="user" name="user-id" id="'.$id.'" data-toggle="modal" data-target="#myModal">';
        echo "<h1 class='name-of-user'>$firstName $lastName</h1>";
        echo '</div>';
    }
}

// Delete user
function deleteUser($id){
    $con = connection();

    $result = $con->query("DELETE FROM users WHERE id = $id");
}

// Update user
function updateUser($id, $firstName, $lastName, $username, $password, $roleId){
    $con = connection();

    $result = $con->query("UPDATE users SET first_name=$firstName, last_name=$lastName, username=$username, password=$password, role_id=$roleId WHERE id=$id");
}