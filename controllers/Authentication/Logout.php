<?php

class LogoutUser {
    //logout
    public function logoutUser(){
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        header('Location: views/login.view.php');
        exit();
    }
}