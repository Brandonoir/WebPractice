<?php
//strictly register user

class RegisterUser {
    private $errors=[];
    private $validate;
    private $checkUserTable;
    private $verifyEmail;
    private $createUser;

    public function __construct(AuthValidationInterface $validate,
                                IUserTable $checkUserTable,
                                IEmailVerify $verifyEmail,
                                UserModelInterface $createUser){
        $this->validate = $validate;
        $this->checkUserTable = $checkUserTable;
        $this->verifyEmail = $verifyEmail;
        $this->createUser = $createUser;
    }

    public function register() {
        $authData['email'] = $_POST['email'];
        $authData['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        //validate inputs
        if(!$this->validate->validate($authData)){
            $this->errors = $this->validate->getValidateErrors();
        }
        //check users table
        if (!$this->checkUserTable->checkUsersTableExists()) {
            $this->checkUserTable->createUsersTable();
        }
        //get email verification
        if(!$this->verifyEmail->isEmailUnique($authData['email'])){
            $this->errors[] = 'Email is already taken. please use different email.';
        }

        //register user
        if(empty($this->errors)) {
            //register user
            $this->createUser->createUser($authData);
            echo "user created!";
        } else {
            echo "Error: ";
            var_dump($this->errors);
        }
    }
}