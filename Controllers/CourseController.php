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
    
    public function getAllCourse()
    {
        $courses = $this->courseModel->getAllCourse();
        return $courses;
    }

    
    public function getCourseById($id)
    {
        return $this->courseModel->getCourseById($id);
    }
    


    public function addCourse($titre, $description,$description_courte, $contenu, $enseignant_id, $id_categorie, $tags){
        
         $this->courseModel->addCourse($titre, $description,$description_courte, $contenu, $enseignant_id, $id_categorie, $tags);
    }
    
    
}
?>