<?php

class database{
    //singleton
    protected $pdo;

    function __construct()
    {
        $this->connect();
    }
    private function connect(){
        //EDIT THIS LINE ACCORDINGLY
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=Library', 'root');
    }

    function validateUser($username, $password){

        $sql = "SELECT password FROM Users WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_password = $statement->fetch(PDO::FETCH_ASSOC);

        if ($db_password === false){
            $msg = "Incorrect Username";
        }
        else if ($db_password['password'] !== $password){
            $msg = "Incorrect Password";
        }
        else{
            $msg = true;
        }
        return $msg;
    }
    
    function getUserDetails($username){
        $sql = "SELECT * FROM Users
        WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details;
    }

    function usernameAvailability($username){
        $sql = "SELECT password FROM Users WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_password = $statement->fetch(PDO::FETCH_ASSOC);

        if ($db_password === false){
            $msg = true;
        }
        else{
            $msg = "This Username is already taken.";
        }
        return $msg;
    }

    function addUser($fname,$lname,$username,$email,$password,$role){
        $sql = "INSERT INTO Users(f_name,l_name,username,email,password,role) 
        VALUES (:fn, :ln, :un, :em, :pw, :r)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':fn' => $fname,
            ':ln' => $lname,
            ':un' => $username,
            ':em' => $email,
            ':pw' => $password,
            ':r' => $role
        ));
    }

    function getUserFavBooks($user_id){
        
        $sql = "SELECT book_id FROM Favourites WHERE user_id = :u_id";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id
        ));
        $arr = array();
    
        while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$db_readings['book_id']);
        }
    
        return $arr;
    }

    function getUserReadingBooks($user_id){
    
        $sql = "SELECT book_id FROM UserBooks WHERE user_id = :u_id AND state = :stt";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':stt' => "Reading"
        ));
    
        $arr = array();
    
        while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$db_readings['book_id']);
        }
        return $arr;
       
    }

    function getUserFinishedBooks($user_id){
    
        $sql = "SELECT book_id FROM UserBooks WHERE user_id = :u_id AND state = :stt";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':stt' => "Finished"
        ));
        $arr = array();
    
        while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$db_readings['book_id']);
        }
        return $arr;
    }

    function getBookDetails($book_id){

        $sql = "SELECT * FROM Books WHERE book_id = :b_id";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':b_id' => $book_id
        ));
        $db_details = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $db_details;     //formatting to JSONs?
    }
    
    
    function getUserID($username){
        $sql = "SELECT * FROM Users WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details['user_id'];
    }

    function getSubsDetails($user_id){

    }

    function addToFavourites($user_id, $book_id){

        $sql = "INSERT INTO favourites(user_id,book_id) VALUES (:ui, :bi)";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':ui' => $user_id,
            ':bi' => $book_id
        ));

    }
}