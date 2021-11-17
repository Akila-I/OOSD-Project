
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Register New User Form</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>


<?php
$msg ="";
if(!empty($_REQUEST['msg'])){
    $msg='*'.$_REQUEST['msg'];
 }
?>

<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Register</h3>
                    <form action="servers/register_server.php" method="get">
                    <Label style="color:red"><?php echo $msg?></label>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_fname" placeholder="First Name" value="" required/>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_lname" placeholder="Last Name" value="" required/>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_username" placeholder="Userame" value="" required/>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_email" placeholder="Email" value="" required/>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="register_pasword"  placeholder="Your Password *" value="" required />
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="register_pasword_confirm"  placeholder="Confirm Your Password *" value="" required />
                        </div>

                        <div class="form-group">
                            <select name="register_role" class="form-control" required>
                                <option value="Default" disabled selected hidden>Select Your Role</option>
                                <option value="Reader">Reader</option>
                                <option value="Librarian">Librarian</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Register" />
                            <a href="index.php"><input type="button"value="Back" /></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        



        <script src="" async defer></script>
    </body>
</html>