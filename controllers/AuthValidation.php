<?php
require_once('iAuthValidation.php');

class AuthValidation implements AuthValidationInterface {
    private $errors = [];

    public function validate(array $authData): bool {
        $email = isset($authData['email']) ? $authData['email'] : null;
        $password = isset($authData['password']) ? $authData['password'] : '';

        if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
            $this->errors[] = "Invalid email address.";
        }

        if (empty($password)) {
            $this->errors[] = "Invalid password.";
        }

        return empty($this->errors);
    }

    public function getValidateErrors() {
        return $this->errors;
    }
}