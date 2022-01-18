<?php

class Subscription{

    private $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public  function Activate(){

        $this->state = new ActiveState();

    }

    public function getState()
    {
        return $this->state->getSubs();
    }


}

abstract class SubscriptionState{

    protected $subscription;

    public function getSubs()
    {
        return $this->subscription;
    }


}

class ActiveState extends SubscriptionState{

    

    private static $instance;

    private function __construct() {

      $this->subscription = 'Active';  

    }

    public static function getStatus()
    {
    if ( self::$instance == null)
    {
        self::$instance = new ActiveState();
    }

    return self::$instance;
    }

    
 


} 

class InactiveState extends SubscriptionState{

    private static $instance;

    private function __construct() {

      $this->subscription = 'Unsubscribed';  

    }

    public static function getStatus()
    {
    if ( self::$instance == null)
    {
        self::$instance = new InactiveState();
    }

    return self::$instance;
    }


}

