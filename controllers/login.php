<?php
require('../database/user_db.php');

class LoginUser {
    private $userDb; // Database connection 'placeholder'

    public function __construct(UserDb $userDb) {
        $this->userDb = $userDb;
    }

    // Method to authenticate user
    public function authenticateUser($email, $password) {
        return $this->userDb->authenticateUser($email, $password);
    }
}

// Initialize UserDb class
$database = new UserDb(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the input values from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate the inputs
    if ($email && !empty($password)) {
        // Pass the UserDb instance to LoginUser
        $loginUser = new LoginUser($database); 
        // Authenticate
        $isAuthenticated = $loginUser->authenticateUser($email, $password); 

        //echo $isAuthenticated ?  "Login successful!" :  "Invalid email or password. Please try again.";

        if($isAuthenticated){
            header('Location:../views/home-view.php');
            exit;
        } else{
            echo "Invalid email or password. Please try again.";
        }

    } else {
        echo "Please fill in all fields correctly.";
    }
}

