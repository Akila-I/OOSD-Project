<?php
require_once __DIR__."/../classes/database_class.php";

$register_fname=$_GET['register_fname'];
$register_lname=$_GET['register_lname'];
$register_username=$_GET['register_username'];
$register_email=$_GET['register_email'];
$register_pasword=$_GET['register_pasword'];
$register_pasword_confirm=$_GET['register_pasword_confirm'];
$register_role=$_GET['register_role'];


$database_connection = new database();
$validation_msg = $database_connection->usernameAvailability($register_username);

if($register_role === null){
    $validation_msg = "Please select a role for you.";
    header("Location: ../register.php?msg=$validation_msg");
}
elseif($validation_msg !== true){
    header("Location: ../register.php?msg=$validation_msg");
}
elseif($register_pasword !== $register_pasword_confirm){
    $validation_msg = "Passwords Do not Match";
    header("Location: ../register.php?msg=$validation_msg");
}
else{
    $database_connection->addUser(
        $register_fname,$register_lname,$register_username,
        $register_email,$register_pasword,$register_role
    );
    header("Location: ../index.php?msg='registration success'");
}