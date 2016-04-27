<?php

//if it`s not logged in - calendar is not available
if(!isset($_SESSION['username']))
     header('Location: index.html'); //redirect

//if(!isset($_SESSION['tasks'])){
////makes array tasks(empty)
//     $_SESSION['tasks']=[];
//}

//logged in
// if($_POST){
//     //put new elements in tasks
//    $_SESSION['tasks'][$_POST['day_select'].'_'.$_POST['hour_select']]=$_POST;
// }

//print_r($_SESSION['tasks']);
//exit;