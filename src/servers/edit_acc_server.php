<?php
require_once __DIR__."/../classes/database_class.php";

$edit_uid=$_GET['edit_u_id'];
$edit_fname=$_GET['edit_fname'];
$edit_lname=$_GET['edit_lname'];
$edit_username=$_GET['edit_username'];
$edit_email=$_GET['edit_email'];
$edit_pasword=$_GET['edit_pasword'];
$edit_pasword_confirm=$_GET['edit_pasword_confirm'];

$database_connection = new database();
$validation_msg = $database_connection->usernameAvailability($edit_username);

if($validation_msg !== true){
    header("Location: ../register.php?msg=$validation_msg");
}
elseif($edit_pasword !== $edit_pasword_confirm){
    $validation_msg = "Passwords Do not Match";
    header("Location: ../acc_edit.php?msg=$validation_msg");
}
else{
    /*$database_connection->addUser(
        $register_fname,$register_lname,$register_username,
        $register_email,$register_pasword,$register_role
    );*/
    $database_connection->updateUser($edit_uid,$edit_fname,$edit_lname,$edit_username,$edit_email,$edit_pasword);
    header("Location: ../acc_view.php?msg='Successfully updated'");
}