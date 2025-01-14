<?php


class CategorieHelpers{
    private $categorie;


    public function __construct(){
        $this->categorie = new CategorieController();

    }

    public function checkToAddCategorie(){
        // isset pour la methode de l'ajout d'une categorie
        // die("test");
        if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['description'])) {
            $this->categorie->addCategory($_POST['name'],$_POST['description']);
            header("Location: /AdminBordCateg");
        }
    }
    
    public function checkToEditCategorie(){
        // // isset pour la methode de modifier categorie
        if (!empty($_POST['name']) && !empty($_POST['id']) && !empty($_POST['description'])) {
            $id = $_POST['id'];
            $nom = $_POST['name'];
            $description = $_POST['description'];
            $this->categorie->editCategorie($id, $nom, $description);
            header("Location: /AdminBordCateg");
        }
    }
    
    public function checkToDeleteCategorie(){
        // // isset pour le supprition d'une categorie
        // die("test");
        if(isset($_POST['id'])){
                $categoryId = $_POST['id'];
                $this->categorie->deleteCategory($categoryId);
                header("Location: /AdminBordCateg");
            }
        }
}