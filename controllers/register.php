<?php
require_once(__DIR__.'/UserDatabaseQueries/EmailValidation.php');

class RegisterUser {
    private $userDb;
    private $validateEmail;
    private $errors = [];

    public function __construct(UserModelInterface $userDb) {
        $this->userDb = $userDb; // Database connection
    }

    public function validateFields(array $postData) {
        $email = isset($postData['email']) ? filter_var($postData['email'], FILTER_VALIDATE_EMAIL) : null;
        $password = isset($postData['password']) ? $postData['password'] : '';

        if (!$email) {
            $this->errors[] = "Invalid email address.";
        }

        if (empty($password)) {
            $this->errors[] = "Invalid password.";
        }

        $this->validateEmail = new EmailValidation;
        if (empty($this->errors) && !$this->validateEmail->isEmailUnique($email)) {
            $this->errors[] = "Email must be unique. Please use a different email.";
        }

        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}
?>
