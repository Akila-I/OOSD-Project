<?php
require_once __DIR__."/classes/database_class.php";
$database_connection = new database();

session_start();
if($_SESSION['userID']===null){
    header("Location: index.php?msg=Please Login First");
}

$all = $database_connection->getAllBooks();
$fav = $database_connection->getUserFavBooks($_SESSION['userID']);
$reading = $database_connection->getUserReadingBooks($_SESSION['userID']);
$finished = $database_connection->getUserFinishedBooks($_SESSION['userID']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Library - Home</title>  <!--button value -->
    <style>
    .homeLists{
        font-size: 15px;
    }

    img{

        width: 250px;
        height: 300px;
        /*align-self: auto;*/
        
    }
    </style>
</head>

    <body>
    <?php require "top_menu_bar.php"; ?>
    <div  class="col-md-6 login-form-1">
        <h1>Virtual Lobby</h1> 

        <!-- <form>
            Search:<input type="text" value=""><br>
        </form> -->

        <div class="homeLists">
            <hr>
        <h6>All Books</h6>
        <a href="lists.php?type=0"><label for="AllBooks">See All</label></a>
        <table><tr>
            <?php
            for($i = 0; $i<3; $i++){
                $book_id = $all[$i];
                $book_details = $database_connection->getBookDetails($book_id);
                echo ('<td>
                <ul style="list-style-type:none">
                <li><img src="../images/'.$book_id.'.png" alt="x" align ="left"/></li><br>
                <li>'.$book_details['title'].'</li>
                </ul>
                </td>');
            }
            ?>
            </tr></table>
            
        </div>
        
        <div class="homeLists">
            <hr>
            <h6>Your Favourites...</h6>
            <a href="lists.php?type=3"><label for="Favs">See All</label></a>
            <table><tr>
                <?php
                for($i = 0; $i<3; $i++){
                    $book_id = $fav[$i];
                    if($book_id === null){
                        echo ('<td>
                    <ul style="list-style-type:none">
                    <li><img src="../images/alt.png" alt="x" align ="left"/></li><br>
                    <li>Read More with us</li>
                    </ul>
                    </td>');
                    }
                    else{
                    $book_details = $database_connection->getBookDetails($book_id);
                    echo ('<td>
                    <ul style="list-style-type:none">
                    <li><img src="../images/'.$book_id.'.png" alt="x" align ="left"/></li><br>
                    <li>'.$book_details['title'].'</li>
                    </ul>
                    </td>');
                    }
                }
                ?>
                </tr></table>
               
        </div>

        <div class="homeLists">
            <hr>
            <h6>What you were reading...</h6>
            <a href="lists.php?type=2"><label for="Readings">See All</label></a>
            <table><tr>
                <?php
                for($i = 0; $i<3; $i++){
                    $book_id = $reading[$i];
                    if($book_id === null){
                        echo ('<td>
                    <ul style="list-style-type:none">
                    <li><img src="../images/alt.png" alt="x" align ="left"/></li><br>
                    <li>Read More with us</li>
                    </ul>
                    </td>');
                    }
                    else{
                    $book_details = $database_connection->getBookDetails($book_id);
                    echo ('<td>
                    <ul style="list-style-type:none">
                    <li><img src="../images/'.$book_id.'.png" alt="x" align ="left"/></li><br>
                    <li>'.$book_details['title'].'</li>
                    </ul>
                    </td>');
                    }
                }
                ?>
                </tr></table>
               
        </div>

        <div class="homeLists">
            <hr>
            <h6>What you have finished...</h6>
            <a href="lists.php?type=1"><label for="Finished">See All</label></a>
            <table><tr>
                <?php
                for($i = 0; $i<3; $i++){
                    $book_id = $finished[$i];
                    if($book_id === null){
                        echo ('<td>
                    <ul style="list-style-type:none">
                    <li><img src="../images/alt.png" alt="x" align ="left"/></li><br>
                    <li>Read More with us</li>
                    </ul>
                    </td>');
                    }
                    else{
                    $book_details = $database_connection->getBookDetails($book_id);
                    echo ('<td>
                    <ul style="list-style-type:none">
                    <li><img src="../images/'.$book_id.'.png" alt="x" align ="left"/></li><br>
                    <li>'.$book_details['title'].'</li>
                    </ul>
                    </td>');
                    }
                }
                ?>
                </tr></table>
               
        </div>
          
        <!-- <a href=""><img src="f1.png" width="100" height="100"> </a>   --> <!-- Account -->
        <a href="add_book.php"> Donate a Book </a> <!-- Buy -->
    </div>
    </body>
</html>