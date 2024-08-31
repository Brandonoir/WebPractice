<?php
require('../database/user_db.php');

class RegisterUser {
    private $userDb;

    public function __construct(UserDb $userDb) {
        $this->userDb = $userDb;
    }

    public function isEmailUnique($email) {
        return $this->userDb->isEmailUnique($email);
    }

    public function createUser($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->userDb->createUser($email, $hashedPassword);
    }
}

// Create an instance of UserDb
$database = new UserDb();

// Check if the users table exists, if not, create it
if (!$database->checkUsersTableExists()) {
    $database->createUsersTable();
}

// Create an instance of RegisterUser, passing the UserDb instance
$userRegistration = new RegisterUser($database);

// user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the values from the form
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate the inputs
    if ($email && !empty($password)) {
        // Check if the email is unique
        if ($userRegistration->isEmailUnique($email)) {
            // Create the user
            $userRegistration->createUser($email, $password); 
            echo "Registration successful!";
        } else {
            echo "Email must be unique. Please use a different email.";
        }
    } else {
        echo "Please fill in all fields correctly.";
    }
}
?>
