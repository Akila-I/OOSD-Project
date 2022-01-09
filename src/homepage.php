<?php
//require_once __DIR__."/classes/database_class.php";
require_once __DIR__."/classes/user_class.php";
require_once __DIR__."/classes/book_class.php";
//$database_connection = new database();

session_start();
if($_SESSION['userID']===null){
    header("Location: index.php?msg=Please Login First");
}

//user 
$user = new User($_SESSION['userID']);

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


$all = $user->viewBookList();
$fav = $user->viewFavList();
$reading = $user->viewReadingList();
$finished = $user->viewFinishedList();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/hompage.css">
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
        align-self: auto;
/*
        width: 150px;
        height: 225px;
*/     
    }

    
    label ,a{
        color: #190061;
    }

    

    </style>
</head>

    <body>
    <?php require "top_menu_bar.php"; 
    require "search_button.php";
    ?>

    <div  class="col-md-6 login-form-1">
        <h1 style="color: #190061 ;">VIRTUAL LOBBY</h1> 

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

                $book = $all[$i];
                
                echo ('<td>
                
                <table style="text-align: center; width: 200px;">
                <tr><td><img src="../images/'.$book->getID().'.jpg" alt="x" align ="left"/></td></tr>
                <tr style="height: 50px;"><td><a href="bookview.php?id='.$book->getID().'">'.$book->getTitle().'</a></td></tr>
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
                        break;
                    }

                    else{
                    $book= $fav[$i];
                    echo ('<td>
                
                    <table style="text-align: center; width: 200px;">
                    <tr><td><img src="../images/'.$book->getID().'.jpg" alt="x" align ="left"/></td></tr>
                    <tr style="height: 50px;"><td><a href="bookview.php?id='.$book->getID().'">'.$book->getTitle().'</a></td></tr>
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
                        break;
                    }
                    else{
                   
                    $book = $reading[$i];
                    echo ('<td>
                
                    <table style="text-align: center; width: 200px;">
                    <tr><td><img src="../images/'.$book->getID().'.jpg" alt="x" align ="left"/></td></tr>
                    <tr style="height: 50px;"><td><a href="bookview.php?id='.$book->getID().'">'.$book->getTitle().'</a></td></tr>
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
                        break;
                    }
                    else{
                    $book = $finished[$i];
                    
                    echo ('<td>
                
                    <table style="text-align: center; width: 200px;">
                    <tr><td><img src="../images/'.$book->getID().'.jpg" alt="x" align ="left"/></td></tr>
                    <tr style="height: 50px;"><td><a href="bookview.php?id='.$book->getID().'">'.$book->getTitle().'</a></td></tr>
                    </table>
                    
                    </td>');
                    }
                }
                ?>
                </tr></table>
               
        </div>
    </div>
    </body>
</html>

<!-- TODO : book class --> 