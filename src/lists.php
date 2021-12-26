<?php
require_once __DIR__."/classes/database_class.php";
session_start();
if($_SESSION['userID']===null){
  header("Location: index.php?msg=Please Login First");
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


$user = $_SESSION['userID'];

use function PHPSTORM_META\type;
$database_connection = new database();

if( isset($_POST)){
  
  if (isset($_POST['Book']))
  {
    $book_id = $_POST['Book'];
  }

  if( isset($_POST['Open'])){

    print_r($book_id);
    header("Location: bookview.php?id=$book_id");

  }
  elseif( isset($_POST['AddtoFav'])){
      $database_connection->addToFav($user, $book_id);
  }

}
        
function get_list($list_type){
  
  global $list_name ;
  global $user;
  global $database_connection;

  $book_list = null;
  
  //all list
  if($list_type === 0)
  {
    $book_list = $database_connection->getAllBooks();
  }
  //finished list
  if($list_type === 1)
  {
    $list_name = "Finished Books";
    $book_list = $database_connection->getUserFinishedBooks($user);
  }
  //reading list
  elseif($list_type === 2){

    $list_name = "Reading Books";
    $book_list = $database_connection->getUserReadingBooks($user);
  }
       
  //favourites list
  elseif($list_type === 3){

    $list_name = "Favourites";
    $book_list = $database_connection->getUserFavBooks($user);
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
    $book_list = $database_connection->searchBook($_GET['search']);
    if($book_list == null){
      $_SESSION['search'] = 'no-result';
      //return to previous page
      header("Location: $previous");           
    }
  }
  return $book_list;

}
      $type = $_GET['type'];
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
    <title> <?php echo $list_name?> </title>  
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
        foreach ($x as $key => $value) {

          $book_details = $database_connection->getBookDetails($value);
         
          $book_title = $book_details['title'];
          $book_author = $book_details['author'];
          $book_year = $book_details['year'];
          $book_catagory = $book_details['category'];
          $book_id = $book_details['book_id'];

          echo("<li><div class='entry'>");
          echo('<div class="image"><img src="../images/'.$book_id.'.jpg" alt="Book Cover"></div>');

          echo('<div class="details">');
            echo("<label for='title'>Title : $book_title</label><br>");
            echo("<label for='author'>Author : $book_author</label><br>");
            echo("<label for='year'>Year : $book_year</label><br>");
            echo("<label for='catrgory'>Category : $book_catagory</label><br>");
          echo("</div>");
          
          echo("<div class='buttons'>");

            echo ("<form method = 'POST'>");
            echo ('<input type="hidden" name="Book" value="'.$book_id.'">');
            echo ('<input type="submit" name="Open" value="Open"><br><br>');
            
            if ($type == 0) {
              echo ('<input type="submit" name="AddtoFav" value="Add to Favourites">');
            }

      
            echo ('</form>');
              
          echo('</div></div></li><hr>');
        }
        
      ?>

      </ul>
 </div>


</body>
</html>