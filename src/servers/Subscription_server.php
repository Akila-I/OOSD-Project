<?php
require_once __DIR__."/../classes/user_class.php";

session_start();

$username=$_POST['username'];
$email=$_POST['email'];
$cardnum=$_POST['cardnum'];
$exp_month=$_POST['exp_month'];
$exp_year=$_POST['exp_year'];
$cvv=$_POST['cvv'];
$state = 'Active';
$subs_date = date("Y-m-d");

$user = new User($_SESSION['userID']);
$user->subscribe($cardnum,$exp_month,$exp_year);

$_SESSION['sub'] = 'Active';
//$database_connection = database::getInstance();

//$user_id = $database_connection->getUserID($username);

/*

$database_connection->addSubs(
    $user_id,$state,$subs_date
);


$database_connection->addCard(
    $user_id, $cardnum, $exp_month, $exp_year
);
*/
header("Location: ../acc_view.php?msg= Subscription success");
    
