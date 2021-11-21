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
</head>

    <body>
    <?php
        session_start();
            $msg="";
        if(!empty($_REQUEST['msg'])){
            $msg = $_REQUEST['msg'];
            echo $msg;
        }

    ?>
    <?php require "top_menu_bar.php"; ?>
    

        <h1>Dashboard </h1> 

        <form>
            Search:<input type="text" value=""><br>
        </form>

        <div>
            <a href="lists.php?type=0"> BookList</a>
        </div>

        <div>
            <a href="lists.php?type=3"> Favourite List</a>
        </div>

        <div>
            <a href="lists.php?type=2"> ReadingList</a>
        </div>

        <div>
            <a href="lists.php?type=1"> Finished List</a>
        </div>
          
        <!-- <a href=""><img src="f1.png" width="100" height="100"> </a>   --> <!-- Account -->
        <a href="add_book.php"> Donate a Book </a> <!-- Buy -->
    </body>
</html>