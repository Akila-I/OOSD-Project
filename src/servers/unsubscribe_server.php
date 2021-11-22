<?php
require_once __DIR__."/../classes/database_class.php";
session_start();

$database_connection = new database();
$user_id = $_SESSION['userID'];
$database_connection->unsubscribe($user_id);
// echo "Unsubscribed";
header("Location: ../acc_view.php");
