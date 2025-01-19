<?php

class UserController{

    private $userModel;

    public function __construct()
    {
        $database = new Connection();
        $conn = $database->connect();

        $this->userModel = new UserModel($conn);
    }

    public function getAllUsers()
    {
        $users = $this->userModel->getAllUsers();
        return $users;
    }

    
    public function ModifierStatus($status,$userId){
        return $this->userModel->ModifierStatus($status,$userId);
    }

    public function deleteUser($userId){
        $this->userModel->deleteUser($userId);
    }

    
}