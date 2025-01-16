<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Form</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center mt-4 vh-10">

    <div class="container bg-white shadow mt-4 p-4 rounded" style="max-width: 500px;">
        <h2 class="text-center text-primary mt-4 mb-4">Page login</h2>
        <form method="POST" action="/checkUserIfExiste">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Entrer votre email" required>
            </div>
            <!-- Mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Entrer votre mot de passe" required>
            </div>
            <!-- Bouton -->
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary">login Now</button>
            </div>
        </form>
    </div>

    <!-- Lien vers le JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>