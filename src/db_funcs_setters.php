<?php

require_once __DIR__ . "/pdo.php";


//sets the state of the given book of the giver user as 'Reading' of Finished
//to be used when user finished a book and change state by user
//only for changing state, not for new entry
function setUserBookState($user_id, $book_id, $state){
    global $pdo;

    $sql = "UPDATE UserBooks SET state = :stt
    WHERE user_id = :u_id AND book_id = :b_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':b_id' => $book_id,
        ':stt' => $state
    ));
}

//test setUserBookState function
// setUserBookState("1","4","Reading");


//adds the given book to the given users favList
function addToFav($user_id, $book_id){
    global $pdo;

    $sql = "INSERT INTO Favourites (user_id, book_id)
    VALUES (:u_id, :b_id)";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':b_id' => $book_id
    ));
}

//test addToFav function
// addToFav("1","3");


//adds the given book with given state to the given users list
//to be called when opening a book by user
function addToUserBooks($user_id, $book_id, $state){
    global $pdo;

    $sql = "INSERT INTO UserBooks (user_id, book_id, state)
    VALUES (:u_id, :b_id, :stt)";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':b_id' => $book_id,
        ':stt' => $state
    ));
}

//test addToUserBooks function
// addToUserBooks(2,2,"Finished");