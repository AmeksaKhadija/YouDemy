<?php
if (isset($_SESSION['user'])) {
    $UserName = $_SESSION['user']->getRole()->getRoleName();
    $enseignant_id = $_SESSION['user']->getId();

    if ($UserName == 'Etudiant') {
        header('location: /home');
    } else if ($UserName == 'Admin') {
        header('location: /AdminStatistics');
    }
}

$courController = new CourseController();
$courses = $courController->getCoursAndNumbreInscription();
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
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight">
                                    <img src="./../Assets/images/Blue White Minimalist Initial Academy Logo.png" width="40"> YouDemy
                                </h1>

                            </div>

                        </div>
                        <!-- Nav -->
                        <ul class="nav nav-tabs mt-4 overflow-x border-0">
                            <!-- <li class="nav-item ">
                                <a href="#" class="nav-link active">All files</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </header>
            <main class="py-6 bg-surface-secondary">
                <div class="container mt-5">
                    <h2 class="mb-4">Mes Cours</h2>

                    <div class="row">
                        <?php if (!empty($courses)): ?>
                            <?php foreach ($courses as $course): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($course->getTitre()) ?></h5>
                                            <p class="card-text"><?= htmlspecialchars($course->getDescriptionCourte()) ?></p>

                                            <div class="mt-3">
                                                <span class="badge bg-primary"><?= htmlspecialchars($course->getCategorie()) ?></span>
                                                <?php if ($course->getTags()): ?>
                                                    <?php foreach (explode(', ', $course->getTags()) as $tag): ?>
                                                        <span class="badge bg-secondary"><?= htmlspecialchars($tag) ?></span>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <div class="mt-3">
                                                <strong>Inscriptions:</strong>
                                                <span class="badge bg-success"><?= $course->nombre_inscriptions ?> étudiants</span>
                                            </div>

                                            <div class="mt-3">
                                                <span class="badge bg-<?= $course->getStatus() === 'active' ? 'success' : 'warning' ?>">
                                                    <?= htmlspecialchars($course->getStatus()) ?>
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <div class="alert alert-info">
                                    Vous n'avez pas encore créé de cours.
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>