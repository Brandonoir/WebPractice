<?php
require_once(__DIR__.'/UserDatabaseQueries/AuthUser.php');

class LoginUser {
    private $userDb;
    private $authUser;
    private $errors = []; 

    public function __construct(UserDb $userDb) {
        $this->userDb = $userDb;
    }

    //validate login credentials
    public function validateLogin(array $loginCreds) {
        
        // Retrieve the input values from the form
        $email = isset($loginCreds['email']) ? filter_var($loginCreds['email'], FILTER_VALIDATE_EMAIL) : null;
        $password = isset($loginCreds['password']) ? $loginCreds['password'] : '';

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



