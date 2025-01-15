<?php

class CourseModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function getAllCourse()
    {
        $query = "SELECT courses.id, courses.titre, courses.description_courte, courses.description, courses.contenu, categories.name AS categorie,
            GROUP_CONCAT(tags.name SEPARATOR ', ') AS tagss
            FROM courses 
            JOIN tag_course  ON courses.id = tag_course.course_id
            JOIN tags ON tag_course.tag_id = tags.id
            JOIN categories ON courses.categorie_id = categories.id
            GROUP BY courses.id";

        $stmt = $this->conn->query($query);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($courses)) {
            return $courses;
        }
    }

    public function getCourseById($id)
    {
        $query = "SELECT courses.id, courses.titre, courses.description_courte, courses.description, courses.contenu, categories.name AS categorie,
            GROUP_CONCAT(tags.name SEPARATOR ', ') AS tagss
            FROM courses 
            JOIN tag_course  ON courses.id = tag_course.course_id
            JOIN tags ON tag_course.tag_id = tags.id
            JOIN categories ON courses.categorie_id = categories.id 
            WHERE courses.id = :id
            GROUP BY courses.id;";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
}
