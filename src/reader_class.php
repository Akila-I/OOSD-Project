<?php

class reader extends user{
    private $subscription;

    function __construct($username, $password)
    {
        $this->database_connection = new database();
        $this->username = $username;
        $this->password = $password;
    }
    
    function subscribe(){}

    function cancelSubscription(){}

    function requestBook(){}

}