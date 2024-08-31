<?php
require('database.php');

class UserDb {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    //User Registration methods
    public function isEmailUnique($email) {
        try {
            // check if the email already exists
            $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':email', $email);
            $statement->execute();

            // Fetch the count of users with the email
            $count = $statement->fetchColumn();
            $statement->closeCursor(); 

            // Return true if no users found
            return $count == 0;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function createUser($email, $password) {
        try {
            $sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
            // Prepare and bind the parameters
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);

            // Execute statement
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function checkUsersTableExists() {
        try {
            // check if the 'users' table exists
            $sql = "SELECT COUNT(*) FROM information_schema.tables 
                    WHERE table_schema = DATABASE() AND table_name = 'users'";
            $statement = $this->db->query($sql);
            $count = $statement->fetchColumn();

            // Return true if the table exists
            return $count > 0;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function createUsersTable() {
        try {
            // create the 'users' table
            $sql = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $this->db->exec($sql);
            echo "Users table created successfully.";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    //User Login methods
    public function authenticateUser($email, $password) {
        try {
            //find the user by email
            $sql = 'SELECT password FROM users WHERE email = :email';
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':email', $email);
            $statement->execute();

            // Fetch the user's hashed password
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor(); // Free up resources

            if ($result) {
                // verify password
                if (password_verify($password, $result['password'])) {
                    // Authentication successful
                    return true;
                } else {
                    // Invcorrect password
                    return false;
                }
            } else {
                // No email matched from the database
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}
?>
