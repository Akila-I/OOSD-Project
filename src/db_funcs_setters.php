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


//add a card to the given user
function addCard($user_id, $card_num, $valid_till){
    global $pdo;

    $sql = "INSERT INTO CardDetails (user_id, card_number, valid_till)
    VALUES (:u_id, :c_num, :valid_till)";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':c_num' => $card_num,
        ':valid_till' => $valid_till
    ));
}

//test addCard function
// addCard(1,12345,'2023/10/15');


//adds a new subscription for a given user
function addSubs($user_id, $state, $subs_date){
    global $pdo;

    $sql = "INSERT INTO Subscriptions (user_id, subs_status, subs_date)
    VALUES (:u_id, :stt, :sub_date)";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':stt' => $state,
        ':sub_date' => $subs_date
    ));
}

//test addSubs function
// addSubs(2,"Active",'2021/11/03');

//TO BE COMPLETED
function setSubStatus(){

}


//removes a favourite book for a given user
function removeFromFav($user_id, $book_id){
    global $pdo;

    $sql = "DELETE FROM Favourites
    WHERE user_id = :u_id AND book_id = :b_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':b_id' => $book_id
    ));
}

//test removeFromFav function
removeFromFav(1,3);