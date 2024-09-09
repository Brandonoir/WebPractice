<?php
//routes the form from views to the class methods needed
require('database/database.php');
require('controllers/AuthenticationController.php');
require('controllers/BlogPostController.php');
require('controllers/register.php');
require('controllers/login.php');
require('controllers/BlogValidation.php');
require('models/user.model.php');
require('models/post.model.php');

$database = new Database;
$userDb = new UserDb($database);

 $authController = new AuthenticationCtrlr($userDb, $database);
 $postController = new BlogPostController;
// $validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "create_post"){
    $postController->composeBlog($_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "register_user"){
    $authController->register($_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "login_user"){
    $authController->login($_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "logout"){
    $authController->logout($_POST);
}


session_start();
$sessionData = $_SESSION;

if(empty($sessionData)){
    header('Location: views/login.view.php');
    exit();
}