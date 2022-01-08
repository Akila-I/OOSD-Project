<?php
interface Book {

    function openBook($id);
    
}

abstract class BookDecorator{



}

class AddtoFavouritesButton extends BookDecorator{

    

}

class RemoveFromFavouritesButton extends BookDecorator{

}




class HeavyBook implements Book{

    private $id;
    private $title;
    private $author;
    private $year;
   // private $pdf;
    private $isbn;

   

    private function loadPdf($id){

        header("Location: bookview.php?id=$id");

        
    }


    function __construct($id, $title, $author, $year, $isbn)
    {
     $this->id = $id;  
     $this->title = $title; 
     $this->author= $author; 
     $this->year = $year; 
     $this->isbn = $isbn; 

       // loadPdf($this->id);

    }

    public function getID(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getIsbn(){
        return $this->isbn;
    }

    public function getYear(){
        return $this->year;
    }


    function openBook($id)
    {
        
    function loadPdf  ($id, $isDonation){
        if($isDonation == true){
            header("Location: ../bookview.php?id=$id&d=1");
        }
        else if($isDonation == false){
            header("Location: ../bookview.php?id=$id");
        }
    }

    }



}


class ProxyBook implements Book{

    private $id;
    private $title;
    private $author;
    private $year;
    private $isbn;
    private $catagory;


    function __construct($id, $title, $author, $year, $isbn, $catagory)
    {
     $this->id = $id;  
     $this->title = $title; 
     $this->author= $author; 
     $this->year = $year; 
     $this->isbn = $isbn; 
     $this->catagory = $catagory;

    }

    public function getID(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getIsbn(){
        return $this->isbn;
    }

    public function getYear(){
        return $this->year;
    }

    public function getCatagory(){
        return $this->catagory;
    }

    function openBook($id)
    {
        
    }
    


}