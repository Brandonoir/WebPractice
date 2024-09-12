<?php
require_once('iAuthValidation.php');

class AuthValidation implements AuthValidationInterface {
private $errors = [];

    public function validate(array $authData): bool{
        //validate inputs
        $email = isset($authData['email']) ? filter_var($authData['email'], FILTER_VALIDATE_EMAIL) : null;
        $password = isset($authData['password']) ? $authData['password'] : '';

        if (!$email) {
            $this->errors[] = "Invalid email address.";
        }

        if (empty($password)) {
            $this->errors[] = "Invalid password.";
        }

        return empty($this->errors);
    }
    //get Login errors
    public function getValidateErrors() {
        return $this->errors;
    }
}