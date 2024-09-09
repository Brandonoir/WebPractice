<?php

interface IAuthUser {
    public function authenticateUser($email, $password);
    public function getAuthErrors();
}