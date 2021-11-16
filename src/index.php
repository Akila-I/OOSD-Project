
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login Form</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body>

<?php
require_once "classes/user_class.php";
session_start();
 $unamemsg="";
 $pwmsg="";
 $msg="";

 $adunamemsg="";
 $adpwmsg="";

 $session_var = "no session";

 if(!empty($_SESSION['userID'])){
     $session_var = $_SESSION['userID'];
 }

 if(!empty($_REQUEST['adunamemsg'])){
    $adunamemsg=$_REQUEST['adunamemsg'];
 }

 if(!empty($_REQUEST['adpwmsg'])){
    $adpwmsg=$_REQUEST['adpwmsg'];
 }

 if(!empty($_REQUEST['unamemsg'])){
    $unamemsg=$_REQUEST['unamemsg'];
 }

 if(!empty($_REQUEST['pwmsg'])){
  $pwmsg=$_REQUEST['pwmsg'];
}

if(!empty($_REQUEST['msg'])){
    $msg=$_REQUEST['msg'];
 }

 ?>



<div class="container login-container">
<div class="row"><h4><?php echo $msg?></h4></div>
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login</h3>
                    <form action="servers/login_server.php" method="get">
                    <Label style="color:red">*<?php echo "session". $session_var?></label>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" name="login_username" placeholder="Your Email *" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $unamemsg?></label>
                        <div class="form-group">
                            <input type="password" class="form-control" name="login_pasword"  placeholder="Your Password *" value="" />
                        </div>
                        <Label style="color:red">*<?php echo $pwmsg?></label>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">

                            <a href="#" class="ForgetPwd" value="Login">Forget Password?</a><br>
                            <a href="register.php" class="Register" value="Login">Register New User</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        



        <script src="" async defer></script>
    </body>
</html>