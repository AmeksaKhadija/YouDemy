<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center mt-4 align-items-center vh-10">

    <div class="container bg-white shadow mt-4 p-4 rounded" style="max-width: 600px;">
        <h2 class="text-center text-primary mt-4 mb-4">Page register</h2>
        <form method="POST" action="/checkToAddUser">
                <!-- Prénom -->
                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Entrer votre prénom" required>
                </div>
                <!-- Nom -->
                <div class="mb-3">
                    <label for="lastname" class="form-label">Nom</label>
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Entrer votre nom" required>
                </div>
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Entrer votre email" required>
                </div>
                <!-- Mot de passe -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Entrer votre mot de passe" required>
                </div>
                <!-- Téléphone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="phone" id="phone" name="phone" class="form-control" placeholder="Entrer votre numéro de téléphone" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" id="photo" name="photo" class="form-control" placeholder="Telecharger votre photo" required>
                </div>
                <!-- Étudiant / Enseignant -->
                <div class="mb-3">
                    <label class="form-label">Role</label><br>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="role" name="role" value="Etudiant" class="form-check-input">
                        <label for="etudiant" class="form-check-label">Étudiant</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="role" name="role" value="Enseignant" class="form-check-input">
                        <label for="enseignant" class="form-check-label">Enseignant</label>
                    </div>
                </div>
            <!-- Bouton -->
            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary">Register Now</button>
            </div>
            <!-- Lien vers Login -->
            <div class="text-center mt-3">
                <h3 class="fs-6">Already have an account? <a href="/Login" class="text-primary">Login now</a></h3>
            </div>
        </form>
    </div>

    <!-- Lien vers le JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>