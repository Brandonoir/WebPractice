<?php
require_once(__DIR__.'/../database/database.php');

class UserDb {
    private $db;

    public function __construct() {
        $database = new Database;
        $this->db = $database->getConnection();
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
}
?>
