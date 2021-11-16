<?php
require_once __DIR__."/../classes/database_class.php";
session_start();

$login_username=$_GET['login_username'];
$login_pasword=$_GET['login_pasword'];


$database_connection = new database();
$validation_msg = $database_connection->validateUser($login_username,$login_pasword);
if($validation_msg === true){
    //go to dashboard
    $_SESSION['username'] = $login_username;
    header("Location: ../homepage.php");
}
else{
    header("Location: ../index.php?msg=$validation_msg");
}