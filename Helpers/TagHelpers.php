<?php


class TagHelpers{

    private $conn;
    private $tag;

    public function __construct()
    {
        $conn = (new Connection())->connect();
        $this->tag = new tagController($conn);

    }
    
    public function checkToAddTag(){
        // isset pour la methode de l'ajout d'une tag
        if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['description'])) {
            $this->tag->addTag($_POST['name'],$_POST['description']);
            header("Location: /AdminBordTag");
        }
    }

    public function checkToEditTag(){
        // isset pour la methode de modifier tag
        if (!empty($_POST['name']) && !empty($_POST['id']) && !empty($_POST['description'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $this->tag->editTag($id, $name, $description);
            header("Location: /AdminBordTag");
        }
    }
    
    public function checkToDeletTag(){
        // isset pour le supprition d'une tag
        if(isset($_POST['id'])){
            $tagId = $_POST['id'];
            $this->tag->deleteTag($tagId);
            header("Location: /AdminBordTag");
            
        }
    }
}