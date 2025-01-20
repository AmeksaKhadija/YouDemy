<?php
if (isset($_SESSION['user'])) {
    $UserName = $_SESSION['user']->getRole()->getRoleName();
    if ($UserName == 'Etudiant' || $UserName == 'Enseignant') {
       header('location: /home');
    }
    }

$courController = new CourseController();
$courses = $courController->getAllCourse();
$categorieController = new categorieController();
$categories = $categorieController->getAllCategories();
$tagController = new tagController();
$tags = $tagController->getAllTags();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>
<!-- bytewebster.com -->
<!-- bytewebster.com -->
<!-- bytewebster.com -->

<body>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <?php
        include dirname(__DIR__, 1) . '/Utils/navbar.php';

        ?>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <?php
            include dirname(__DIR__, 1) . '/Utils/header.php';

            ?>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <div class="card shadow border-0 mb-7">
                        <div class="table-responsive">
                            <?php if (!empty($courses)): ?>

                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Descrition Courte</th>
                                            <th scope="col">Categorie</th>
                                            <th scope="col">Tags</th>
                                            <th scope="col">Enseignant</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($courses as $course): ?>
                                            <tr>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $course->getTitre(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $course->getDescriptionCourte(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $course->getIdCategorie(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $course->getTags(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $course->getEnseignant(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $course->getStatus(); ?>
                                                    </a>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <form method="POST" action="/ModifierStatusCour">
                                                        <input type="hidden" name="id" value="<?= $course->getId(); ?>">
                                                        <input type="hidden" name="status" value="active">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Activer">
                                                    </form>
                                                    <form method="POST" action="/ModifierStatusCour">
                                                        <input type="hidden" name="id" value="<?= $course->getId(); ?>">
                                                        <input type="hidden" name="status" value="rejeter">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Rejeter">
                                                    </form>
                                                    <form method="POST" action="/DeletUser">
                                                        <input type="hidden" name="id" value="<?= $course->getId(); ?>">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Supremer">
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Aucun course trouvé.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../Assets/script.js"></script>
</body>

</html>