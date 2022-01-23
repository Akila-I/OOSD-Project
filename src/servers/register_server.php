<?php
require_once __DIR__."/../classes/database_class.php";

$register_fname=$_POST['register_fname'];
$register_lname=$_POST['register_lname'];
$register_username=$_POST['register_username'];
$register_email=$_POST['register_email'];
$register_pasword=$_POST['register_pasword'];
$register_pasword_confirm=$_POST['register_pasword_confirm'];
$register_role=$_POST['register_role'];


$database_connection = database::getInstance();
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
    $register_pasword = password_hash($register_pasword,PASSWORD_DEFAULT);
    $database_connection->addUser(
        $register_fname,$register_lname,$register_username,
        $register_email,$register_pasword,$register_role
    );
    header("Location: ../index.php?msg='registration success'");
}