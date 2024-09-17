<?php

interface AuthUserInterface {
    public function authenticateUser($email, $password);
    public function getAuthErrors();
}