<?php
require_once __DIR__."/../classes/database_class.php";

$username=$_POST['username'];
$email=$_POST['email'];
$cardnum=$_POST['cardnum'];
$exp=$_POST['exp'];
$cvv=$_POST['cvv'];
$state = 'True';
$subs_date = date("Y-m-d");

$database_connection = new database();

$user_id = $database_connection->getUserID($username);
if($user_id === null){
    $msg =  "Username is incorrect. Please enter again.";
    header("Location: ../Subscription.php?msg=$msg");
}
  
else{
    $database_connection->addSubs(
        $user_id,$state,$subs_date
    );

    $database_connection->addCard(
        $user_id, $cardnum, $exp
    );
    header("Location: ../homepage.php?msg= Subscription success");
}
