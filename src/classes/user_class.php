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
    } 

    public function viewFavList(){}

    public function viewFinishedList(){}

    public function viewReadingList(){}

    public function addToFavList($book_id){}

    public function markAsFinished($book_id){}

    public function openBook($book_id){}

    public function closeBook(){}

    public function viewProfile(){}

}