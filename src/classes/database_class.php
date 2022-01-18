<?php
require_once __DIR__."/../pdo/pdo.php";

class database{
    //singleton
    protected $pdo;

    private static $instance;

    private function __construct() {

        $this->connect();

    }

    public static function getInstance()
    {
    if ( self::$instance == null)
    {
        self::$instance = new database();
    }

    return self::$instance;
    }
/*
    function __construct()
    {
        $this->connect();
    }
*/
    private function connect(){
        //EDIT THIS LINE ACCORDINGLY
        global $local_pdo;
        $this->pdo = $local_pdo;
    }

    function validateUser($username, $password){

        $sql = "SELECT password FROM users WHERE username = :un";

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
        $sql = "SELECT * FROM users
        WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details;
    }

    function getSubscriptionState($userID){
        $sql = "SELECT * FROM subscriptions WHERE user_id = :userid ORDER BY subs_id DESC";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':userid' => $userID
        ));

        $sub_details = $statement->fetch(PDO::FETCH_ASSOC);

        if($sub_details == null){
            return "Unsubscribed";
        }
        else{
            return $sub_details['subs_status'];
        }
        
    }

    function getSubscriptionDate($userID){
        $sql = "SELECT * FROM subscriptions WHERE user_id = :userid ORDER BY subs_id DESC";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':userid' => $userID
        ));

        $sub_details = $statement->fetch(PDO::FETCH_ASSOC);

        if($sub_details == null){
            return "N/A";
        }
        else{
            return $sub_details['subs_date'];
        }
        
    }
    
    function getUserID($username){
        $sql = "SELECT * FROM users WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details['user_id'];
    }

    function getUserName($userID){
        $sql = "SELECT * FROM users WHERE user_id = :u_id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $userID
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details['username'];
    }

    function getUserRole($username){
        $sql = "SELECT * FROM users WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details['role'];
    }

    function usernameAvailability($username){
        $sql = "SELECT password FROM users WHERE username = :un";

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
        $sql = "INSERT INTO users(f_name,l_name,username,email,password,role) 
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

    function updateUser($user_id,$fname,$lname,$username,$email,$password){
        /*$sql = "INSERT INTO users(f_name,l_name,username,email,password,role) 
        VALUES (:fn, :ln, :un, :em, :pw, :r)";*/
        $sql="UPDATE users SET f_name = :fn, l_name = :ln, username = :un, email = :em, password = :pw WHERE user_id = :u_id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':fn' => $fname,
            ':ln' => $lname,
            ':un' => $username,
            ':em' => $email,
            ':pw' => $password,
            ':u_id' => $user_id
        ));
    }

    function getUserFavBooks($user_id){
        
        $sql = "SELECT book_id FROM favourites WHERE user_id = :u_id";
    
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
        
        $sql1 = "SELECT fav_entry_id FROM favourites WHERE user_id = :u_id AND book_id = :b_id";

        $statement1 = $this->pdo->prepare($sql1);
        $statement1->execute(array(
            ':u_id' => $user_id,
            ':b_id' => $book_id
        ));

        $availability = $statement1->fetch(PDO::FETCH_ASSOC);

        if ($availability === false){
            $sql2 = "INSERT INTO favourites (user_id, book_id)
            VALUES (:u_id, :b_id)";
        
            $statement2 = $this->pdo->prepare($sql2);
            $statement2->execute(array(
                ':u_id' => $user_id,
                ':b_id' => $book_id
            ));
        }
    }

    function removeFromFav($user_id, $book_id){
    
        $sql = "DELETE FROM favourites
        WHERE user_id = :u_id AND book_id = :b_id";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':b_id' => $book_id
        ));
    }

    function getUserReadingBooks($user_id){
    
        $sql = "SELECT book_id FROM userbooks WHERE user_id = :u_id AND state = :stt";
    
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
    
        $sql = "SELECT book_id FROM userbooks WHERE user_id = :u_id AND state = :stt";
    
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

    function addTouserbooks($user_id, $book_id, $state){
    
        $sql1 = "SELECT userbook_id FROM userbooks WHERE user_id = :u_id AND book_id = :b_id";

        $statement1 = $this->pdo->prepare($sql1);
        $statement1->execute(array(
            ':u_id' => $user_id,
            ':b_id' => $book_id
        ));

        $availability = $statement1->fetch(PDO::FETCH_ASSOC);

        if ($availability === false){
            $sql2 = "INSERT INTO userbooks (user_id, book_id, state)
            VALUES (:u_id, :b_id, :stt)";
        
            $statement2 = $this->pdo->prepare($sql2);
            $statement2->execute(array(
                ':u_id' => $user_id,
                ':b_id' => $book_id,
                ':stt' => $state
            ));
        }
        else if($availability['state'] !== $state){

            $sql3 = "UPDATE userbooks SET state = :stt 
            WHERE user_id = :u_id AND book_id = :b_id";

            $statement3 = $this->pdo->prepare($sql3);
            $statement3->execute(array(
                ':u_id' => $user_id,
                ':b_id' => $book_id,
                ':stt' => $state
            ));
        }
    }

    function getBookDetails($book_id){

        $sql = "SELECT * FROM books WHERE book_id = :b_id";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':b_id' => $book_id
        ));
        $db_details = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $db_details;     //formatting to JSONs?
    }

    function getDonationDetails($book_id){

        $sql = "SELECT * FROM books_to_add WHERE book_id = :b_id";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':b_id' => $book_id
        ));
        $db_details = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $db_details;     //formatting to JSONs?
    }

    function addSubs($user_id, $state, $subs_date){
    
        $sql = "INSERT INTO subscriptions (user_id, subs_status, subs_date)
        VALUES (:u_id, :stt, :sub_date)";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':stt' => $state,
            ':sub_date' => $subs_date
        ));
    }

    function addCard($user_id, $card_num, $exp_month, $exp_year){
    
        $sql = "INSERT INTO CardDetails (user_id, card_number, exp_month, exp_year)
        VALUES (:u_id, :c_num, :e_m, :e_y)";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id,
            ':c_num' => $card_num,
            ':e_m' => $exp_month,
            ':e_y' => $exp_year,

        ));
    }

    function getAllBooks(){    
        $sql = "SELECT book_id FROM books";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
            
        $arr = array();
    
        while( $db_books = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$db_books['book_id']);
        }
    
        return $arr;
    }

    function getDonations(){    
        $sql = "SELECT book_id FROM books_to_add";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
            
        $arr = array();
    
        while( $db_books = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$db_books['book_id']);
        }
    
        return $arr;
    }

    function donateABook($donor_id, $isbn, $title, $author, $year, $catagory)
    {
        $sql = 'INSERT INTO books_to_add(donor_id,isbn,title,author,year,category)
                VALUES (:di, :isbn, :ti, :au, :yr, :ctgy)';
        
        $statement = $this->pdo->prepare($sql);
        $statement->execute( array(

            ':di' => $donor_id,
            ':isbn' => $isbn,
            ':ti' => $title,
            ':au' => $author,
            ':yr' => $year,
            ':ctgy' => $catagory

        ));

        //return donate id
        $sql2 = 'SELECT * FROM books_to_add ORDER BY book_id DESC LIMIT 1';
        $statement2 = $this->pdo->prepare($sql2);
        $statement2->execute();
        $donate_id = $statement2->fetch(PDO::FETCH_ASSOC);
        return $donate_id['book_id'];
    }

    function AddNewBook($isbn, $title, $author, $year, $catagory)
    {
        $sql = 'INSERT INTO books (isbn,title,author,year,category)
                VALUES (:isbn, :ti, :au, :yr, :ctgy)';
        
        $statement = $this->pdo->prepare($sql);
        $statement->execute( array(

            ':isbn' => $isbn,
            ':ti' => $title,
            ':au' => $author,
            ':yr' => $year,
            ':ctgy' => $catagory

        ));

        $sql2  = 'SELECT * FROM books WHERE book_id=(SELECT MAX(book_id) FROM books)';
        $statement2 = $this->pdo->prepare($sql2);
        $statement2->execute();
        $book_id = $statement2->fetch(PDO::FETCH_ASSOC);
        return $book_id['book_id']; 
    }

    function approveDonation($donation_id){

        //get the donation details
        $sql = "SELECT * FROM books_to_add WHERE book_id = :b_id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':b_id' => $donation_id
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        //add the donation into books
        $sql2 = "INSERT INTO books(isbn,title,author,year,category)
                VALUES (:isbn, :ti, :au, :yr, :ctgy)";
        
        $statement2 = $this->pdo->prepare($sql2);
        $statement2->execute( array(

            ':isbn' => $db_details['isbn'],
            ':ti' => $db_details['title'],
            ':au' => $db_details['author'],
            ':yr' => $db_details['year'],
            ':ctgy' => $db_details['category']

        ));

        //delete donation details from books_to_add
        $sql3 = "DELETE FROM books_to_add 
                WHERE book_id = :b_id";
    
        $statement3 = $this->pdo->prepare($sql3);
        $statement3->execute(array(
            ':b_id' => $donation_id
        ));

        //return new book_id (to rename the file)
        $sql4 = 'SELECT * FROM books ORDER BY book_id DESC LIMIT 1';
        $statement4 = $this->pdo->prepare($sql4);
        $statement4->execute();
        $new_book_id = $statement4->fetch(PDO::FETCH_ASSOC);
        return $new_book_id['book_id'];

    }

    function requestBook($request_by, $isbn, $title, $author, $year, $catagory)
    {

        $sql = "INSERT INTO requests(request_by,isbn,title,author,year,category)
                VALUES (:ri, :isbn, :ti, :au, :yr, :ctgy)";
        
        $statement = $this->pdo->prepare($sql);
        $statement->execute( array(

            ':ri' => $request_by,
            ':isbn' => $isbn,
            ':ti' => $title,
            ':au' => $author,
            ':yr' => $year,
            ':ctgy' => $catagory

        ));
    }

    function getRequests(){
        $sql = "SELECT * FROM requests";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
            
        $arr = array();
    
        while( $reqs = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$reqs);
        }
    
        return $arr;
    }

    function checksubs_status($user_id){
        $sql = "SELECT * FROM subscriptions WHERE user_id = :ui";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':ui' => $user_id
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details['subs_status'];
    }

    function unsubscribe($user_id){
        // change state instead of delete
        $sql="UPDATE subscriptions SET subs_status = 'Cancelled' WHERE user_id = :u_id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id
        ));

        // $sql = "DELETE FROM subscriptions 
        // WHERE user_id = :u_id";
    
        // $statement = $this->pdo->prepare($sql);
        // $statement->execute(array(
        //     ':u_id' => $user_id
        // ));
    }

    function searchBook($name){
        $sql = "SELECT book_id FROM books WHERE title LIKE :search";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':search' => '%'.$name.'%'
        ));
        $arr = array();
    
        while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($arr,$db_readings['book_id']);
        }
        
        return $arr;
    }

    function checkSubs($user_id){
        //get subscription of user, if expired return true
        $sql = "SELECT subs_date,subs_id FROM subscriptions WHERE user_id = :u_id AND subs_status = 'Active' ";
    
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':u_id' => $user_id
        ));
        $changed = false;
        while( $db_readings = $statement->fetch(PDO::FETCH_ASSOC)){
            if(date('Y-m-d') > date('Y-m-d',strtotime($db_readings['subs_date'].' + 1 year'))){
                $sql="UPDATE subscriptions SET subs_status = 'Expired' WHERE subs_id = :s_id";

                $statement = $this->pdo->prepare($sql);
                $statement->execute(array(
                    ':s_id' => $db_readings['subs_id']
                ));

                $changed = true;
            } }
        return $changed;
    }
}