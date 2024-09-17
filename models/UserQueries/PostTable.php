<?php
require_once('iPostTable.php');

class PostTable implements PostTableInterface{
    private $db;

    public function __construct(DatabaseInterface $database){
        $this->db = $database->getConnection();
    }

    //checks if posts table exixts
    public function checkPostTableExists() {
        try {
            // check if the 'posts' table exists
            $sql = "SELECT COUNT(*) FROM information_schema.tables 
                    WHERE table_schema = DATABASE() AND table_name = 'posts'";
            $statement = $this->db->query($sql);
            $count = $statement->fetchColumn();

            // Return true if the table exists
            return $count > 0;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function createPostTable() {
        try {
            // create the 'posts' table
            $sql = "CREATE TABLE posts (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                body VARCHAR(255) NOT NULL,
                author_id INT,
                FOREIGN KEY (author_id) REFERENCES users(id),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
            $this->db->exec($sql);
            echo "Posts table created successfully.";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}