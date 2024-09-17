<?php
require_once('iPostModel.php');

class PostDb implements PostModelInterace{
    private $db;
    private $email;

    public function __construct(DatabaseInterface $database) {
        $this->db = $database->getConnection();
        session_start();
        $this->email = $_SESSION['email'];
    }

    public function createPost($post_title, $post_body){
        try{
            $sql = 'SELECT id FROM users WHERE email = :email';
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':email', $this->email);
            $statement->execute();
            $result = $statement->fetch();
            $uid = $result['id'];
            $statement->closeCursor();

            $sql = 'INSERT INTO posts (title, body, author_id) VALUES(:title, :body, :uid)';
            $statement = $this->db->prepare($sql);
            $statement -> bindValue(':title', $post_title);
            $statement -> bindValue(':body', $post_body);
            $statement -> bindValue(':uid', $uid);
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