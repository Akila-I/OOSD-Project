<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Virtual Library - Edit Account</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
    <?php require "top_menu_bar.php"; ?>


<?php
session_start();
require "classes/database_class.php";
$database_connection = new database();

$userID = $_SESSION['userID'];
$user_data = $database_connection->getUserDetails($_SESSION['username']);

$msg="";
if(!empty($_REQUEST['msg'])){
    $msg='*'.$_REQUEST['msg'];
 }
?>

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Edit Account Information</h3>
                    <form action="servers/edit_acc_server.php" method="get">
                    <Label style="color:red"><?php echo $msg?></label>

                        <div class="form-group">
                            <label for="fname">Frist Name</label>
                            <input type="text" class="form-control" name="edit_fname" value=<?php echo $user_data['f_name'];?> required/>
                        </div>

                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="text" class="form-control" name="edit_lname" value=<?php echo $user_data['l_name'];?> required/>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="edit_username" value=<?php echo $user_data['username'];?> required/>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="edit_email" value=<?php echo $user_data['email'];?> required/>
                        </div>

                        <div class="form-group">
                            <label for="pw">Password</label>
                            <input type="password" class="form-control" name="edit_pasword"  value=<?php echo $user_data['email'];?> required />
                        </div>

                        <div class="form-group">
                            <label for="conf_pw">Confirm Password</label>
                            <input type="password" class="form-control" name="edit_pasword_confirm"  value=<?php echo $user_data['email'];?> required />
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Save" />
                            <a href="acc_view.php"><input type="button"value="Back" /></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        



        <script src="" async defer></script>
    </body>
</html>