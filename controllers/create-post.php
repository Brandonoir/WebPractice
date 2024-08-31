<?php
require('../database/post_db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //get values from form
    $post_title = htmlspecialchars($_POST['post_title']);
    $post_body = htmlspecialchars($_POST['post_body']);

    //validate the values
    if(!empty($post_title) && !empty($post_body)){
        $postDb = new PostDb();
        $postDb->createPost($post_title, $post_body);
        echo 'post created succesfully!';
    } else {
        echo "Please do not leave empty fields.";
    }
}