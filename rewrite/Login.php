<?php
// strictly for login

class LoginUser {
    private $errors = [];
    private $validate;
    private $authUser;
    private $initSession;

    public function __construct(AuthValidationInterface $authValidation,
                                AuthUserInterface $authUser,
                                InitSessionInterface $initSession){
        $this->validate = $authValidation;
        $this->authUser = $authUser;
        $this->initSession = $initSession;
    }

    public function login() {
        $authData['email'] = $_POST['email'];
        $authData['password'] = $_POST['password'];

        //validate
        // var_dump($authData);
        if($this->validate->validate($authData)){
            //authenticate
            if(empty($this->errors) && !$this->authUser->authenticateUser($authData['email'], $authData['password'])){
                $this->errors[] = $this->authUser->getAuthErrors();
            }else{
                //start session
                $this->initSession->initiateSession($authData['email']);
                header('Location: views/home.view.php');
                exit();
            }
        } else {
            $this->errors[] = $this->validate->getValidateErrors();
        }
        print_r($this->errors);
    }
    //get Login errors
    public function getErrors() {
        return $this->errors;
    }
}