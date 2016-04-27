<?php

//PDO
function connection(){
    $dsn  = 'mysql:dbname=dbtasks;host=localhost';
    $user = 'root';
    $pass = '';
    try {
        $con = new PDO($dsn, $user, $pass);
//        echo "Successfully connected";
        return $con;
    } catch (PDOException $e){
        echo $e->getMessage();

//        print_r(PDO::getAvailableDrivers());
    }
}