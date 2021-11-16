<?php

$bookID = $_GET['id'];

?>

<html>
    <head>
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
