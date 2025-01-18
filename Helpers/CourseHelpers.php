<?php

class CourseHelpers
{

    private $conn;
    private $course;
    public function __construct()
    {
        $conn = (new Connection())->connect();
        $this->course = new CourseController($conn);
    }


    public function checkToAddCourse()
    {
        
        if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['description_courte']) && !empty($_POST['contenu'])&&!empty($_POST['enseignant_id']) && !empty($_POST['id_categorie']) && isset($_POST['tags']) && is_array($_POST['tags'])) {
    
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $description_courte = $_POST['description_courte'];
            $contenu = $_POST['contenu'];
            $enseignant_id = $_POST['enseignant_id'];
            $id_categorie = $_POST['id_categorie'];
            $tags = $_POST['tags'];

            $this->course->addCourse($titre, $description,$description_courte, $contenu, $enseignant_id, $id_categorie, $tags);
            header("Location: /AdminCours");
            exit();
        }
    }
}
