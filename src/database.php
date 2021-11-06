<?php

require_once __DIR__ . "/pdo.php";

//returns the password of a given username, false if user not found
function getUserPW($username){
    global $pdo;

    $sql = "SELECT password FROM Users
    WHERE username = :un";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':un' => $username
    ));
    $db_password = $statement->fetch(PDO::FETCH_ASSOC);

    return $db_password;
}

