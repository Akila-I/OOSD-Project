
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

?>

<div class="container login-container">
<div class="row"><h4><?php echo $msg?></h4></div>
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Register</h3>
                    <form action="servers/register_server.php" method="get">                        
                        <div class="form-group">
                            <input type="text" class="form-control" name="register_fname" placeholder="First Name" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $unamemsg?></label>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_lname" placeholder="Last Name" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $unamemsg?></label>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_username" placeholder="Userame" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $unamemsg?></label>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_email" placeholder="Email" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $unamemsg?></label>

                        <div class="form-group">
                            <input type="password" class="form-control" name="login_pasword"  placeholder="Your Password *" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $pwmsg?></label>

                        <div class="form-group">
                            <input type="text" class="form-control" name="register_role" placeholder="Role" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $unamemsg?></label>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Register" />
                        </div>
                    </form>
                </div>
            </div>
        </div>



        



        <script src="" async defer></script>
    </body>
</html>