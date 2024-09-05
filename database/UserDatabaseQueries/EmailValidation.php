<?php
require_once(__DIR__.'/../database.php');

class EmailValidation{
    private $db;

    public function __construct() {
        $database = new Database;
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
}