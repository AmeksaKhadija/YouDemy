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

    public function getAllCourseActive()
    {
        $courses = $this->courseModel->getAllCourseActive();
        return array_filter($courses, function($course) {
            return $course->getStatus() === 'active';
        });
    }

    public function getCourseByEnseignant()
    {
        $enseignant_id = $_SESSION['user']->getId();
        $courses = $this->courseModel->getCourseByEnseignant($enseignant_id);
        return $courses;
    }

    public function getCoursAndNumbreInscription(){
        $enseignant_id = $_SESSION['user']->getId();
        $courses = $this->courseModel->getCoursAndNumbreInscription($enseignant_id);
        return $courses;
    }


    public function getCourseById($id)
    {
        return $this->courseModel->getCourseById($id);
    }

    public function addCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags, $enseignant_id, $status)
    {

        return $this->courseModel->addCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags, $enseignant_id, $status);
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
