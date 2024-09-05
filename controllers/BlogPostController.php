<?php
//post related functions

class BlogPostController{
    //create post function
    public function composeBlog(){
        //get values from form
        $post_title = htmlspecialchars($_POST['post_title']);
        $post_body = htmlspecialchars($_POST['post_body']);
        
        //validate values from form
        $validation = new Validation;
        $isValid = $validation->validateForm($post_title, $post_body);
        if(!$isValid){
            echo 'Fill in all fields';
        } else {
            //upload data to the database
            $postModel = new PostDb;
            $postModel->createPost($post_title, $post_body);

            //redirect to home
            header('Location: views/home.view.php');
            exit();
        }
    }

    //edit post function
    //delete post function
}