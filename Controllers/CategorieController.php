<?php

class categorieController
{
    private $conn;
    private $categorieModel;

    
    public function __construct()
    {
        $conn = (new Connection())->connect();
        $this->categorieModel = new CategorieModel($conn);
    }

    public function deleteCategory($categoryId)
    {
        $this->categorieModel->deleteCategory($categoryId);
    }

    
    public function addCategory($name,$description)
    {
        $this->categorieModel->addCategory($name,$description);
    }

    public function editCategorie($id, $nom, $description) {
        return $this->categorieModel->editCategorie($id, $nom, $description);
    }

    public function getCategoryById($id)
    {
        return $this->categorieModel->getCategoryById($id);
    }

    public function getAllCategories()
    {
         $categories = $this->categorieModel->getAllCategories();
         return $categories;
    }

    public function getTotalCategories()
    {
        $totalcategories = $this->categorieModel->getTotalCategories();
        return $totalcategories;
    }

    

}

$categorieController = new CategorieController();

?>