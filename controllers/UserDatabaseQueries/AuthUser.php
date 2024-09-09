<?php
// require_once(__DIR__.'/../../database/database.php');
require_once('iAuthUser.php');

class AuthUser implements IAuthUser{
    private $db;
    private $authErrors=[];

    public function __construct(DatabaseInterface $database) {
        $this->db = $database->getConnection();
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
                        $this->authErrors[] = "Wrong password!";
                    }
                } else {
                    // No email matched from the database
                    $this->authErrors[] = "Wrong email adress";
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
                return false;
            }
        }
    
        public function getAuthErrors(){
            return $this->authErrors;
        }
}