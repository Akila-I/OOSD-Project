<?php
class database{
    //singleton
    protected $pdo;

    function connect(){
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=Library', 'phpmyadmin', 'phpmyadmin');
    }
}