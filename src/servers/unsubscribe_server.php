<?php
require_once __DIR__."/../classes/user_class.php";
session_start();

$user = new User($_SESSION['userID']);
$user->unsubscribe();
/*
$database_connection = database::getInstance();
$user_id = $_SESSION['userID'];
$database_connection->unsubscribe($user_id);
// echo "Unsubscribed";
*/
$_SESSION['sub'] == 'Inactive';
header("Location: ../acc_view.php?msg= Unubscribed");
