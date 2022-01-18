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
            require "top_menu_bar.php"; 

            $database_connection = database::getInstance();

            $user_data = $database_connection->getUserDetails($_SESSION['username']);
            $msg ="";
            if(!empty($_REQUEST['msg'])){
                $msg=$_REQUEST['msg'];
                echo $msg;
            }
        ?>
        <div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>User Details</h3>
                    <form action="servers/Subscription_server.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username"  value=<?php echo $user_data['username'];?> readonly />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value=<?php echo $user_data['email'];?> readonly />
                    </div>

                    <div class="form-group">    
                        <label for="cardnum">Card Number</label>
                        <input type="text" class="form-control" name="cardnum" maxlength="16" placeholder="Card Number (required)" required />
                    </div>

                    <div class="form-group">    
                        <label for="exp">Expire Date</label>
                        <input type="text" class="form-control" name="exp_month" placeholder="mm"/>
                        <input type="text" class="form-control" name="exp_year" placeholder="yyyy"/>
                    </div>

                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" name="cvv" maxlength="3" placeholder="CVV (required)" required /><br>    
                    </div>

                    <div class="form-group">    
                        <input type="submit" class="btnSubmit" value="Subscribe"/>
                        <a href="acc_view.php"><input type="button" value="Back" /></a>
                    </div>
                    
                    </form>

                </div>
            </div>
        </div>            
                    <script src="" async defer></script>
    </body>
</html>