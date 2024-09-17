<?php
require_once('iBlogValidation.php');

class Validation implements IBlogValidation{
    private $validTitle;
    private $validBody;
    private $errors=[];

    function validateForm($title, $body){
        //validate the values
        if(empty($title)){
            $this->errors[] = 'Invalid Title: Title cannot be empty';
        } else {
            $this->validTitle = filter_var($title, FILTER_SANITIZE_STRING);
        }
        if(empty($body)){
            $this->errors[] = 'Invalid Body: Body cannot be empty';
        } else {
            $this->validBody = filter_var($body, FILTER_SANITIZE_STRING);
        }
        return empty($this->errors);
    }

    public function validatedTitle() {
        return $this->validTitle;
    }
    
    public function validatedBody() {
        return $this->validBody;
    }

    public function getErrors() {
        return $this->errors;
    }
}