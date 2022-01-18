<?php
    require_once __DIR__."/../classes/database_class.php";
    
    session_start();
    $book = $_SESSION['bookID'];
    unset($_SESSION['bookID']);

    $database_connection = database::getInstance();

    if(array_key_exists('AddToFav', $_POST)) {
        $database_connection->addToFav($_SESSION['userID'],$book);
        header("Location: ../bookview.php?id=$book");
    }
    else if(array_key_exists('ReadLater', $_POST)) {
        $database_connection->addToUserBooks($_SESSION['userID'],$book,"Reading");
        header("Location: ../homepage.php");
                
    }
    else if(array_key_exists('FinishReading', $_POST)) {
        $database_connection->addToUserBooks($_SESSION['userID'],$book,"Finished");
        header("Location: ../homepage.php");        
    }