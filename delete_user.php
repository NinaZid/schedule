<?php
include "database.php";

if(isset($_POST['id'])) {
    deleteUser($_POST['id']);
}