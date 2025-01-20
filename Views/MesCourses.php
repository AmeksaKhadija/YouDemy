<?php
if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']->getId();

    $courseController = new CourseController();
    $courses = $courseController->getCoursesForUser($userId);
} else {
    echo "Vous devez être connecté pour voir vos cours.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #5f6368;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        li h3 {
            color: #5f6368;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        li p {
            font-size: 1em;
            line-height: 1.6;
            margin: 8px 0;
        }

        li p strong {
            color: #4CAF50;
        }

        .no-courses {
            text-align: center;
            font-size: 1.2em;
            color: #ff9800;
        }

        .navv {
            /* background-color:#ff9800; */
            display: flex;
            justify-content: space-around;
        }

        .GO_back {
            /* display: block; */
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 10px;
            text-decoration: none;
            color: #333;
            border-radius: 10px;
            background-color: #5f6368;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="navv">
        <h1>Mes Cours</h1>
        <a href="/home" class="GO_back">Go Back</a>

    </div>
    <div class="container">
        <?php if (empty($courses)): ?>
            <p class="no-courses">Vous n'êtes inscrit à aucun cours.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($courses as $course): ?>
                    <li>
                        <h3><?= htmlspecialchars($course['titre']); ?></h3>
                        <p><?= htmlspecialchars($course['description']); ?></p>
                        <p><strong>Catégorie:</strong> <?= htmlspecialchars($course['categorie'] ?? 'Non définie'); ?></p>
                        <p><strong>Tags:</strong> <?= htmlspecialchars($course['tags'] ?? 'Non définis'); ?></p>
                        <a href="/home" class="GO_back">Désinscrire</a>

                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>

</html>