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
function register($username, $password){
    $con = connection();

    $result = $con->query("INSERT INTO users (`username`, `password`, `role_id` ) VALUES ('".$username."', '".$password."', '2')");

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

// Get all users
function getUsers(){
    $con = connection();
    $data=[];

    $result = $con->query("SELECT * FROM users");
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $username = $row['username'];
        $password = $row['password'];
        $roleId = $row['role_id'];

        echo '<div id="user">';
        echo '<h1 class="sign-up-title">THIS USER HAS ID: '.$id.'</h1>';
//        echo '<label>ID:</label>';
//        echo "<input type=\"text\" class=\"form-text form-control\" id=\"form-text\" name=\"username\" value=\"$id\" disabled>";
        echo '<label>Username:</label>';
        echo "<input type=\"text\" class=\"form-text form-control\" id=\"form-text\" name=\"username\" value=\"$username\">";
        echo '<label>Password:</label>';
        echo "<input type=\"text\" class=\"form-text form-control\" id=\"form-text\" name=\"username\" value=\"$password\">";
        echo '<label>Role ID:</label>';
        echo '<select class="form-control" name="hour_select">
                  <option value="1" '.($roleId==1?'selected':'').'>Admin</option>
                  <option value="2" '.($roleId==2?'selected':'').'>User</option>
              </select>';
        echo '</div>';
    }
}
