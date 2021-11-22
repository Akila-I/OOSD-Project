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

    td{
        padding-left: 10px;
        padding-bottom: 10px;
        padding-right: 10px;
    }

    img{

        width: 200px;
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
        <h4>All Books</h4>
        <a href="lists.php?type=0"><label for="AllBooks" style="font-size: 20px;">See All</label></a>
        <table><tr>
            <?php
            for($i = 0; $i<5; $i++){
                $book_id = $all[$i];
                $book_details = $database_connection->getBookDetails($book_id);
                echo ('<td>
                
                <table style="text-align: center; width: 200px;">
                <tr><td><img src="../images/'.$book_id.'.jpg" alt="x" align ="left"/></td></tr>
                <tr style="height: 50px;"><td><a href="bookview.php?id='.$book_id.'">'.$book_details['title'].'</a></td></tr>
                </table>
                
                </td>');
            }
            ?>
            </tr></table>
            
        </div>

        <div class="homeLists">
            <hr>
            <h4>Your Favourites...</h4>
            <a href="lists.php?type=3"><label for="Favs" style="font-size: 20px;">See All</label></a>
            <table><tr>
                <?php
                for($i = 0; $i<5; $i++){
                    
                    if(sizeof($fav)<=$i){
                        echo ('<td>
                
                        <table style="text-align: center; width: 200px;">
                        <tr><td><img src="../images/alt.png" alt="x" align ="left"/></td></tr>
                        <tr style="height: 50px;"><td>Read More with us</td></tr>
                        </table>
                        
                        </td>');
                    }

                    else{
                    $book_id = $fav[$i];
                    $book_details = $database_connection->getBookDetails($book_id);
                    echo ('<td>
                
                    <table style="text-align: center; width: 200px;">
                    <tr><td><img src="../images/'.$book_id.'.jpg" alt="x" align ="left"/></td></tr>
                    <tr style="height: 50px;"><td><a href="bookview.php?id='.$book_id.'">'.$book_details['title'].'</a></td></tr>
                    </table>
                    
                    </td>');
                    }
                }
                ?>
                </tr></table>
               
        </div>

        <div class="homeLists">
            <hr>
            <h4>What you were reading...</h4>
            <a href="lists.php?type=2"><label for="Readings" style="font-size: 20px;">See All</label></a>
            <table><tr>
                <?php
                for($i = 0; $i<5; $i++){
                    if(sizeof($reading)<=$i){
                        echo ('<td>
                
                        <table style="text-align: center; width: 200px;">
                        <tr><td><img src="../images/alt.png" alt="x" align ="left"/></td></tr>
                        <tr style="height: 50px;"><td>Read More with us</td></tr>
                        </table>
                        
                        </td>');
                    }
                    else{
                    $book_id = $reading[$i];
                    $book_details = $database_connection->getBookDetails($book_id);
                    echo ('<td>
                
                    <table style="text-align: center; width: 200px;">
                    <tr><td><img src="../images/'.$book_id.'.jpg" alt="x" align ="left"/></td></tr>
                    <tr style="height: 50px;"><td><a href="bookview.php?id='.$book_id.'">'.$book_details['title'].'</a></td></tr>
                    </table>
                    
                    </td>');
                    }
                }
                ?>
                </tr></table>
               
        </div>

        <div class="homeLists">
            <hr>
            <h4>What you have finished...</h4>
            <a href="lists.php?type=1"><label for="Finished" style="font-size: 20px;">See All</label></a>
            <table><tr>
                <?php
                for($i = 0; $i<5; $i++){
                    if(sizeof($finished)<=$i){
                        echo ('<td>
                
                        <table style="text-align: center; width: 200px;">
                        <tr><td><img src="../images/alt.png" alt="x" align ="left"/></td></tr>
                        <tr style="height: 50px;"><td>Read More with us</td></tr>
                        </table>
                        
                        </td>');
                    }
                    else{
                    $book_id = $finished[$i];
                    $book_details = $database_connection->getBookDetails($book_id);
                    echo ('<td>
                
                    <table style="text-align: center; width: 200px;">
                    <tr><td><img src="../images/'.$book_id.'.jpg" alt="x" align ="left"/></td></tr>
                    <tr style="height: 50px;"><td><a href="bookview.php?id='.$book_id.'">'.$book_details['title'].'</a></td></tr>
                    </table>
                    
                    </td>');
                    }
                }
                ?>
                </tr></table>
               
        </div>
          
        <!-- <a href=""><img src="f1.png" width="100" height="100"> </a>   --> <!-- Account -->
        <a href="add_book.php"> <button>Donate a Book</button></a> <!-- Buy -->
    </div>
    </body>
</html>