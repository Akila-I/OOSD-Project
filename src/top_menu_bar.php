<?php
//session_start();
$role = $_SESSION['role'];
?>

<style>
    /* Add a black background color to the top navigation */
    .topnav {
    background-color: #190061;
    overflow: hidden;
    
    }

    /* Style the links inside the navigation bar */
    .topnav a {
    float: right;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    }

    
</style>

<div class="topnav">
    <a href="servers/logout_server.php">Logout</a>
    <a href="acc_view.php">My Profile</a>
    <?php
        if($role === 'Reader'){
            echo('<a href="request.php">Request a Book</a>');
            echo('<a href="add_book.php">Donate a Book</a>');
        }
        elseif($role === 'Librarian'){
            echo('<a href="req_list.php">Requests</a>');
            echo('<a href="lists.php?type=5">Approve Donations</a>');
            echo('<a href="add_book.php">Add a Book</a>');
        }
    ?>
    
    <a href="homepage.php">Home</a>

</div>