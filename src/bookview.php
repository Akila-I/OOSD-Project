<?php

$bookID = $_GET['id'];

?>

<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/all_body.css">
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

        <div id="scroller">
            <iframe name="myiframe" id="myiframe" src="../books/<?php echo$bookID;?>.pdf"></iframe>
        </div>
    </body>
</html>
