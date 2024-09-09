<?php
require_once('iUserModel.php');

class UserDb implements UserModelInterface{
    private $db;

    public function __construct(DatabaseInterface $database) {
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
