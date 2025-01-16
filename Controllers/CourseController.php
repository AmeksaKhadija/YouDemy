<?php

class CourseController{

    private $conn;
    private $courseModel;

    public function __construct()
    {
        $database = new Connection();
        $conn = $database->connect();
        // $conn = (new Connection())->connect();
        $this->courseModel = new CourseModel($conn);

    }

    // TO DO 
    // public function addLivre($titre, $auteur, $date_creation, $id_categorie, $image, $tags)
    // {
    //     $this->courseModel->addCourse($titre, $auteur, $date_creation, $id_categorie, $image, $tags);
    // }

    public function getAllCourse()
    {
        $livres = $this->courseModel->getAllCourse();
        return $livres;
    }

    // TO DO
    // public function addTagToLivre($idLivre, $tagId){
    //     $this->livreModel->addTagToLivre($idLivre, $tagId);
    // }

    public function getCourseById($id)
    {
        return $this->courseModel->getCourseById($id);
    }
}
    





?>