<?php
include "database.php";

if(isset($_POST['taskId']) && (isset($_POST['day_select'])) && (isset($_POST['hour_select'])) && (isset($_POST['info_select'])) && (isset($_POST['text_description'])) && (isset($_POST['userId'])))
{
    updateTask($_POST['taskId'],$_POST['day_select'],$_POST['hour_select'],$_POST['info_select'],$_POST['text_description'],$_POST['userId']);
}