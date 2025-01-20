<?php
if (isset($_SESSION['user'])) {
    $UserName = $_SESSION['user']->getRole()->getRoleName();
    if ($UserName == 'Admin') {
        header('location: /AdminStatistics');
    }
}

$result = [];
$isAlreadyInscribed = false; 

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $courseController = new CourseController();
    // $courses = $courseController->getAllCourse();
    $result = $courseController->getCourseById($id);

    if (!$result) {
        echo "Course introuvable.";
        exit();
    }

    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']->getId();
        $isAlreadyInscribed = $courseController->checkIfUserInscribed($userId, $id);
    }
} else {
    echo "ID de Course invalide.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details page</title>
    <link rel="stylesheet" href="./../Assets/style.css">
</head>
<body>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?= $result->getTitre(); ?></div>
                <div class="card-body">
                    <div class="row">
                        <div class="image col-md-4">
                            <img src="<?= $result->getContenu(); ?>" alt="course Image" class="img-fluid" style="height: 100%; width: 100%;">
                        </div>
                        <div class="col-md-8">
                            <h5 class="custom-h5-color">Description:</h5>
                            <p><?= $result->getDescription(); ?></p>
                            <h6 class="custom-h5-color">Categorie:</h6>
                            <p><?= $result->getIdCategorie(); ?></p>
                            <h5 class="custom-h5-color">Tags:</h5>
                            <p><?= $result->getTags(); ?></p>
                            <a href="/home" class="btn btn-success mt-5">Go Back</a>

                            <!-- Afficher le bouton d'inscription si l'utilisateur n'est pas encore inscrit -->
                            <?php if (!$isAlreadyInscribed): ?>
                                <form action="/inscriAuCour" method="POST" style="display: inline;" enctype="multipart/form-data">
                                    <input type="hidden" name="course_id" value="<?= $result->getId(); ?>">
                                    <button type="submit" class="btn btn-outline-secondary float-right mt-5">Inscription à ce cours..</button>
                                </form>
                            <?php else: ?>
                                <p class="text-success">Vous êtes déjà inscrit à ce cours.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
