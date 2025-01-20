<?php
    include dirname(__DIR__) . '/Youdemy/Database/Connection.php';
spl_autoload_register(function($class){
    require_once dirname(__DIR__) . '/Youdemy/Models/'.$class.'.php';
});
session_start();
include dirname(__DIR__) . '/Youdemy/Models/CategorieModel.php';
include dirname(__DIR__) . '/Youdemy/Controllers/categorieController.php';
include dirname(__DIR__) . '/Youdemy/Controllers/AuthController.php';
include dirname(__DIR__) . '/Youdemy/Helpers/AuthHelpers.php';
include dirname(__DIR__) . '/Youdemy/Helpers/CategorieHelpers.php';
include dirname(__DIR__) . '/Youdemy/Helpers/TagHelpers.php';
include dirname(__DIR__) . '/Youdemy/Helpers/CourseHelpers.php';
include dirname(__DIR__) . '/Youdemy/Helpers/UserHelpers.php';
include dirname(__DIR__) . '/Youdemy/Controllers/TagController.php';
include dirname(__DIR__) . '/Youdemy/Controllers/CourseController.php';
include dirname(__DIR__) . '/Youdemy/Controllers/UserController.php';
// include dirname(__DIR__) . '/Youdemy/Models/CourseModel.php';
// include dirname(__DIR__) . '/Youdemy/Models/UserModel.php';
// include dirname(__DIR__) . '/Youdemy/Models/RoleModel.php';


// var_dump($_SESSION['user']);
// die();
$request = $_SERVER['REQUEST_URI'];

$categorie = new CategorieHelpers();
$tag = new TagHelpers();
$user = new AuthHelpers();
$utilisateur = new UserHelpers();
$course = new CourseHelpers();

if (isset($request)) {

    switch ($request) {
        case '/home':
            require __DIR__ . '/Views/Home.php';
            break;
        // course detail
        case '/checkToViewDetail':
            require __DIR__ . '/Views/Details.php';
            break;
        // register
        case '/Register':
            require __DIR__ . '/Views/Register.php';
            break;
        case '/checkToAddUser':
            $user->checkToAddUser();
            break;
        // login
        case '/Login':
            require __DIR__ . '/Views/Login.php';
            break;
        case '/checkUserIfExiste':
            $user->checkUserIfExiste();
            break;
        // logout
        case '/logout':
            $user->logout();
            break;
        // categories
        case  '/AdminBordCateg':
            require __DIR__ . '/Views/AdminBordCateg.php';
            break;

        case '/checkToAddCategorie':
            $categorie->checkToAddCategorie();
            break;

        case '/checkToEditCategorie':
            require __DIR__ . '/Views/editCategorie.php';
            break;

        case '/submitFormCateg':
            $categorie->checkToEditCategorie();
            break;

        case '/checkToDeleteCategorie':
            $categorie->checkToDeleteCategorie();
            break;
        // tags
        case '/AdminBordTag':
            require __DIR__ . '/Views/AdminBordTag.php';
            break;

        case '/checkToAddTag':
            $tag->checkToAddTag();
            break;

        case '/checkToEditTag':
            require __DIR__ . '/Views/editTag.php';
            break;

        case '/submitFormTag':
            $tag->checkToEditTag();
            break;

        case '/checkToDeletTag':
            $tag->checkToDeletTag();
            break;
        // course
        case '/AdminCours':
            require __DIR__ . '/Views/AdminCours.php';
            break;
        // enseignat ajouter course
        case '/checkToAddCourse':
            $course->checkToAddCourse();
            break;
        // edit course
        case '/checkToEditCourse':
            require __DIR__ . '/Views/EditCourse.php';
            break;
        case '/submitFormEdite':
            $course->checkToEditCourse();
            break;
        case '/checkToDeletCourse':
            $course->checkToDeletCourse();
            break;
        // modifier status du cour 
        case '/ModifierStatusCour':
            $course->checkToEditStatusCourse();
            break;
        // utilisateurs
        case '/AdminUsers':
            require __DIR__ . '/Views/AdminUsers.php';
            break;
        case '/ModifierStatus':
            $utilisateur->ckeckToModifierStatus();
            break;
        case '/DeletUser':
            $utilisateur->checkToDeleteUser();
            break;
        

        case '/EnseignantCourse':
            require __DIR__ . '/Views/EnseignantCourse.php';
            break;

        // Admin statistiques
        case '/AdminStatistics':
            require __DIR__ . '/Views/AdminStatistics.php';
            break;
        
        // inscription
        case '/inscriAuCour':
            $utilisateur->checkToInscriAuCour();
            break;
        
        // apres l'inscription
        case '/MesCourses':
            require __DIR__ . '/Views/MesCourses.php';
            break;
    }
}
