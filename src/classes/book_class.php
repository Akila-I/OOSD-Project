<?php
interface Book {

    
}


class HeavyBook implements Book{

    private $id;
    private $title;
    private $author;
    private $year;
    private $pdf;
    private $isbn;


    function __construct($id, $title, $author, $year, $isbn)
    {
     $this->$id = $id;  
     $this->$title = $title; 
     $this->$author= $author; 
     $this->$$year = $year; 
     $this->$isbn = $isbn; 

    }

    function loadPdf  ($id, $isDonation){
        if($isDonation == true){
            header("Location: ../bookview.php?id=$id&d=1");
        }
        else if($isDonation == false){
            header("Location: ../bookview.php?id=$id");
        }
    }


}


class ProxyBook implements Book{

    private $id;
    private $title;
    private $author;
    private $year;
    private $isbn;


    function __construct($id, $title, $author, $year, $isbn)
    {
     $this->$id = $id;  
     $this->$title = $title; 
     $this->$author= $author; 
     $this->$$year = $year; 
     $this->$isbn = $isbn; 

    }
    


}