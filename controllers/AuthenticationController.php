<?php
require_once(__DIR__.'/UserDatabaseQueries/UserTable.php');
require_once(__DIR__.'/InitiateSession.php');

class AuthenticationCtrlr{
    private $db;
    private $userDb;
    private $userTable;

    public function __construct(UserModelInterface $userDb, DatabaseInterface $database) {
        $this->userDb = $userDb;
        $this->db = $database;
    }

    //register
    public function register() {
        $this->userTable = new UserTable($this->db);

        // Check if the users table exists, if not, create it
        if (!$this->userTable->checkUsersTableExists()) {
            $this->userTable->createUsersTable();
        }
    
        $registerUser = new RegisterUser($this->userDb);
        $postData = $_POST;
    
        if ($registerUser->validateFields($postData)) {
            // Create the user
            $hashedPassword = password_hash($postData['password'], PASSWORD_BCRYPT); // hash password
            $this->userDb->createUser($postData['email'], $hashedPassword);
            echo "Registration successful!";
        } else {
            echo "Invalid input: ";
            foreach($registerUser->getErrors() as $errors){
                echo $errors."<br>"; //display errors
            }
        }
    }

    //login
    public function login(){
        //strictly login functions

        $loginUser = new LoginUser($this->userDb);
        $postData = $_POST;

        if($loginUser->validateLogin($postData)){
            $session = new Session;
            $session->initiateSession($postData['email']);
            header('Location: views/home.view.php');
            exit();
        } else {
            echo "Invalid input: ";
            print_r($loginUser->getErrors());//get errors
        }
    }

    //logout
    public function logout(){
        session_destroy();
        setcookie(session_name(), '', time() - 3600, '/');
        header('Location: views/login.view.php');
        exit();
    }
}