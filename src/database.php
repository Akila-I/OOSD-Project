<?php

require_once __DIR__ . "/pdo.php";

function login($username, $password){

    global $pdo;

    $sql = "SELECT password FROM Users
    WHERE username = :un";

    $statement = $pdo->prepare($sql);
    $statement->execute(array(
        ':un' => $username
    ));
    $db_password = $statement->fetch(PDO::FETCH_ASSOC);

    if ($db_password === false){
        $result = false;
    }else{
        $result = $db_password['password'] === $password; // hash salt whatever
    }

    return $result;
}

echo login("akilag","123")."\n";