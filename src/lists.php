<?php
session_start();
use function PHPSTORM_META\type;

require_once "db_funcs_getters.php";
        
      /* 1 -> finished list
         2 -> reading list
         3 -> favourites */
         
      function get_list($list_type){
        $user = $_SESSION['userID']; //user id-----------------
        $book_list = null;

        //finished list
        if($list_type === 1)
        {
          $book_list = getUserFinishedBooks($user);
            
        }
        //reading list
        elseif($list_type === 2){

          $book_list = getUserReadingBooks($user);

        }
        //favourites list
        elseif($list_type === 3){

          $book_list = getUserFavBooks($user);
      
        }
        return $book_list;

      }
      $type = $_GET['type'];
      $x = get_list((int)$type);  //submit button value---------------------
      //print_r($x);

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
    <title>Virtual Library - Books</title>  <!--button value -->
</head>
<body>
<?php require "top_menu_bar.php"; ?>

<div class="container">
    <div>
      <ul>
      <?php
        foreach ($x as $key => $value) {

          $book_details = getBookDetails($value);
         
          $book_title = $book_details['title'];
          $book_author = $book_details['author'];
          $book_year = $book_details['year'];
          $book_catagory = $book_details['category'];
          $book_id = $book_details['book_id'];

          echo ('<li><img src="../images/'.$book_id.'.png" alt="x" align ="left"/>');
          echo ("<div class='title'>$book_title</div>");
          echo ("<div class='author'>$book_author</div>");
          echo ("<div class='year'>$book_year</div>");
          echo ("<div class='category'>$book_catagory</div>");
          echo ('<a href="bookview.php?id='.$book_id.'"><input type="submit" value="open"></a></li>');
          

        }
        
      ?>
      
        
      
      </ul>
    </div>
 </div>


</body>
</html>