<?php
require_once __DIR__."/classes/database_class.php";
session_start();
$user = $_SESSION['userID'];

if (isset($_POST['Donate'])) 
{
    //print_r($_POST);
    $database_connection = new database();
    $database_connection->donateABook($_POST['donor'], $_POST['book_isbn'],$_POST['book_title'], 
                                      $_POST['book_author'], $_POST['book_year'], $_POST['book_catagory'], $_POST['book']);
}

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
    <title>Donate a Book</title>
</head>
<body>
<?php require "top_menu_bar.php";?>
    <div class="container login-container">
    <div class="row">
    <div class="col-md-6 login-form-1">
    
    <h3>Donate a Book</h3>
    <div class="container">
        
    <form action="" method="post">
        

            <div class="form-group">
                <label for="book_title">Title :</label>
                <input type="text" class="form-control" name="book_title" placeholder="Book Title"  required/>
            </div>

            <div class="form-group">
                <label for="book_author">Author :</label>
                <input type="text" class="form-control" name="book_author" placeholder="Author"  required/>
            </div>

            <div class="form-group">
                <label for="book_year">Year :</label>
                <input type="integer" class="form-control" name="book_year" placeholder="Year"  required/>
            </div>

            <div class="form-group">
                <label for="book_isbn">ISBN :</label>          
                <input type="text" class="form-control" name="book_isbn" placeholder="ISBN"  required/>
            </div>

            <div class="form-group">
                <label for="book_catagory">catagory :</label>          
                <input type="text" class="form-control" name="book_catagory"  placeholder="catagory"  required />
            </div>

            <div class="form-group">
                <label for="book">Book :</label>  
                <input type="file" class="form-control" name="book"  placeholder="book-temp"  required />
            </div>

            <input type="hidden" name="donor" value= <?php echo $user?> >

            <input type="submit" name="Donate" value="donate">
            <input type="button" value="Back" onclick="history.back()">

    </form>

    </div>
    </div>
    </div>
    </div>
</body>
</html>