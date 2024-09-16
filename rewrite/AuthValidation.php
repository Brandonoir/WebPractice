<?php
require_once('iAuthValidation.php');

class AuthValidation implements AuthValidationInterface {
    private $errors = [];

    public function validate(array $authData): bool {
        $email = $authData['email'];
        $password = $authData['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Invalid email address.";
        }

        if (empty($password)) {
            $this->errors[] = "Invalid password.";
        }

        // Additional password validation rules could go here

        return empty($this->errors);
    }

    public function getValidateErrors() {
        return $this->errors;
    }
}