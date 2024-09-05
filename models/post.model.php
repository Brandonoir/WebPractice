<?php
require_once(__DIR__.'/../database/database.php');

class PostDb {
    private $db;

    public function __construct() {
        $database = new Database;
        $this->db = $database->getConnection();
    }

    public function createPost($post_title, $post_body){
        try{
            $sql = 'INSERT INTO posts (post_title, post_body) VALUES(:title, :body)';
            $statement = $this->db->prepare($sql);
            $statement -> bindValue(':title', $post_title);
            $statement -> bindValue(':body', $post_body);
            $statement -> execute();
            $statement -> closeCursor();

        } catch(PDOException $e) {
            echo 'Error '. $e->getMessage();
        }
    }

    public function displayPost(){
        try{
            $sql = 'SELECT * FROM posts';
            $statement = $this->db->prepare($sql);
            $statement->execute();

            $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            return $posts;
        }catch(PDOException $e){
            echo 'Error '. $e->getMessage();
            return [];
        }
    }
}