<?php
if (isset($_SESSION['user'])) {
    $UserName = $_SESSION['user']->getRole()->getRoleName();
    if ($UserName == 'Etudiant') {
       header('location: /home');
    }else if ($UserName == 'Admin') {
        header('location: /AdminStatistics');
    }
    }

$categorieController = new categorieController();
$categories = $categorieController->getAllCategories();
$tagController = new tagController();
$tags = $tagController->getAllTags();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $courseController = new CourseController();
    $result = $courseController->getCourseById($id);
    
    if (!$result) {
        echo "Course introuvable.";
        exit();
    }
} else {
    echo "ID du Cour invalide.";
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
    <form class="formEdit" method='POST' action="/submitFormEdite">
        <input type="hidden" name="id" value="<?= $result->getId(); ?>">
        
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de cour</label>
            <input type="text" class="form-control" name="titre" id="titre"
                value="<?= $result->getTitre(); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="description_courte" class="form-label">Description courte</label>
            <input type="text" class="form-control" name="description_courte" id="description_courte"
                value="<?= $result->getDescriptionCourte(); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description complet du cour</label>
            <input type="text" class="form-control" name="description" id="description"
                value="<?= $result->getDescription(); ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>
            <input type="file" class="form-control" name="contenu" id="contenu">
        </div>
        
        <div class="mb-3">
            <label for="id_categorie" class="form-label">Catégorie</label>
            <select class="form-select" name="id_categorie" id="id_categorie" required>
                <?php foreach ($categories as $categorie) : ?>
                    <option value="<?php echo $categorie['id']; ?>" 
                            <?= ($result->getIdCategorie() == $categorie['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($categorie['name']); ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Tags</label>
            <div class="form-check">
                <?php 
                $courseTags = explode(',', $result->getTags());
                foreach ($tags as $tag) : ?>
                    <div>
                        <input class="form-check-input" type="checkbox" name="tags[]"
                            value="<?php echo $tag['id']; ?>" 
                            id="tag-<?php echo $tag['id']; ?>"
                            <?= in_array($tag['name'], $courseTags) ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="tag-<?php echo $tag['id']; ?>">
                            <?php echo htmlspecialchars($tag['name']); ?>
                        </label>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">Modifier le cours</button>
        </div>
    </form>
</body>
</html>