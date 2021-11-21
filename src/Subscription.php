<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Subscription</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    </head>

    <body>

        <?php
            session_start();

            if($_SESSION['userID']===null){
                header("Location: index.php?msg=Please Login First");
            }
            require "classes/database_class.php";

            $database_connection = new database();

            $user_data = $database_connection->getUserDetails($_SESSION['username']);
            $msg ="";
            if(!empty($_REQUEST['msg'])){
                $msg=$_REQUEST['msg'];
                echo $msg;
            }
        ?>

        <h1>Subscription Form </h1>
        <div>
            <h2>User Details</h2>
            <form action="servers/Subscription_server.php" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username"  value=<?php echo $user_data['username'];?> readonly /><br>
                <label for="email">Email</label>
                <input type="email" name="email" value=<?php echo $user_data['email'];?> readonly /><br>
                <label for="cardnum">Card Number</label>
                <input type="text" name="cardnum"  placeholder="Card Number (required)" required /><br>
                <label for="exp">Expire Date</label>
                <input type="text" name="exp_month" placeholder="mm"/> /
                <input type="text" name="exp_year" placeholder="yyyy"/><br>
                <label for="cvv">CVV</label>
                <input type="text" name="cvv"  placeholder="CVV (required)" required /><br>    
                <input type="submit" class="btnSubmit" value="Subscribe"/><br>
                <a href="acc_view.php"><input type="button"value="Back" /></a>
            </form>
            <script src="" async defer></script>
    </body>
</html>