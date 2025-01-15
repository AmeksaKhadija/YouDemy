<?php

$courseController = new CourseController();
$courses = $courseController->getAllCourse();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Courses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        header {
            display: flex;
            justify-content: space-around;
            background-color: #1c1e21;
            color: white;
        }

        .login_register {
            margin: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #ff6b6b;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff5252;
        }
    </style>
</head>

<body>
    <header class="text-center py-4">
        <div class="header_title">
            <h1>Explore our Courses</h1>
            <p class="mb-0">Find the perfect course for your next step in learning</p>
        </div>
        <div class="login_register">
            <a href="/login"><button class="btn btn-primary">Login</button></a>
            <a href="/register"><button class="btn btn-primary">Register</button></a>
        </div>
    </header>

    <main class="container my-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php if (!empty($courses)): ?>
                <!-- Card 1 -->
                <div class="col">
                    <div class="card h-100">
                        <?php foreach ($courses as $course): ?>
                            <img src="<?php echo $course['contenu'] ?>" class="card-img-top" alt="Course Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $course['titre']; ?></h5>
                                <p class="card-text"><?php echo $course['description_courte'] ?></p>
                                <p class="card-text"><?php echo $course['categorie'] ?></p>
                                <p class="card-text"><?php echo $course['tagss'] ?></p>
                                <p class="text-muted">4.8 ⭐ (2,345 ratings)</p>
                            </div>

                            <form method="POST" action="/checkToViewDetail">
                                <div class="card-footer text-center">
                                    <input type="submit" class="btn btn-primary" value="SEE MORE">
                                    <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p>Aucun courses trouvé.</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>