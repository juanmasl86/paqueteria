<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 25/09/2019
 * Time: 10:14
 */

class UserSession {

    public function __construct()
    {
        session_start();
    }

    public function setCurrentUser($user){
        $_SESSION['user'] = $user;
    }

    public function getCurrentUser(){
        return $_SESSION['user'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}

?>