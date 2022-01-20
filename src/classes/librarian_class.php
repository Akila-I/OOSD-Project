<?php
require_once "user_class.php";


class librarian extends User{

    


    public function viewDonations(){
        $x = $this->database_connection->getDonations();
        $books_list = array();
        for ($i=0; $i < sizeof($x); $i++) { 
            array_push($books_list, $this->viewDonationDetails($x[$i]));
        }
        return $books_list;
    } 


    public function viewDonationDetails($book_id){
        $x = $this->database_connection->getDonationDetails($book_id);
        $book = new proxyBook($x['book_id'],$x['title'], $x['author'], $x['year'], $x['isbn'], $x['category']);
        return $book;
    }

    public function addBook($isbn, $title, $author, $year, $catagory){

        $x = $this->database_connection->AddNewBook($isbn, $title, $author, $year, $catagory);
        return $x;
    }

    public function approveDonation($book_id){

        $x = $this->database_connection->approveDonation($book_id);
        return $x;

    }







}