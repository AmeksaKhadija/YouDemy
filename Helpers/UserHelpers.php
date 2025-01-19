<?php

class UserHelpers{

    private $utilisateur;

    public function __construct(){
        $this->utilisateur = new UserController();        
    }

    public function ckeckToModifierStatus()
    {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $userId = $_POST['id'];
            $status = $_POST['status'];
        
            $this->utilisateur->ModifierStatus($status, $userId);
            header("Location: /AdminUsers"); 
            exit;
        }
    }

    public function checkToDeleteUser(){
        if(isset($_POST['id'])){
            $userId = $_POST['id'];
            $this->utilisateur->deleteUser($userId);
            header("Location: /AdminUsers");
            
        }
    }


}