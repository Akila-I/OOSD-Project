<?php
require_once __DIR__."/classes/user_class.php";
require_once __DIR__."/classes/librarian_class.php";
require_once __DIR__."/classes/book_class.php";

session_start();
if($_SESSION['userID']===null){
  header("Location: index.php?msg=Please Login First");
}

if ($_SESSION['role'] == 'Reader') {
  $user = new User($_SESSION['userID']);
}else{
  $user = new librarian($_SESSION['userID']);
}



if(isset($_SESSION['search'])){
  if($_SESSION['search'] == 'empty'){
      echo("<script>alert('Empty Search!');</script>");
      $_SESSION['search'] = 'reset';
  }

  if($_SESSION['search'] == 'no-result'){
      echo("<script>alert('No Result Found!');</script>");
      $_SESSION['search'] = 'reset';
  }
}

$type = $_GET['type'];

//$user = $_SESSION['userID'];

use function PHPSTORM_META\type;
// $database_connection = database::getInstance();

if( isset($_POST)){
  
  if (isset($_POST['Book']))
  {
    $book_id = $_POST['Book'];
    $book_t = $_POST['Title'];
  }
//heavy book
  if( isset($_POST['Open'])){

    if($type == 5){
    
    header("Location:  servers/open_book_server.php?id=$book_id&d=1");
    }
    else{
    header("Location: servers/open_book_server.php?id=$book_id&d=0");
   // new HeavyBook()
    }
  }

  elseif( isset($_POST['AddtoFav'])){
      $user->addToFavList( $book_id);
  }
  elseif( isset($_POST['RemoveFromFav'])){
    $user->removeFromFavList( $book_id);
  }
  elseif( isset($_POST['Approve'])){
    $new_book_id = $user->approveDonation($book_id);
    //$database_connection->ApproveDonation($book_id);
    
    // move the pdf into books folder
    rename("../books/donated/".$book_id.".pdf","../books/".$new_book_id.".pdf");

  }

}
        
function get_list($list_type){
  
  global $list_name ;
  global $user;
  // global $database_connection;

  $book_list = null;
  
  //all list
  if($list_type === 0)
  {
   
    $book_list = $user->viewBookList();
  }
  //finished list
  if($list_type === 1)
  {
    $list_name = "Finished Books";
    $book_list =$user->viewFinishedList();
  }
  //reading list
  elseif($list_type === 2){

    $list_name = "Reading Books";
    $book_list = $user->viewReadingList();
  }
       
  //favourites list
  elseif($list_type === 3){

    $list_name = "Favourites";
    $book_list = $user->viewFavList();
  }

  //search results list
  elseif($list_type === 4){

    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }

    if($_GET['search'] == null){
      $_SESSION['search'] = 'empty';
      //return to previous page
      header("Location: $previous");
    }

    $list_name = "Search Results";
    $book_list = $user->searchABook($_GET['search']);
    if($book_list == null){
      $_SESSION['search'] = 'no-result';
      //return to previous page
      header("Location: $previous");           
    }
  }

  //donations list
  elseif($list_type === 5){
    $list_name = "Donations";
    $previous = "javascript:history.go(-1)";
    $book_list = $user->viewDonations();

    if($book_list == NULL){
      echo("<script>alert('No Donations Available.');</script>");
      // header("Location: $previous");           

    }

  }

  return $book_list;

}
      $list_name = "Library";
      $x = get_list((int)$type); 
     
     
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./styles/lists_styles.css">
    <title> <?php echo $list_name?>  </title>  
</head>
<body>
<?php require "top_menu_bar.php";
require "search_button.php";
?>
<div style="margin-left: 0;">
  <input type="button" value="Back" onclick="history.back()">
</div>
<div class="container">
      <ul>
      <?php

$addtofav_button = new AddtoFavouritesButton();  
$removefromfave_button = new RemoveFromFavouritesButton();      
$open_button = new BookDecorator();
$approve_button = new ApproveButton();

for ($i=0; $i < sizeof($x) ; $i++) { 
    $book = $x[$i];

    $book_title = $book->getTitle();
    $book_author = $book->getAuthor();
    $book_year = $book->getYear();
    $book_catagory = $book->getCatagory();
    $book_id = $book->getID();

          echo("<li><div class='entry'>");
          echo('<div class="image"><img src="');
          $img_name = "../images/$book_id.jpg";
          if(!file_exists($img_name)) $img_name = "../images/alt1.jpg";
          if($type == 5) $img_name = "../images/alt2.jpg";
          echo($img_name);
          echo('" alt="Book Cover"></div>');

          echo('<div class="details">');
            echo("<label for='title'>Title : $book_title.</label><br>");
            echo("<label for='author'>Author : $book_author</label><br>");
            echo("<label for='year'>Year : $book_year</label><br>");
            echo("<label for='catrgory'>Category : $book_catagory</label><br>");
          echo("</div>");
          
          echo("<div class='buttons'>");

            echo ("<form method = 'POST'>");
            echo ('<input type="hidden" name="Book" value="'.$book_id.'">');
            echo ('<input type="hidden" name="Title" value="'.$book_title.'">');
           
            $open_button->showOpenButton();
            
            if ($type == 0) {
              $addtofav_button->showAddToFav();
            }

            if ($type == 3) {
              $removefromfave_button->showRemoveFav();
            }
            
            if ($type == 5) {
              $approve_button->showApprove();
            }

      
            echo ('</form>');
              
          echo('</div></div></li><hr>');
        }
        
      ?>

      </ul>
 </div>


</body>
</html>