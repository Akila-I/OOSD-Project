<?php

require_once __DIR__ . "/pdo.php";

//returns the password of a given username, false if user not found
//to be used in login 
function getUserPW($username){
    global $pdo;

    $sql = "SELECT password FROM Users
    WHERE username = :un";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':un' => $username
    ));
    $db_password = $statement->fetch(PDO::FETCH_ASSOC);

    if ($db_password === false){
        return false;
    }
    else{
        return $db_password['password'];
    }
}

//test getUserPW function
echo getUserPW("akilag")."\n";


//returns the role of a given user
//to be used in permission givings 
function getUserRole($user_id){
    global $pdo;

    $sql = "SELECT role FROM Users
    WHERE user_id = :u_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id
    ));
    $db_details = $statement->fetch(PDO::FETCH_ASSOC);

    return $db_details['role'];
}

//test getUserRole function
//echo getUserRole("1")."\n";


//returns an array of details of a given user
//to be used to view the profile
function getUserDetails($user_id){
    global $pdo;

    $sql = "SELECT * FROM Users
    WHERE user_id = :u_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id
    ));
    $db_details = $statement->fetch(PDO::FETCH_ASSOC);

    return $db_details;     //formatting to JSONs?
}

//test getUserDetails function
//echo getUserDetails("1")."\n";


//returns an array of book ids for favourite books of a given user
//to be used to view favouries list
function getUserFavBooks($user_id){
    global $pdo;

    $sql = "SELECT book_id FROM Favourites
    WHERE user_id = :u_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id
    ));
    $arr = array();

    while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
        array_push($arr,$db_readings['book_id']);
    }

    return $arr;
}

//test getUserFavBooks function
//print_r( getUserFavBooks("1");

//returns an array of book ids for 'Reading' state books of a given user
//to be used to view reading list
function getUserReadingBooks($user_id){
    global $pdo;

    $sql = "SELECT book_id FROM UserBooks
    WHERE user_id = :u_id AND state = :stt";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':stt' => "Reading"
    ));

    $arr = array();

    while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
        array_push($arr,$db_readings['book_id']);
    }
   // $db_readings = $statement->fetch(PDO::FETCH_ASSOC);
    return $arr;
   // return $db_readings;     //formatting to JSONs?
}

//test getUserReadingBooks function
//echo getUserReadingBooks("1")."\n";


//returns an array of book ids for 'Finished' state books of a given user
//to be used to view finished list
function getUserFinishedBooks($user_id){
    global $pdo;

    $sql = "SELECT book_id FROM UserBooks
    WHERE user_id = :u_id AND state = :stt";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':stt' => "Finished"
    ));
    $arr = array();

    while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
        array_push($arr,$db_readings['book_id']);
    }
   // $db_readings = $statement->fetch(PDO::FETCH_ASSOC);
    return $arr;
}

//test getUserFinishedBooks function
//echo getUserFinishedBooks("1")."\n";


//returns an array of details of a given book
//to be used to view about a book
function getBookDetails($book_id){
    global $pdo;

    $sql = "SELECT * FROM Books
    WHERE book_id = :b_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':b_id' => $book_id
    ));
    $db_details = $statement->fetch(PDO::FETCH_ASSOC);

    return $db_details;     //formatting to JSONs?
}

//test getBookDetails function
//echo getBookDetails("1")."\n";


//returns the array of details of card data of a given username, false if a card not found
//to be used in getting a saved card 
function getUserCardDetails($user_id){
    global $pdo;

    $sql = "SELECT * FROM CardDetails
    WHERE user_id = :u_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id
    ));
    $db_crd_data = $statement->fetch(PDO::FETCH_ASSOC);

    return $db_crd_data;
}

//test getUserCardDetails function
echo getUserCardDetails("1")."\n";


//returns the array of notifications of a given username, false if a card not found
//to be used in getting a saved card 
function getUserNotifications($user_id){
    global $pdo;

    $sql = "SELECT notification_type FROM Notifications
    WHERE user_id = :u_id";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id
    ));
    $db_notifications = $statement->fetch(PDO::FETCH_ASSOC);

    return $db_notifications;
}

//test getUserNotifications function
echo getUserNotifications("1")."\n";


//returns a boolean value whether a given user has a valid subscription or not
//to be used in permission givings
function getUserSubscription($user_id){
    global $pdo;

    $sql = "SELECT subs_status FROM Subscriptions
    WHERE user_id = :u_id AND subs_status = :stt";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':u_id' => $user_id,
        ':stt' => "Active"
    ));
    $db_subs = $statement->fetch(PDO::FETCH_ASSOC);

    if($db_subs === false){
        return false;
    }
    else{
        return true;
    }
}

//test getUserSubscription function
echo getUserSubscription("1")."\n";

function getAllBooks(){
    global $pdo;

    $sql = "SELECT book_id FROM Books";

    $statement = $pdo->prepare($sql);
    $statement->execute();
        
    $arr = array();

    while( $db_books = $statement->fetch(PDO::FETCH_ASSOC)){
        array_push($arr,$db_books['book_id']);
    }

    return $arr;
}
