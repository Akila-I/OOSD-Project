<?php
session_start();
require "classes/database_class.php";
$database_connection = new database();

$userID = $_SESSION['userID'];
$user_data = $database_connection->getUserDetails($_SESSION['username']);

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Virtual Library - View Account</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
    <?php require "top_menu_bar.php"; ?>

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>User Information</h3>
                    <form action="none">

                    <div class="form-group">
                            <label for="fname">Frist Name</label>
                            <input type="text" class="form-control" name="edit_fname" value=<?php echo $user_data['f_name'];?> readonly/>
                        </div>

                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" name="edit_lname" value=<?php echo $user_data['l_name'];?> readonly/>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="edit_username" value=<?php echo $user_data['username'];?> readonly/>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="edit_email" value=<?php echo $user_data['email'];?> readonly/>
                        </div>

                        <div class="form-group">
                            <label for="subs_stt">Subscription Status</label>
                            <input type="text" class="form-control" name="edit_username" value=<?php echo "Subs_Status";?> readonly/>
                        </div>

                        <div class="form-group">
                            <label for="subs_date">Date of Subscription</label>
                            <input type="text" class="form-control" name="edit_email" value=<?php echo "Subs_Date";?> readonly/>
                        </div>

                        <div class="form-group">
                        <a href="acc_edit.php"><input type="button" value="Edit Details"></a>
                        <a href=""><input type="button" value="Cancel subscription"></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="" async defer></script>
    </body>
</html>