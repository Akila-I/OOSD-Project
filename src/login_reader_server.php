<?php
session_start();
require_once "user_class.php";

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

    header("Location: login_test.php?unamemsg=$unamemsg&pwmsg=$pwmsg");
}

else if($login_username!=null && $login_pasword!=null){
    $reader = new user($login_username,$login_pasword);
    $validation_msg = $reader->validate();
    if($validation_msg === true){
        //go to dashboard
        $_SESSION['reader'] = $reader->getUserID();
        header("Location: login_test.php?msg='login success'");
    }
    else{
        header("Location: login_test.php?msg=$validation_msg");
    }
}