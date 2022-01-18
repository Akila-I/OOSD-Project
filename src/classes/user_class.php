<?php
require "database_class.php";
require "book_class.php";

class User{
    protected $user_id;
    protected $first_name;
    protected $last_name;
    protected $username;
    protected $email;
    protected $password;
    protected $role;

    protected $database_connection;

    function __construct($userid)
    {
        $this->database_connection = database::getInstance();
        $this->user_id = $userid;
       // $this->password = $password;
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
        $books_list = array();
        for ($i=0; $i < sizeof($x); $i++) { 
            array_push($books_list, $this->viewBookDetails($x[$i]));
        }
        return $books_list;
    } 

    public function viewFavList(){
        $x = $this->database_connection->getUserFavBooks($this->user_id);
        $books_list = array();
        for ($i=0; $i < sizeof($x); $i++) { 
            array_push($books_list, $this->viewBookDetails($x[$i]));
        }
        return $books_list;
    }

    public function viewFinishedList(){
        $x = $this->database_connection->getUserFinishedBooks($this->user_id);
        $books_list = array();
        for ($i=0; $i < sizeof($x); $i++) { 
            array_push($books_list, $this->viewBookDetails($x[$i]));
        }
        return $books_list;
    }

    public function viewReadingList(){
        $x = $this->database_connection->getUserReadingBooks($this->user_id);
        $books_list = array();
        for ($i=0; $i < sizeof($x); $i++) { 
            array_push($books_list, $this->viewBookDetails($x[$i]));
        }
        return $books_list;
    }

    public function addToFavList($book_id){
        $this->database_connection->addToFav($this->user_id, $book_id);
    }

    public function removeFromFavList($book_id){
        $this->database_connection->removeFromFav($this->user_id, $book_id);
    }

    public function viewBookDetails($book_id){
        $x = $this->database_connection->getBookDetails($book_id);
        $book = new proxyBook($x['book_id'],$x['title'], $x['author'], $x['year'], $x['isbn'], $x['category']);
        return $book;
    }

    public function searchABook($book){
        $x = $this->database_connection->searchBook($book);
        
        $books_list = array();
        for ($i=0; $i < sizeof($x); $i++) { 
            array_push($books_list, $this->viewBookDetails($x[$i]));
        } 
        return $books_list;
    }

    public function markAsFinished($book_id){}

    public function openBook($book_id){}

    public function closeBook(){}

    public function viewProfile(){}

}