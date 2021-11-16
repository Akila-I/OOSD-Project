<?php

class database{
    //singleton
    protected $pdo;

    function __construct()
    {
        $this->connect();
    }
    private function connect(){
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=Library', 'phpmyadmin', 'phpmyadmin');
    }

    function validateUser($username, $password){

        $sql = "SELECT password FROM Users WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_password = $statement->fetch(PDO::FETCH_ASSOC);

        if ($db_password === false){
            $msg = "Incorrect Username";
        }
        else if ($db_password['password'] !== $password){
            $msg = "Incorrect Password";
        }
        else{
            $msg = true;
        }
        return $msg;
    }
    
    function getUserDetails($username){
        $sql = "SELECT * FROM Users
        WHERE username = :un";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':un' => $username
        ));

        $db_details = $statement->fetch(PDO::FETCH_ASSOC);

        return $db_details;
    }

}