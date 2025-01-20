<?php

class CourseController
{

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

    public function getAllCourseWithoutEnseignant()
    {
        $courses = $this->courseModel->getAllCourseWithoutEnseignant();
        return $courses;
    }

    public function getCourseById($id)
    {
        return $this->courseModel->getCourseById($id);
    }

    public function addCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags, $status)
    {
        // var_dump($titre, $description,$description_courte, $contenu, $enseignant_id, $id_categorie, $tags);
        //     die();
        return $this->courseModel->addCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags, $status);
    }

    public function EditCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags)
    {
        $courseModifier =  $this->courseModel->EditCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags);
        return $courseModifier;
    }

    public function ModifierStatusCour($courseId, $statusCourse)
    {
        $this->courseModel->ModifierStatusCour($courseId, $statusCourse);
    }

    public function getTotalCourses()
    {
        $courses = $this->courseModel->getTotalCourses();

        return $courses;
    }
    public function getTotalCoursesInCategorie()
    {
        $courses = $this->courseModel->getTotalCoursesInCategorie();

        return $courses;
    }

    public function checkIfUserInscribed($userId, $courseId)
    {
        return $this->courseModel->checkIfUserInscribed($userId, $courseId);
    }

    public function getCoursesForUser($userId)
    {
        return $this->courseModel->getCoursesByUserId($userId);
    }

    public function getTotalInscriptionInCourse()
    {
        return $this->courseModel->getTotalInscriptionInCourse();
    }
}
