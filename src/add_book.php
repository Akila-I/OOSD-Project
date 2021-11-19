<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
</head>
<body>
    <div class="container">
        
    <form action="" method="post">
    <div class="container login-container">
        <div class="row">
        <div class="col-md-6 login-form-1">
        <h3>Donate a Book</h3>
        <form action="servers/add_book_server.php" method="get">
            <div class="form-group">
                <input type="text" class="form-control" name="book_title" placeholder="Book Title" value="" required/>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="book_author" placeholder="Author" value="" required/>
            </div>

            <div class="form-group">
                <input type="date" class="form-control" name="year" placeholder="Year" value="" required/>
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
                            <a href="homepage.php"><input type="button"value="Back" /></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </form>

    </div>
</body>
</html>