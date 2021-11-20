<?php
require_once __DIR__."/../pdo/pdo.php";

class database{
    //singleton
    protected $pdo;

    function __construct()
    {
        $this->connect();
    }
    private function connect(){
        //EDIT THIS LINE ACCORDINGLY
        global $local_pdo;
        $this->pdo = $local_pdo;
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
    
    function getUserID($username){
        $sql = "SELECT * FROM Users WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details['user_id'];
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

    function addToFav($user_id, $book_id){
        
        $sql1 = "SELECT fav_entry_id FROM Favourites WHERE user_id = :u_id AND book_id = :b_id";

        $statement1 = $this->pdo->prepare($sql1);
        $statement1->execute(array(
            ':u_id' => $user_id,
            ':b_id' => $book_id
        ));

        $availability = $statement1->fetch(PDO::FETCH_ASSOC);

        if ($availability === false){
            $sql2 = "INSERT INTO Favourites (user_id, book_id)
            VALUES (:u_id, :b_id)";
        
            $statement2 = $this->pdo->prepare($sql2);
            $statement2->execute(array(
                ':u_id' => $user_id,
                ':b_id' => $book_id
            ));
        }
    }

    function removeFromFav($user_id, $book_id){
    
        $sql = "DELETE FROM Favourites
        WHERE user_id = :u_id AND book_id = :b_id";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':b_id' => $book_id
        ));
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

    function addToUserBooks($user_id, $book_id, $state){
    
        $sql1 = "SELECT userbook_id FROM UserBooks WHERE user_id = :u_id AND book_id = :b_id AND state = :stt";

        $statement1 = $this->pdo->prepare($sql1);
        $statement1->execute(array(
            ':u_id' => $user_id,
            ':b_id' => $book_id,
            ':stt' => $state
        ));

        $availability = $statement1->fetch(PDO::FETCH_ASSOC);

        if ($availability === false){
            $sql2 = "INSERT INTO UserBooks (user_id, book_id, state)
            VALUES (:u_id, :b_id, :stt)";
        
            $statement2 = $this->pdo->prepare($sql2);
            $statement2->execute(array(
                ':u_id' => $user_id,
                ':b_id' => $book_id,
                ':stt' => $state
            ));
        }
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

    function addSubs($user_id, $state, $subs_date){
    
        $sql = "INSERT INTO Subscriptions (user_id, subs_status, subs_date)
        VALUES (:u_id, :stt, :sub_date)";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':stt' => $state,
            ':sub_date' => $subs_date
        ));
    }

    function addCard($user_id, $card_num, $valid_till){
    
        $sql = "INSERT INTO CardDetails (user_id, card_number, valid_till)
        VALUES (:u_id, :c_num, :valid_till)";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':c_num' => $card_num,
            ':valid_till' => $valid_till
        ));
    }

    function getAllBooks(){    
        $sql = "SELECT book_id FROM Books";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
            
        $arr = array();
    
        while( $db_books = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$db_books['book_id']);
        }
    
        return $arr;
    }

    function donateABook($donor_id, $isbn, $title, $author, $year, $catagory, $book)
    {
        $sql = 'INSERT INTO books_to_add(donor_id,isbn,title,author,year,category,book)
                VALUES (:di, :isbn, :ti, :au, :yr, :ctgy, :bk)';
        
        $statement = $this->pdo->prepare($sql);
        $statement->execute( array(

            ':di' => $donor_id,
            ':isbn' => $isbn,
            ':ti' => $title,
            ':au' => $author,
            ':yr' => $year,
            ':ctgy' => $catagory,
            ':bk' => $book

        ));
    }

}