<?php

class ValidateAuth {
    private $errors = [];


    public function validateLogin(array $data) {
        
        // Retrieve the input values from the form
        $email = isset($data['email']) ? filter_var($data['email'], FILTER_VALIDATE_EMAIL) : null;
        $password = isset($data['password']) ? $datas['password'] : '';

        // Validate the inputs
        if (!$email) {
            $this->errors[] = "Invalid email";
        }
        
        if(empty($password)){
            $this->errors[] = "Invalid password";
        }

        // Authenticate
        $this->authUser = new AuthUser;
        if(empty($this->errors) && !$this->authUser->authenticateUser($email, $password)){
            $this->errors[] = $this->authUser->getAuthErrors();
        }

        return empty($this->errors);
    }
    //get Login errors
    public function getErrors() {
        return $this->errors;
    }
}