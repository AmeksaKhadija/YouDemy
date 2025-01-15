<?php
include dirname(__DIR__) . '/Youdemy/Database/Connection.php';
include dirname(__DIR__) . '/Youdemy/Models/CategorieModel.php';
include dirname(__DIR__) . '/Youdemy/Controllers/categorieController.php';
include dirname(__DIR__) . '/Youdemy/Helpers/CategorieHelpers.php';
include dirname(__DIR__) . '/Youdemy/Helpers/TagHelpers.php';
include dirname(__DIR__) . '/Youdemy/Controllers/TagController.php';
include dirname(__DIR__) . '/Youdemy/Controllers/CourseController.php';
include dirname(__DIR__) . '/Youdemy/Models/CourseModel.php';


$request = $_SERVER['REQUEST_URI'];
$categorie = new CategorieHelpers();
$tag = new TagHelpers();
// $course = new CourseHelpers();

if (isset($request)) {

    switch ($request) {
        case '/home':
            require __DIR__ . '/Views/Home.php';
            break;
        case '/checkToViewDetail':
            require __DIR__ . '/Views/Details.php';
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
        
        case '/checkToAddCourse':
            $course->checkToAddCourse();
            break;
    }
}
