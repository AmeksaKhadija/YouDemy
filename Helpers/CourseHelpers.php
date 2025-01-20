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
        // var_dump( !empty($_POST['titre']));
        // var_dump( !empty($_POST['description']));
        // var_dump( !empty($_POST['description_courte']));
        // var_dump( !empty($_POST['contenu']));
        // var_dump( !empty($_POST['id_categorie']));
        // var_dump( is_array($_POST['tags']));
        if (
            !empty($_POST['titre']) &&
            !empty($_POST['description']) &&
            !empty($_POST['description_courte']) &&
            !empty($_POST['contenu']) &&
            !empty($_POST['id_categorie']) &&
            isset($_POST['tags']) &&
            is_array($_POST['tags'])
        ) {
           
            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $description_courte = $_POST['description_courte'];
            $contenu = $_POST['contenu'];
            $enseignant_id = $_POST['enseignant_id'];
            $id_categorie = $_POST['id_categorie'];
            $tags = $_POST['tags'];
            
            $this->course->addCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags, $enseignant_id, "rejeter");
            header("Location: /EnseignantCourse");
        }
    }

    public function checkToEditCourse()
    {

        if (
            !empty($_POST['titre']) &&
            !empty($_POST['description']) &&
            !empty($_POST['description_courte']) &&
            // !empty($_POST['contenu']) && 
            // !empty($_POST['enseignant_id']) && 
            !empty($_POST['id_categorie']) &&
            isset($_POST['tags']) &&
            is_array($_POST['tags'])
        ) {

            $titre = $_POST['titre'];
            $description = $_POST['description'];
            $description_courte = $_POST['description_courte'];
            $contenu = $_POST['contenu'];
            // $enseignant_id = $_POST['enseignant_id'];
            $id_categorie = $_POST['id_categorie'];
            $tags = $_POST['tags'];

            $success =  $this->course->EditCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags);
            if ($success) {
                header("Location: /EnseignantCourse");
                exit();
            } else {
                echo "Erreur lors de la modification du cours.";
            }
        } else {
            echo "Données invalides ou manquantes.";
        }
    }

    public function checkToDeletCourse() {}

    // admin
    public function checkToEditStatusCourse()
    {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $courseId = $_POST['id'];
            $statusCourse = $_POST['status'];

            $this->course->ModifierStatusCour($courseId, $statusCourse);
            header("Location: /AdminCours");
            exit;
        }
    }
}
