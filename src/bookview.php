<?php
session_start();
if($_SESSION['userID']===null){
    header("Location: index.php?msg=Please Login First");
}

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

$bookID = $_GET['id'];
$_SESSION['bookID'] = $bookID;
?>

<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
    <title>Virtual Library - View</title>  <!--button value -->
        <style type="text/css">
            #myiframe {
                width: 90%;
                height: 95%;
                margin-left: 5%;
            }
        </style>
    </head>
    <body>
    <?php require "top_menu_bar.php";
    require "search_button.php";
    ?>

        <div style="margin-left: 5%;">
        <input type="button" value="Back" onclick="history.back()">
        <?php
        if($_GET['d'] != 1){
            echo('<form action="servers/bookview_server.php" method="post">');
            echo(' <input type="submit" name="AddToFav" class="button" value="Add to Favourites" />');
            echo('<input type="submit" name="ReadLater" class="button" value="Add to Reading List" />');
            echo('<input type="submit" name="FinishReading" class="button" value="Add to Finished List" />');
            echo('</form>');
        } 
        ?>

        </div>
        <div id="scroller">
            <iframe name="myiframe" id="myiframe" src=<?php echo($_GET['d'] == 1)? "../books/donated/$bookID.pdf" : "../books/$bookID.pdf";?>></iframe>
        </div>
    </body>
</html>
