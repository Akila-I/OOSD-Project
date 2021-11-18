<?php
require "database_class.php";

class user{
    private $user_id;
    private $first_name;
    private $last_name;
    private $username;
    private $email;
    private $password;
    private $role;

    private $database_connection;

    function __construct($username, $password)
    {
        $this->database_connection = new database();
        $this->username = $username;
        $this->password = $password;
    }

    public function validate(){
        $result =  $this->database_connection->validateUser($this->username,$this->password);

        if($result === true){
            $userdetails = $this->database_connection->getUserDetails($this->username);
            $this->user_id = $userdetails["user_id"];
            $this->first_name = $userdetails["f_name"];
            $this->last_name =  $userdetails["l_name"];
            $this->email= $userdetails["email"];
            $this->role= $userdetails["role"];
        }
        return $result;
    }
    
    public function getUserID(){
        return $this->user_id;
    }

    public function viewBookList(){
        $x = $this->database_connection->getAllBooks();
        return $x;
    } 

    public function viewFavList(){
        $x = $this->database_connection->getUserFavBooks($this->user_id);
        return $x;
    }

    public function viewFinishedList(){
        $x = $this->database_connection->getUserFinishedBooks($this->user_id);
        return $x;
    }

    public function viewReadingList(){
        $x = $this->database_connection->getUserReadingBooks($this->user_id);
        return $x;
    }

    public function addToFavList($book_id){
        $this->database_connection->addToFavourites($this->user_id, $book_id);
    }

    public function markAsFinished($book_id){}

    public function openBook($book_id){}

    public function closeBook(){}

    public function viewProfile(){}

}