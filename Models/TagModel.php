<?php

// include './../database/connection.php';

class TagModel
{
    public $conn;
    // public $name;
    private $name;
    private $description;

    public function __construct($conn)
    {
        $this->conn = $conn;
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
        $sql = "SELECT * FROM tags";
        $query = $this->conn->query($sql);
        $tags = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($tags)) {
            return $tags;
        }

        return [];
    }

    public function deleteTag($tagId)
    {
        $sql = "DELETE FROM tags WHERE id = :tagId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
        $result = $stmt->execute();

        return $result;
    }

    public function addTag($name, $description)
    {
        $sql = "INSERT INTO tags (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $result = $stmt->execute();

        return $result;
    }

    public function editTag($id,$name, $description)
    {
        $existingTag = $this->getTagById($id);

        if ($existingTag) {
            // echo "Editing existing tag...";
            $query = "UPDATE tags SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->conn->prepare($query);
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
        $query = "SELECT * FROM tags WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $tagId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function getTotalTag()
    {
        $query = "SELECT COUNT(*) as total_tags FROM tag ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res["total_tags"];
    }

}
