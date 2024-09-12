<?php
 require_once('iInitiateSession.php');

 class Session implements InitSessionInterface{
    
    public function initiateSession($email){
        if(isset($_SESSION['email'])){
            session_destroy();
        }

        session_start();

        session_regenerate_id(true);

        $_SESSION['email'] = $email;
        $_SESSION['token'] = bin2hex(random_bytes(32));

        // Set secure session settings
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', 1);
    }
 }