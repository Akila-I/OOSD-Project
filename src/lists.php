<?php
require_once __DIR__."/classes/database_class.php";
session_start();
if($_SESSION['userID']===null){
  header("Location: index.php?msg=Please Login First");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./styles/lists_styles.css">
    <title> <?php echo $list_name?> </title>  
</head>
<body>
<?php require "top_menu_bar.php"; ?>
<div style="margin-left: 0;">
  <input type="button" value="Back" onclick="history.back()">
</div>
<div class="container">
    <div>
      <ul>
      <?php
        foreach ($x as $key => $value) {

          $book_details = $database_connection->getBookDetails($value);
         
          $book_title = $book_details['title'];
          $book_author = $book_details['author'];
          $book_year = $book_details['year'];
          $book_catagory = $book_details['category'];
          $book_id = $book_details['book_id'];

          echo ('<li><img src="../images/'.$book_id.'.jpg" alt="x" align ="left"/>');
          echo ("<div class='title'>$book_title</div>");
          echo ("<div class='author'>$book_author</div>");
          echo ("<div class='year'>$book_year</div>");
          echo ("<div class='category'>$book_catagory</div>");

          echo ("<form method = 'POST'>");
          echo ('<input type="hidden" name="Book" value="'.$book_id.'">');
          echo ('<input type="submit" name="Open" value="open">');
          
          if ($type == 0) {
            echo ('<input type="submit" name="AddtoFav" value="add to favourites">');
          }
    
          echo ('</form></li>');
        }
        
      ?>
      
      
      
      </ul>
    </div>
 </div>


</body>
</html>