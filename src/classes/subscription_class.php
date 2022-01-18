<?php
require_once "user_class.php";

class Subscription{

    private SubscriptionState $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public  function Activate(){

        $this->state = ActiveState::getStatus();

    }

    public  function Deactivate(){

        $this->state = InactiveState::getStatus();;

    }

    public function getState()
    {
        return $this->state->getSubs();
    }

    static function notifyUser($userID){
        $user = new User($userID);
        $user->update();
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

