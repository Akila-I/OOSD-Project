<?php
//include __DIR__."/../classes/database_class.php";
require_once __DIR__."/../classes/subscription_class.php";

session_start();

$login_username=$_POST['login_username'];
$login_pasword=$_POST['login_pasword'];


$database_connection = database::getInstance();
$validation_msg = $database_connection->validateUser($login_username,$login_pasword);
if($validation_msg === true){
    $_SESSION['username'] = $login_username;
    $_SESSION['userID'] = $database_connection->getUserID($login_username);
    $_SESSION['role'] = $database_connection->getUserRole($login_username);
    //check for subscription
    $expired = $database_connection->checkSubs($_SESSION['userID']);    //true if expired
    if($expired){
        $_SESSION['sub'] = "Inactive";
        Subscription::notifyUser($_SESSION['userID']);
    }
    else{
        $status = $database_connection->getSubscriptionState($_SESSION['userID']);
        if ($status != 'Active') {
            $_SESSION['sub'] = "Inactive";
        }
        else{
            $_SESSION['sub'] = "Active";
        }

        header("Location: ../homepage.php");
    }
}
else{
    
    header("Location: ../index.php?msg=$validation_msg");
}