<?php
require_once __DIR__."/classes/librarian_class.php";
session_start();
$user = $_SESSION['userID'];

$admin = new librarian($user);

$database_connection = database::getInstance();
if (isset($_POST['Donate'])) 
{
    if($_SESSION['role'] == 'Librarian'){
        if ($_FILES['book']['type'] == "application/pdf") {
            $source_file = $_FILES['book']['tmp_name'];
            $dest_file = "../books/".$_POST['book_title'];

            if (file_exists($dest_file)) {
                echo("<script>alert('This book is already available in the library.');</script>");
            }
            else {
                move_uploaded_file( $source_file, $dest_file )
                or die ("Error!!");
                if($_FILES['book']['error'] == 0) {
                    /*
                    $id = $database_connection->AddNewBook($_POST['book_isbn'],$_POST['book_title'], 
                                            $_POST['book_author'], $_POST['book_year'], $_POST['book_catagory']);*/

                    $admin->addBook($_POST['book_isbn'],$_POST['book_title'], 
                                        $_POST['book_author'], $_POST['book_year'], $_POST['book_catagory']);
                    echo("<script>alert('Book is added to the library.');</script>");
                    $source = "../books/".$_POST['book_title'];
                    $destination = "../books/".$id.".pdf";
                    rename($source, $destination);
                }
            }
        }
        else {
            if ( $_FILES['book']['type'] != "application/pdf") {
                echo("<script>alert('Only upload books in PDF format');</script>");
            }
        }
    }


    elseif($_SESSION['role'] == 'Reader'){
        if ($_FILES['book']['type'] == "application/pdf") {
            $source_file = $_FILES['book']['tmp_name'];
            $dest_file = "../books/donated/".$_POST['book_title'].".pdf";

            if (file_exists($dest_file)) {
                echo("<script>alert('Someone has already donated this book.');</script>");
            }
            else {
                //move pdf to donated folder
                move_uploaded_file( $source_file, $dest_file )
                or die ("Error!!");
                if($_FILES['book']['error'] == 0) {
                    //update the db
                    $donate_id = $database_connection->donateABook($_POST['donor'], $_POST['book_isbn'],$_POST['book_title'], 
                                            $_POST['book_author'], $_POST['book_year'], $_POST['book_catagory']);
                    //rename the pdf with doation id
                    rename("../books/donated/".$_POST['book_title'].".pdf","../books/donated/".$donate_id.".pdf");

                    echo("<script>alert('Your donation was sent for approval.');</script>");
                }
            }
        }
        else {
            if ( $_FILES['book']['type'] != "application/pdf") {
                echo("<script>alert('Only upload books in PDF format');</script>");
            }
        }
    }

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
    
    <h3><?php echo ($_SESSION['role'] === 'Reader') ? "Donate" : "Add"; ?> a Book</h3>
    <div class="container">
        <br><br><br>
    <form action="add_book.php" method="post" enctype="multipart/form-data">
        

            <div class="form-group">
                <label for="book_title">Title :</label>
                <input type="text" class="form-control" name="book_title" placeholder="Book Title" required />
            </div>

            <div class="form-group">
                <label for="book_author">Author :</label>
                <input type="text" class="form-control" name="book_author" placeholder="Author" required />
            </div>

            <div class="form-group">
                <label for="book_year">Year :</label>
                <input type="integer" class="form-control" name="book_year" placeholder="Year" required />
            </div>

            <div class="form-group">
                <label for="book_isbn">ISBN :</label>          
                <input type="text" class="form-control" name="book_isbn" placeholder="ISBN" required />
            </div>

            <div class="form-group">
                <label for="book_catagory">catagory :</label>          
                <input type="text" class="form-control" name="book_catagory"  placeholder="catagory" required  />
            </div>

            <div class="form-group">
                <label for="book">Book :</label>  
                <input type="file" class="form-control" name="book"  placeholder="book-temp"  required />
            </div>

            <input type="hidden" name="donor" value= <?php echo $user?> >

            <input type="submit" name="Donate" value=<?php echo ($_SESSION['role'] === 'Reader') ? "Donate" : "Add"; ?>>
            <input type="button" value="Back" onclick="history.back()">

    </form>

    </div>
    </div>
    </div>
    </div>
</body>
</html>