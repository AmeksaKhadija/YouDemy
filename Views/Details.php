<?php

$result = [];

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $courseController = new CourseController();
    // $courses = $courseController->getAllCourse();
    $result = $courseController->getCourseById($id);

    if (!$result) {
        echo "Course introuvable.";
        exit();
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
    <title>edit page</title>
    <link rel="stylesheet" href="./../Assets/style.css">
</head>

<body>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo $result['titre']; ?></div>
                <div class="card-body">
                    <div class="row">
                        <div class="image col-md-4">
                            <img src="<?php echo $result['contenu']; ?>" alt="course Image" class="img-fluid"
                                style="height: 100%; width: 100%;">
                        </div>
                        <div class="col-md-8">
                            <h5 class="custom-h5-color">Description:</h5>
                            <p><?php echo $result['description']; ?></p>
                            <h6 class="custom-h5-color">Categorie:</h6>
                            <p><?php echo $result['categorie']; ?></p>
                            <h5 class="custom-h5-color">Tags:</h5>
                            <p><?php echo $result['tagss']; ?></p>
                            <a href="/home" class="btn btn-success mt-5">Go Back</a>
                            <form action="{{ route('addToCart') }}" method="POST" style="display: inline;" enctype="multipart/form-data">
                                <button type="submit" class="btn btn-outline-secondary float-right mt-5">insription à ce cour..</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>