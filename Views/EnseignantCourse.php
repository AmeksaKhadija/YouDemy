<?php
if (isset($_SESSION['user'])) {
    $UserName = $_SESSION['user']->getRole()->getRoleName();
    if ($UserName == 'Etudiant') {
       header('location: /home');
    }else if ($UserName == 'Admin') {
        header('location: /AdminStatistics');
    }
    }

$courController = new CourseController();
$courses = $courController->getAllCourseWithoutEnseignant();
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
    <?php 
    ?>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
            <div class="container-fluid">
                <!-- Toggler -->
                <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Brand -->
                <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="/home">
                    <h3 class="text-primary"><img src="./../Assets/images/Blue White Minimalist Initial Academy Logo.png" width="40"><span class="text-dark">You</span>Demy</h3>
                </a>
                <!-- User menu (mobile) -->
                <div class="navbar-user d-lg-none">
                    <!-- Dropdown -->
                    <div class="dropdown">
                        <!-- Toggle -->
                        <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-parent-child">
                                <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                                <span class="avatar-child avatar-badge bg-success"></span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navigation -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/EnseignantStatistics" class="nav-link" href="adminBord.php">
                                <i class="bi bi-house"></i> Statistiques
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/EnseignantCourse" class="nav-link" href="adminLivres.php">
                                <i class="bi bi-file-text"></i>Mes Cours
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/studentsInscrire" class="nav-link" href="adminUser.php">
                                <i class="bi bi-people"></i> Les inscriptions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/logout" class="nav-link" href="#">
                                <i class="bi bi-box-arrow-left"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <?php
            include dirname(__DIR__, 1) . '/Utils/header.php';

            ?>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Actions -->
                    <div class="col-sm-12 col-12 text-sm-end">
                        <div class="mx-n1">
                            <!-- <a href="#" > -->
                            <button class="btn d-inline-flex btn-sm btn-primary mx-1" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class=" pe-2">
                                    <i class="bi bi-plus"></i>
                                </span>
                                <span>Create</span>
                            </button>
                        </div>
                    </div>
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
                                                        <?= $course->getStatus(); ?>
                                                    </a>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <form method="POST" action="/checkToEditCourse">
                                                        <input type="hidden" name="id" value="<?= $course->getId(); ?>">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Edit">
                                                    </form>
                                                    <form method="POST" action="/checkToDeletCourse">
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

    <!-- modal pour ajouter une course -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Course</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method='POST' action="/checkToAddCourse">
                        <div class="mb-3">
                            <label for="name" class="form-label">Titre de cour</label>
                            <input type="text" class="form-control" name="titre" id="titre"
                                aria-describedby="nomUtilisateur">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description courte</label>
                            <input type="text" class="form-control" name="description_courte" id="description"
                                aria-describedby="nomUtilisateur">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description complet du cour</label>
                            <input type="text" class="form-control" name="description" id="description"
                                aria-describedby="nomUtilisateur">
                        </div>
                        <div class="mb-3">
                            <label for="contenu" class="form-label">Contenu</label>
                            <input type="file" class="form-control" name="contenu" id="contenu"
                                aria-describedby="nomUtilisateur">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="enseignant_id" class="form-label">Enseignant</label>
                            <input type="text" class="form-control" name="enseignant_id" id="enseignant_id"
                                aria-describedby="nomUtilisateur">
                        </div> -->
                        <div class="mb-3">
                            <label for="id_categorie" class="form-label">Catégorie</label>
                            <select class="form-select" name="id_categorie" id="id_categorie" required>
                                <?php foreach ($categories as $categories) : ?>
                                    <option value="<?php echo $categories['id']; ?>">
                                        <?php echo htmlspecialchars($categories['name']); ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <div class="form-check">
                                <?php foreach ($tags as $tag) : ?>
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="tags[]"
                                            value="<?php echo $tag['id']; ?>" id="tag-<?php echo $tag['id']; ?>">
                                        <label class="form-check-label" for="tag-<?php echo $tag['id']; ?>">
                                            <?php echo htmlspecialchars($tag['name']); ?>
                                        </label>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class=" btn btn-dark">save Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../Assets/script.js"></script>
</body>

</html>