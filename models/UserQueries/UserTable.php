<?php
require_once('iUserTable.php');

class UserTable implements IUserTable {
    private $db;

    public function __construct(DatabaseInterface $database){
        $this->db = $database->getConnection();
    }


    //checks if users table exixts
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
}