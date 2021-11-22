<?php
require_once __DIR__."/../classes/database_class.php";

$username=$_POST['username'];
$email=$_POST['email'];
$cardnum=$_POST['cardnum'];
$exp_month=$_POST['exp_month'];
$exp_year=$_POST['exp_year'];
$cvv=$_POST['cvv'];
$state = 'Active';
$subs_date = date("Y-m-d");

$database_connection = new database();

$user_id = $database_connection->getUserID($username);


$database_connection->addSubs(
    $user_id,$state,$subs_date
);

$database_connection->addCard(
    $user_id, $cardnum, $exp_month, $exp_year
);
header("Location: ../homepage.php?msg= Subscription success");
    