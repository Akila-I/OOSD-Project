<?php
require_once "database_class.php";
require_once "book_class.php";
require_once "subscription_class.php";


class User{
    protected $user_id;
    protected $first_name;
    protected $last_name;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected Subscription  $subsState;

    protected $database_connection;

    function __construct($userid)
    {
        $this->database_connection = database::getInstance();
        $this->user_id = $userid;

        if ($this->database_connection->getSubscriptionState($this->user_id) == 'Active') {
            $this->subsState = new Subscription(ActiveState::getStatus());
        }else{
            $this->subsState = new Subscription(InactiveState::getStatus());
        }
        
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

    public function subscribe($card_num,$exp_month,$exp_year){

        $this->database_connection->addSubs($this->user_id, 'Active',date("Y-m-d") );
        $this->database_connection->addCard($this->user_id,$card_num,$exp_month,$exp_year);
        $this->subsState->Activate();

    }

    public function unsubscribe(){

        $this->database_connection->unsubscribe($this->user_id);
        $this->subsState->Deactivate();
        
    }
    public function markAsFinished($book_id){}

    public function openBook($book_id){}

    public function closeBook(){}

    public function viewProfile(){}

    public function update(){
        header("Location: ../homepage.php?subs=expired");
    }

}