<?php
if (isset($_SESSION['user'])) {
    $UserName = $_SESSION['user']->getRole()->getRoleName();
    if ($UserName == 'Etudiant' || $UserName == 'Enseignant') {
        header('location: /home');
    }
}

$result = [];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = $categorieController->getCategoryById($id);

    if (!$result) {
        echo "Catégorie introuvable.";
        exit();
    }
} else {
    echo "ID de catégorie invalide.";
    exit();
}

$name = $result->getName() != null ? htmlspecialchars($result->getName()) : '';
$description = $result->getDescription() != null ? htmlspecialchars($result->getDescription()) : '';
$id = $result->getId() != null ? htmlspecialchars($result->getId()) : '';
// var_dump($id);
// die();
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
    <form class="formEdit" method='POST' action="/submitFormCateg">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $name; ?>" required>

        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input class="form-control" name="description" type="text" value="<?php echo $description; ?>" required>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </div>
        <div class="modal-footer">
            <input type="submit" value="modify" name="modify">
        </div>
    </form>
</body>

</html>