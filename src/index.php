
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Virutal Library - Login</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>

<?php
session_start();
$msg="";
if(!empty($_REQUEST['msg'])){
    $msg='*'.$_REQUEST['msg'];
 }

 ?>



<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                    <form action="servers/login_server.php" method="get">
                    <Label style="color:red"><?php echo $msg?></label><br>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" name="login_username" placeholder="Your Username *" value="" required/>
                        </div>
                        
                        <div class="form-group">
                            <input type="password" class="form-control" name="login_pasword"  placeholder="Your Password *" value="" required/>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>

                        <div class="form-group">
                            <a href="register.php" class="Register" value="Login">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        



        <script src="" async defer></script>
    </body>
</html>