<?php
//post related functions

class BlogPostController{
    private $validate;
    private $postModel;
    private $postTable;
    private $title;
    private $body;
    private $errors=[];

    public function __construct(IBlogValidation $validation,
                                PostModelInterace $postModel,
                                PostTableInterface $postTable){
        $this->validate = $validation;
        $this->postModel = $postModel;
        $this->postTable = $postTable;
    }

    //create post function
    public function composeBlog(){
        
        //get values from form
        $post_title = htmlspecialchars($_POST['post_title']);
        $post_body = htmlspecialchars($_POST['post_body']);
        echo  $post_title.$post_body;

        
        //validate values from form
        $isValid = $this->validate->validateForm($post_title, $post_body);
        if(!$isValid){
            $this->errors[] = $this->validate->getErrors();
        } else {
            if(!$this->postTable->checkPostTableExists()){
                $this->postTable->createPostTable();
                echo "post table created!";
            }

            $this->title = $this->validate->validatedTitle();
            $this->body = $this->validate->validatedBody();

            //upload data to the database
            $this->postModel->createPost($this->title, $this->body);

            //redirect to home
            header('Location: views/home.view.php');
            exit();
        }
        print_r($this->errors);
    }

    //edit post function
    //delete post function
}