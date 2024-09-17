<?php

//routes the form from views to the class methods needed
require('database/database.php');
require('controllers/BlogPost/BlogPostController.php');
require('controllers/BlogPost/BlogValidation.php');
require_once('controllers/InitiateSession.php');
require_once('models/UserQueries/AuthUser.php');
require_once('models/UserQueries/EmailVerify.php');
require_once('models/UserQueries/UserTable.php');
require_once('models/UserQueries/PostTable.php');
require('models/user.model.php');
require('models/post.model.php');
require_once('controllers/Authentication/Login.php');
require_once('controllers/Authentication/Register.php');
require_once('controllers/Authentication/Logout.php');
require_once('controllers/AuthValidation.php');

$db = new Database;
$userDb = new UserDb($db);
$postDb = new PostDb($db);
$authValidation = new AuthValidation;
$initSession = new Session;
$authUser = new AuthUser($db);
$verifyEmail = new EmailVerify;
$userTable =  new UserTable($db);
$postTable =  new PostTable($db);
$login = new LoginUser($authValidation, $authUser, $initSession);
$register = new RegisterUser($authValidation, $userTable, $verifyEmail, $userDb);
$logout = new LogoutUser;

$validation = new Validation;
$postController = new BlogPostController($validation, $postDb, $postTable);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "create_post"){
    $postController->composeBlog($_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "register_user"){
    $register->register($_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "login_user"){
    $login->login($_POST);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === "logout"){
    $logout->logoutUser($_POST);
}