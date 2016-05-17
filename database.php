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

// Delete task from DB
function deleteTask($id){
    $con = connection();

    $result = $con->query("DELETE FROM tasks WHERE id = $id");
    if(isset($result)){
        $status = "Successfully deleted task.";
    }
    header("Location: Calendar.html");
    return $status;
}

// Update task in DB
function updateTask($id, $day, $hour, $priority, $name, $userId){
    $con = connection();

    $sql = "UPDATE tasks SET day='$day', hour='$hour', priority='$priority', name='$name', user_id='$userId' WHERE id=$id";
    $con->query($sql);

    echo json_encode(array(
        'task_id'=>$id,
        'day_select'=>$day,
        'hour_select'=>$hour,
        'info_select'=>$priority,
        'text_description'=>$name,
        'user_id'=>$userId
    ));
    header("Location: Calendar.html");
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
//        var_dump($data);
    }
    return $data;
}

// Get all users
function getUsers(){
    $con = connection();

    $result = $con->query("SELECT * FROM users ORDER BY first_name");
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $roleId = $row['role_id'];

        $img = '';
        if ($roleId == 1) $img = '<img src="img/star.png" alt="Admin Icon" id="admin-icon">';

        echo '<div class="user" name="user-id" id="user_'.$id.'" data-toggle="modal" data-target="#myModal" data-data=\''.json_encode($row).'\'>';
        echo "<h1 class='name-of-user'>$firstName $lastName $img</h1>";
        echo '</div>';
    }
}

// Get user by id
function getUserById($id){
    $con = connection();
    $data = [];

    $result = $con->query("SELECT * FROM users WHERE id = $id");
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[$id] = $row['id'];
        $data['firstName'] = $row['first_name'];
        $data['lastName'] = $row['last_name'];
        $data['password'] = $row['password'];
    }
    return $data;
}

// Delete user
function deleteUser($id){
    $con = connection();

    $result = $con->query("DELETE FROM tasks WHERE user_id = $id");
    $result = $con->query("DELETE FROM users WHERE id = $id");
}

// Update user on admin.html
function updateUser($id, $firstName, $lastName, $username, $password, $roleId){
    $con = connection();

    $result = $con->query("UPDATE users SET first_name='$firstName', last_name='$lastName', username='$username', password='$password', role_id='$roleId' WHERE id=$id");

    echo json_encode(array(
        'id'=>$id,
        'first_name'=>$firstName,
        'last_name'=>$lastName,
        'username'=>$username,
        'password'=>$password,
        'role_id'=>$roleId,
    ));
}

// Update user on calendar
function updateUserInfo($id, $firstName, $lastName, $password){
    $con = connection();

    $result = $con->query("UPDATE users SET first_name='$firstName', last_name='$lastName', password='$password'  WHERE id=$id");
    $_SESSION['first_name'] = $firstName;
    $_SESSION['last_name'] = $lastName;
}