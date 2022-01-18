<?php 

require_once __DIR__."/../classes/book_class.php";

$book_id = $_GET['id'];
$is_donation = $_GET['d'];


$heavy_book = new HeavyBook($book_id, $is_donation);