<?php


$UserController = new UserController();
$users = $UserController->getAllUsers();

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
                    <!-- Actions -->
                    <div class="col-sm-12 col-12 text-sm-end">
                        <div class="mx-n1">
                            <!-- <a href="#" > -->

                        </div>
                    </div>
                    <div class="card shadow border-0 mb-7">
                        <div class="table-responsive">
                            <?php if (!empty($users)): ?>

                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Photo</th>
                                            <th scope="col">FirstName</th>
                                            <th scope="col">LastName</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Telephone</th>
                                            <th scope="col">status</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td>
                                                    <img src="<?= $user->getPhoto(); ?>" alt="User Photo" class="user-photo">
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $user->getFirstname(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $user->getLastname(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $user->getEmail(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $user->getPhone(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#" name="status">
                                                        <?= $user->getStatus(); ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?= $user->getRole()->getRoleName(); ?>
                                                    </a>
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <form method="POST" action="/ModifierStatus">
                                                        <input type="hidden" name="id" value="<?= $user->getId(); ?>">
                                                        <input type="hidden" name="status" value="active">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Activer">
                                                    </form>
                                                    <form method="POST" action="/ModifierStatus">
                                                        <input type="hidden" name="id" value="<?= $user->getId(); ?>">
                                                        <input type="hidden" name="status" value="suspended">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Suspendre">
                                                    </form>
                                                    <form method="POST" action="/DeletUser">
                                                        <input type="hidden" name="id" value="<?= $user->getId(); ?>">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Supremer">
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Aucun utilisateur trouvé.</p>
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