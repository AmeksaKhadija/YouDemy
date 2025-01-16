<?php


class AuthController{
    private $conn;
    private $UserModel;

    
    public function __construct()
    {
        $conn = (new Connection())->connect();
        $this->UserModel = new UserModel($conn);
    }

    public function insertUser($userModel)
    {
        $this->UserModel->insertUser($userModel);
    }
}