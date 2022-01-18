<?php
require_once __DIR__."/classes/database_class.php";
session_start();
//session_start();
if($_SESSION['userID']===null){
  header("Location: index.php?msg=Please Login First");
}
$user = $_SESSION['userID'];

if (isset($_POST['Request'])) 
{
    $request = $_POST;

    $request_by = $_POST['request_by'];
    $book_isbn = ($request['book_isbn'] == NULL) ? 'Not Given' : $request['book_isbn'];
    $book_title = ($request['book_title'] == NULL) ? 'Not Given' : $request['book_title'];
    $book_author = ($request['book_author'] == NULL) ? 'Not Given' : $request['book_author'];
    $book_year = ($request['book_year'] == NULL) ? 'Not Given' : $request['book_year'];
    $book_catagory = ($request['book_catagory'] == NULL) ? 'Not Given' : $request['book_catagory'];

    $database_connection = database::getInstance();
    
    $database_connection->requestBook($request_by,$book_isbn,$book_title,$book_author,$book_year,$book_catagory);

    echo("<script>alert('Your request was sent.');</script>");

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
    <title>Request a Book</title>
</head>
<body>
<?php require "top_menu_bar.php";?>
    <div class="container login-container">
    <div class="row">
    <div class="col-md-6 login-form-1">
    
    <h3>Request a Book</h3>
    <div class="container">
        <div>
        <br><br>
            Tell us what books you want to read in our Virtual Library. <br>
            Only title of the book is required.
        <br><br>
        </div>
    <form action="" method="post">
        

            <div class="form-group">
                <label for="book_title">Title :</label>
                <input type="text" class="form-control" name="book_title" placeholder="Book Title"  required/>
            </div>

            <div class="form-group">
                <label for="book_author">Author :</label>
                <input type="text" class="form-control" name="book_author" placeholder="Author"/>
            </div>

            <div class="form-group">
                <label for="book_year">Year :</label>
                <input type="integer" class="form-control" name="book_year" placeholder="Year"/>
            </div>

            <div class="form-group">
                <label for="book_isbn">ISBN :</label>          
                <input type="text" class="form-control" name="book_isbn" placeholder="ISBN"/>
            </div>

            <div class="form-group">
                <label for="book_catagory">catagory :</label>          
                <input type="text" class="form-control" name="book_catagory"  placeholder="catagory" />
            </div>

            <input type="hidden" name="request_by" value= <?php echo $user?> >

            <input type="submit" name="Request" value="Request">
            <input type="button" value="Back" onclick="history.back()">

    </form>

    </div>
    </div>
    </div>
    </div>
</body>
</html>