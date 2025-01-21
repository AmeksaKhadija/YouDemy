<?php

// include './../database/connection.php';
#[\AllowDynamicProperties]

class TagModel
{
    public $conn;
    // public $name;
    private $id;
    private $name;
    private $description;

    public function __construct()
    {
        
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
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

    public function getAllTags()
    {
        $this->conn = new Connection();

        $sql = "SELECT * FROM tags";
        $query = $this->conn->connect()->query($sql);
        $tags = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($tags)) {
            return $tags;
        }

        return [];
    }

    public function deleteTag($tagId)
    {
        $this->conn = new Connection();

        $sql = "DELETE FROM tags WHERE id = :tagId";
        $stmt = $this->conn->connect()->prepare($sql);
        $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    public function addTag($name, $description)
    {
        $this->conn = new Connection();

        $sql = "INSERT INTO tags (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->connect()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $result = $stmt->execute();

        return $result;
    }

    public function editTag($id,$name, $description)
    {
        $this->conn = new Connection();

        $existingTag = $this->getTagById($id);

        if ($existingTag) {
            // echo "Editing existing tag...";
            $query = "UPDATE tags SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->conn->connect()->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true; 
            } else {
                echo "Failed to update tag...";
                return false;
            }
        } else {
            echo "Trying to edit a non-existing tag...";
            return false;
        }
    }

    public function getTagById($tagId)
    {
        $this->conn = new Connection();

        $query = "SELECT * FROM tags WHERE id = :id";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->bindParam(':id', $tagId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchObject(TagModel::class);
    
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function getTotalTags()
    {
        $this->conn = new Connection();

        $query = "SELECT COUNT(*) as total_tags FROM tags ";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
         
    }

}
