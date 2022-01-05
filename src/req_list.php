<?php
require_once __DIR__."/classes/database_class.php";
session_start();
session_start();
if($_SESSION['userID']===null){
  header("Location: index.php?msg=Please Login First");
}

$db_connection = new database();

$req_list = $db_connection->getRequests();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./styles/lists_styles.css">
    <title>Requests</title>
</head>
<body>

<?php require "top_menu_bar.php";
require "search_button.php";
?>
<div  class="col-md-6 login-form-1">

<h1>Requests</h1>
<div class="container">
      <ul>
      <?php
        foreach ($req_list as $key => $value) {
            $book_title = $value['title'];
            $book_author = $value['author'];
            $book_year = $value['year'];
            $book_catagory = $value['category'];
            $request_by = $db_connection->getUserName($value['request_by']);
            $req_id = $value['req_id'];

            echo("<li><div class='entry'>");
  
            echo('<div class="details">');
            //   echo("<label for='title'>Title : $book_title</label><br>");
            echo("<h3>Title : $book_title</h3><br>");
            echo("<label for='author'>Author : $book_author</label><br>");
            echo("<label for='year'>Year : $book_year</label><br>");
            echo("<label for='catrgory'>Category : $book_catagory</label><br>");
            echo("<label for='req_by'>Requested by : $request_by</label><br>");
            echo("</div>");
            
            echo("<div class='buttons'>");
  
              echo ("<form method = 'POST'>");
              echo ('<input type="hidden" name="Req" value="'.$req_id.'">');
              echo ('<input type="submit" name="View" value="Mark as Viewed"><br><br>');
              
            //   if ($type == 0) {
            //     echo ('<input type="submit" name="AddtoFav" value="Add to Favourites">');
            //   }
  
            //   if ($type == 3) {
            //     echo ('<input type="submit" name="RemoveFromFav" value="Remove From Favourites">');
            //   }         
  
        
              echo ('</form>');
                
            echo('</div></div></li><hr>');
          }
          
        ?>
  
        </ul>
   </div>
</div>
</body>
</html>