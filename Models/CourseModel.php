<?php

// use FTP\Connection;
include_once "./Database/Connection.php";
// include_once "./CategorieModel.php";

#[\AllowDynamicProperties]

class CourseModel
{
    private $conn;
    private $titre;
    private $description;
    private $description_courte;
    private $contenu;
    private $id;
    private $categorie;
    private $tags;
    private $enseignant;



    public function __construct() {}

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
    public function getCategorie()
    {
        return $this->categorie;
    }

    // public function setTagss($tagss)
    // {
    //     $this->tagss = $tagss;
    // }
    // public function getTagss()
    // {
    //     return $this->tagss;
    // }

    public function setEnseignant($enseignant)
    {
        $this->enseignant = $enseignant;
    }
    public function getEnseignant()
    {
        return $this->enseignant;
    }



    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
    public function getTitre()
    {
        return $this->titre;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescriptionCourte($description_courte)
    {
        $this->description_courte = $description_courte;
    }
    public function getDescriptionCourte()
    {
        return $this->description_courte;
    }
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }
    public function getContenu()
    {
        return $this->contenu;
    }
    public function setIdCategorie(CategorieModel $categorie)
    {
        $this->categorie = $categorie;
    }
    public function getIdCategorie()
    {
        return $this->categorie;
    }
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    public function getTags()
    {
        return $this->tags;
    }
    public function setStudents($students)
    {
        $this->students = $students;
    }
    public function getStudents()
    {
        return $this->students;
    }

    // afficher tous les cours 
    public function getAllCourse()
    {

        $this->conn = new Connection();
        $query = "SELECT  courses.id,  courses.titre,  courses.description_courte,  courses.description,  courses.contenu,  categories.name AS categorie,  GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags,  users.firstname AS enseignant
                FROM courses 
                JOIN tag_course  ON courses.id = tag_course.course_id
                JOIN tags ON tag_course.tag_id = tags.id
                JOIN categories ON courses.categorie_id = categories.id
                JOIN users ON courses.enseignant_id = users.id
                GROUP BY courses.id
            ";
        $stmt = $this->conn->connect()->query($query);
        $courses = $stmt->fetchAll(PDO::FETCH_CLASS, CourseModel::class);
        // foreach ($courses as $course) {
        //     var_dump($course);
        // }

        if (!empty($courses)) {
            return $courses;
        }
    }

    public function getCourseById($id)
    {
        try {
            $this->conn = new Connection();

            $query = "SELECT 
                    courses.id, 
                    courses.titre, 
                    courses.description_courte, 
                    courses.description, 
                    courses.contenu, 
                    categories.name AS categorie,
                    GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags
                FROM courses 
                JOIN tag_course ON courses.id = tag_course.course_id
                JOIN tags ON tag_course.tag_id = tags.id
                JOIN categories ON courses.categorie_id = categories.id 
                WHERE courses.id = :id
                GROUP BY courses.id;
            ";

            $stmt = $this->conn->connect()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchObject(CourseModel::class);

            return $result ?: null;
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }


    // l'ajout d'un cour
    public function addCourse($titre, $description, $description_courte, $contenu, $enseignant_id, $id_categorie, $tags)
    {
        try {
            $this->conn = new Connection();
            $pdo = $this->conn->connect();

            if (!$pdo->inTransaction()) {
                $pdo->beginTransaction();
            }

            $query = "INSERT INTO courses (titre, description, description_courte, contenu, categorie_id, enseignant_id) 
                      VALUES (:titre, :description, :description_courte, :contenu, :id_categorie, :enseignant_id)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':description_courte', $description_courte);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':id_categorie', $id_categorie);
            $stmt->bindParam(':enseignant_id', $enseignant_id);
            $stmt->execute();

            $idCourse = $pdo->lastInsertId();

            $sql = "INSERT INTO tag_course (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $stmt = $pdo->prepare($sql);

            foreach ($tags as $tagId) {
                $stmt->bindParam(':course_id', $idCourse);
                $stmt->bindParam(':tag_id', $tagId);
                $stmt->execute();
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {

            echo "Erreur lors de l'ajout du cours : " . $e->getMessage();
            return false;
        } finally {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
        }
    }
}
