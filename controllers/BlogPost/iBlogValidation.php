<?php

interface IBlogValidation {
    function validateForm($title, $body);
    public function validatedTitle();
    public function validatedBody();
    public function getErrors();
}