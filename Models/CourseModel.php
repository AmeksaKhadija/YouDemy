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
    private $status;


    public function __construct()
    {
        // $this->conn = (new Connection())->connect();
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
    public function getCategorie()
    {
        return $this->categorie;
    }

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


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    // afficher tous les cours 
    public function getAllCourse()
    {

        $this->conn = new Connection();
        $query = "SELECT  courses.id,  courses.titre,  courses.description_courte,  courses.description,  courses.contenu,  categories.name AS categorie,  GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags,  users.firstname AS enseignant, courses.status
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
    // afficher les course qui ont un status active
    public function getAllCourseActive()
    {
        $this->conn = new Connection();
        $query = "SELECT  
                courses.id,  
                courses.titre,  
                courses.description_courte,  
                courses.description,  
                courses.contenu,  
                categories.name AS categorie,  
                GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags,  
                users.firstname AS enseignant, 
                courses.status
            FROM courses 
            JOIN tag_course ON courses.id = tag_course.course_id
            JOIN tags ON tag_course.tag_id = tags.id
            JOIN categories ON courses.categorie_id = categories.id
            JOIN users ON courses.enseignant_id = users.id
            WHERE courses.status = 'active'
            GROUP BY courses.id";

        $stmt = $this->conn->connect()->query($query);
        $courses = $stmt->fetchAll(PDO::FETCH_CLASS, CourseModel::class);

        if (!empty($courses)) {
            return $courses;
        }

        return [];
    }
    public function getCourseByEnseignant($enseignant_id)
    {
        $this->conn = new Connection();
        $query = "SELECT courses.id, courses.titre, courses.description_courte, 
                     courses.description, courses.contenu, categories.name AS categorie,
                     GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags, courses.status
              FROM courses 
              JOIN tag_course ON courses.id = tag_course.course_id
              JOIN tags ON tag_course.tag_id = tags.id
              JOIN categories ON courses.categorie_id = categories.id
              WHERE courses.enseignant_id = :enseignant_id
              GROUP BY courses.id";

        $stmt = $this->conn->connect()->prepare($query);
        $stmt->bindParam(':enseignant_id', $enseignant_id, PDO::PARAM_INT);
        $stmt->execute();

        $courses = $stmt->fetchAll(PDO::FETCH_CLASS, CourseModel::class);

        if (!empty($courses)) {
            return $courses;
        }
        return [];
    }

    public function getCoursAndNumbreInscription($enseignant_id){
        $this->conn = new Connection();
    $query = "SELECT 
                courses.id,
                courses.titre,
                courses.description_courte,
                courses.description,
                courses.contenu,
                categories.name AS categorie,
                GROUP_CONCAT(DISTINCT tags.name SEPARATOR ', ') AS tags,
                courses.status,
                COUNT(DISTINCT inscription.etudiant_id) as nombre_inscriptions
            FROM courses 
            LEFT JOIN tag_course ON courses.id = tag_course.course_id
            LEFT JOIN tags ON tag_course.tag_id = tags.id
            LEFT JOIN categories ON courses.categorie_id = categories.id
            LEFT JOIN inscription ON courses.id = inscription.course_id
            WHERE courses.enseignant_id = :enseignant_id
            GROUP BY courses.id";
            
    $stmt = $this->conn->connect()->prepare($query);
    $stmt->execute(['enseignant_id' => $enseignant_id]);
    return $stmt->fetchAll(PDO::FETCH_CLASS, CourseModel::class);
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
    public function addCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags, $enseignant_id, $status)
    {

        // var_dump($titre, $description,$description_courte, $contenu, $enseignant_id, $id_categorie, $tags);
        //     die();
        if (!isset($_SESSION['user'])) {
            return "Vous devez être connecté pour vous ajouter un cours.";
        }
        var_dump($_SESSION['user']);
        $enseignant_id = $_SESSION['user']->getId();



        try {
            $this->conn = new Connection();
            $pdo = $this->conn->connect();

            if (!$pdo->inTransaction()) {
                $pdo->beginTransaction();
            }

            $query = "INSERT INTO courses (titre, description, description_courte, contenu, categorie_id, enseignant_id, status) 
                      VALUES (:titre, :description, :description_courte, :contenu, :id_categorie, :enseignant_id, :status)";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':description_courte', $description_courte);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':id_categorie', $id_categorie);
            $stmt->bindParam(':enseignant_id', $enseignant_id);
            $stmt->bindParam(':status', $status);

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

    public function EditCourse($titre, $description, $description_courte, $contenu, $id_categorie, $tags)
    {
        // var_dump($titre, $description, $description_courte, $contenu, $enseignant_id, $id_categorie, $tags);
        // die();
        try {
            $this->conn = new Connection();
            $pdo = $this->conn->connect();

            if (!$pdo->inTransaction()) {
                $pdo->beginTransaction();
            }

            $query = "UPDATE courses SET titre = :titre, description = :description, description_courte = :description_courte, contenu = :contenu, categorie_id = :id_categorie WHERE id = :id";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':description_courte', $description_courte);
            $stmt->bindParam(':contenu', $contenu);
            // $stmt->bindParam(':enseignant_id', $enseignant_id);
            $stmt->bindParam(':id_categorie', $id_categorie);
            $stmt->bindParam(':id', $_POST['id']);

            $stmt->execute();

            $deleteTagsQuery = "DELETE FROM tag_course WHERE course_id = :course_id";
            $deleteStmt = $pdo->prepare($deleteTagsQuery);
            $deleteStmt->bindParam(':course_id', $_POST['id']);
            $deleteStmt->execute();

            $insertTagQuery = "INSERT INTO tag_course (course_id, tag_id) VALUES (:course_id, :tag_id)";
            $insertStmt = $pdo->prepare($insertTagQuery);
            // var_dump($insertStmt);die();

            foreach ($tags as $tagId) {
                $insertStmt->bindParam(':course_id', $_POST['id']);
                $insertStmt->bindParam(':tag_id', $tagId);
                $insertStmt->execute();
                // var_dump($insertStmt);die();
            }

            $pdo->commit();
            return true;
        } catch (PDOException $e) {
            echo "Erreur lors de la modification du cours : " . $e->getMessage();
            return false;
        } finally {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
        }
    }

    // modifier status du course
    public function ModifierStatusCour($courseId, $statusCourse)
    {
        $this->conn = new Connection();

        $query = "UPDATE courses SET status = :status WHERE id = :id";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->bindParam(':status', $statusCourse, PDO::PARAM_STR);
        $stmt->bindParam(':id', $courseId, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function getTotalCourses()
    {
        $this->conn = new Connection();

        $query = "SELECT COUNT(*) as total_courses FROM courses";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->execute();
        $result =  $stmt->fetchColumn();
        // var_dump($result);
        // die();
        return $result;
    }

    public function getTotalCoursesInCategorie()
    {
        $this->conn = new Connection();

        $query = "SELECT COUNT(*) as total_courses, categories.name as categorieName
                FROM courses 
                JOIN categories ON courses.categorie_id = categories.id
                GROUP by categories.name
                ";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        // die();
        return $result;
    }


    public function getTotalInscriptionInCourse()
    {
        $this->conn = new Connection();

        $query = "SELECT COUNT(*) AS ToTalStudents, courses.titre AS courseName
                FROM courses 
                JOIN inscription ON inscription.course_id = courses.id
                JOIN users ON inscription.etudiant_id = users.id
                GROUP BY courseName 
                ORDER BY ToTalStudents DESC
                LIMIT 2
                ";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        // die();
        return $result;
    }

    public function checkIfUserInscribed($userId, $courseId)
    {
        $this->conn = new Connection();

        $query = "SELECT * FROM inscription WHERE course_id = :course_id AND etudiant_id = :etudiant_id";
        $stmt = $this->conn->connect()->prepare($query);
        $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
        $stmt->bindParam(':etudiant_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }


    public function getCoursesByUserId($userId)
    {
        $this->conn = new Connection();

        $query = "SELECT DISTINCT courses.id AS course_id,
                    courses.titre, 
                    courses.description, 
                    courses.categorie_id, 
                    categories.name AS categorie,                    
                    GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags
              FROM courses
              JOIN inscription ON courses.id = inscription.course_id
              JOIN categories ON courses.categorie_id = categories.id 
              LEFT JOIN tag_course ON courses.id = tag_course.course_id
              LEFT JOIN tags ON tag_course.tag_id = tags.id
              WHERE inscription.etudiant_id = :user_id
              GROUP BY courses.id";  // Ajouté GROUP BY ici

        $stmt = $this->conn->connect()->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $courses = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $courses[] = $row;
        }

        return $courses;
    }
}
