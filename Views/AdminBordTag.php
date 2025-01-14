<?php


$tagController = new TagController();
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
                            <?php if (!empty($tags)): ?>

                                <table class="table table-hover table-nowrap">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Descrition</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tags as $tag): ?>
                                            <tr>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?php echo $tag['name']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="text-heading font-semibold" href="#">
                                                        <?php echo $tag['description']; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <form method="POST" action="/checkToEditTag">
                                                        <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="Edit">
                                                    </form>
                                                    <form method="POST" action="/checkToDeletTag">
                                                        <input type="hidden" name="id" value="<?php echo $tag['id']; ?>">
                                                        <input type="submit" class="btn btn-sm btn-neutral" value="delete">
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>Aucun tags trouvé.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- modal pour ajouter une tags -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter Tag</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method='POST' action="/checkToAddTag">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                aria-describedby="nomUtilisateur">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description"
                                aria-describedby="nomUtilisateur">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class=" btn btn-dark">Ajouter Tag</button>
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