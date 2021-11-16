<?php
require_once __DIR__."/../classes/user_class.php";
session_start();

$login_username=$_GET['login_username'];
$login_pasword=$_GET['login_pasword'];

if($login_username==null||$login_pasword==null){
    $unamemsg="";
    $pwmsg="";
    
    if($login_username==null){
        $unamemsg="Username Empty";
    }
    if($login_pasword==null){
        $pwmsg="Password Empty";
    }

    header("Location: ../index.php?unamemsg=$unamemsg&pwmsg=$pwmsg");
}

else if($login_username!=null && $login_pasword!=null){
    $user = new user($login_username,$login_pasword);
    $validation_msg = $user->validate();
    if($validation_msg === true){
        //go to dashboard
        $_SESSION['userID'] = $user->getUserID();
        header("Location: ../index.php?msg='login success'");
    }
    else{
        header("Location: ../index.php?msg=$validation_msg");
    }
}