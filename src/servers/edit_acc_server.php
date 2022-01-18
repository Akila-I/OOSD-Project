<?php
session_start();
require_once __DIR__."/../classes/database_class.php";

$edit_uid=$_SESSION['userID'];
$edit_fname=$_POST['edit_fname'];
$edit_lname=$_POST['edit_lname'];
$edit_username=$_POST['edit_username'];
$edit_email=$_POST['edit_email'];
$edit_pasword=$_POST['edit_pasword'];
$edit_pasword_confirm=$_POST['edit_pasword_confirm'];
$current_username=$_SESSION['username'];

$database_connection = database::getInstance();
if($current_username!==$edit_username){
    $validation_msg = $database_connection->usernameAvailability($edit_username);

    if($validation_msg !== true){
        header("Location: ../acc_edit.php?msg=$validation_msg");
    }
}

if($edit_pasword !== $edit_pasword_confirm){
    $validation_msg = "Passwords Do not Match";
    header("Location: ../acc_edit.php?msg=$validation_msg");
}
else{
   
    $database_connection->updateUser($edit_uid,$edit_fname,$edit_lname,$edit_username,$edit_email,$edit_pasword);
    $_SESSION['username'] = $edit_username;
    header("Location: ../acc_view.php?msg='Successfully updated'");
}