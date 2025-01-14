<?php
include dirname(__DIR__) . '/Youdemy/Database/Connection.php';
include dirname(__DIR__) . '/Youdemy/Models/CategorieModel.php';
include dirname(__DIR__) . '/Youdemy/Controllers/categorieController.php';
include dirname(__DIR__) . '/Youdemy/Helpers/CategorieHelpers.php';
include dirname(__DIR__) . '/Youdemy/Controllers/TagController.php';
// include dirname(__DIR__) . '/Youdemy/Models/TagModel.php';
include dirname(__DIR__) . '/Youdemy/Helpers/TagHelpers.php';

$request = $_SERVER['REQUEST_URI'];
$categorie = new CategorieHelpers();
$tag = new TagHelpers();

if (isset($request)) {

    switch ($request) {
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
            
        case '/AdminCours':
            require __DIR__ . '/Views/AdminCours.php';
            break;
    }
}
