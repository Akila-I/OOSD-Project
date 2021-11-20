<?php
session_start();
if($_SESSION['userID']===null){
    header("Location: index.php?msg=Please Login First");
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
    <?php require "top_menu_bar.php"; ?>
        <div style="margin-left: 5%;">
            <form action="servers/bookview_server.php" method="post">
            <input type="button" value="Back" onclick="history.back()">

            <input type="submit" name="AddToFav" class="button" value="Add to Favourites" />
            
            <input type="submit" name="ReadLater" class="button" value="Read Later" />

            <input type="submit" name="FinishReading" class="button" value="Finish Reading" />

            </form>

        </div>
        <div id="scroller">
            <iframe name="myiframe" id="myiframe" src="../books/<?php echo$bookID;?>.pdf"></iframe>
        </div>
    </body>
</html>
