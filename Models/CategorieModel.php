<?php

class CategorieModel
{
    private $conn;
    private $id;
    private $name;
    private $description;

    public function __construct($conn)
    {
        $this->conn = $conn;
        // $this->name = $name;
        // $this->description = $description;
    }

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }


    public function __toString(){
        return "Name :" . $this->name . "Description :" .$this->description. "</br>";
    }


    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->query($query);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($categories)) {
            return $categories;
        }
    }

    public function deleteCategory($categoryId)
    {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addCategory($name,$description)
    {
        try {

            $query = "INSERT INTO categories(name,description) VALUES(:name, :description)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
                
        } catch (PDOException $e) {
            echo "Error l'ors de l'ajout d'une categorie: " . $e->getMessage();
        }
    }


    public function editCategorie($id,$name, $description)
    {
        $existingCategory = $this->getCategoryById($id);
    
        if ($existingCategory) {
            // echo "Editing existing category...";
            $query = "UPDATE categories SET name = :name , description = :description WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Failed to update category...";
                return false; 
            }
        } else {
            echo "Trying to edit a non-existing category...";
            return false;
        }
    }

    public function getCategoryById($categoryId)
    {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchObject(CategorieModel::class);;
    
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

//statistics
    public function getTotalCategories()
    {
        $query = "SELECT COUNT(*) as total_categories FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();

    }
    
}