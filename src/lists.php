<?php
      require_once "db_funcs_getters.php";
        
      /* 1 -> finished list
         2 -> reading list
         3 -> favourites */
         
      $user = '1'; //user id-----------------

      function get_list($list_type){
        global $user;
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
    
      $x = get_list(3);  //submit button value---------------------
      //print_r($x);

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/lists_styles.css">
    <title>Document</title>
</head>
<body>
<header>
    <!--include header -->
</header> 

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

          echo ("<li><p>$book_title</p>");
          echo ("<p>$book_author\t");
          echo ("$book_year\t");
          echo ("$book_catagory</p></li>");
         
        }

      ?>
      </ul>
    </div>

<div>


</body>
</html>