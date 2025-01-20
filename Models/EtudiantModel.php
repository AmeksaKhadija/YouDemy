<?php


class EtudiantModel extends UserModel
{


    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function inscrireAuCours($courseId)
    {

        if (!isset($_SESSION['user'])) {
            return "Vous devez être connecté pour vous inscrire à un cours.";
        }

        if ($_SESSION['user']->getRole()->getRoleName() !== 'Etudiant') {
            return "Seuls les étudiants peuvent s'inscrire aux cours.";
        }

        $userId = $_SESSION['user']->getId();

        try {
            
            $query = "INSERT INTO inscription (course_id, etudiant_id) VALUES (:course_id, :etudiant_id)";
            $stmt = $this->conn->connect()->prepare($query);
            $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->bindParam(':etudiant_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            //     var_dump($stmt);
            //     die();
            return true;
        } catch (PDOException $e) {
            header("location: /home");
            return "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}
