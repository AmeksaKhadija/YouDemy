<?php

class AuthHelpers
{

    private $user;
    private $RoleModel;

    public function __construct()
    {
        $this->user = new AuthController();
        $this->RoleModel = new RoleModel();
    }

    public function checkToAddUser()
    {

        if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['photo'])  && !empty($_POST['role'])) {

            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);
            $phone = htmlspecialchars($_POST['phone']);
            $photo = htmlspecialchars($_POST['photo']);
            $role = htmlspecialchars($_POST['role']);

            $userRole =   $this->RoleModel->findRoleByName($role);

            $userModel = UserModel::instanceWithoutId($firstname, $lastname, $email, $password, $phone, $photo, "pending", $userRole, []);

            $this->user->insertUser($userModel);
            header("Location: /Login");
        }
    }

    public function checkUserIfExiste()
    {

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $userModel = UserModel::instaceWithEmailAndPassword($email, $password);
            $userModel1 = $this->user->findByEmailAndPassword($userModel);
            $userRole =   $this->RoleModel->findRoleById($userModel1->role_id);

            // var_dump($userRole);
            // die();


            if (!$userModel1) {
                $_SESSION['UserNotFound'] = "L'utilisateur n'existe pas";
                header("Location: /Login");
                exit();
            }
            $userModel1->setRole($userRole);

            $_SESSION['user'] = $userModel1;


            header("Location: /home");
            exit();
        } else {
            echo "Veuillez remplir tous les champs";
            header("Location: /Login");
            exit();
        }
    }

    public function logout()
    {
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            header('location: /home');
        }

    }
}
