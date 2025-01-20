<?php
if (isset($_SESSION['user'])) {
    $UserName = $_SESSION['user']->getRole()->getRoleName();
    if ($UserName == 'Etudiant' || $UserName == 'Enseignant') {
        header('location: /home');
    }
}

$categoriecontroller = new categorieController();
$totalcategories = $categoriecontroller->getTotalCategories();
$tagcontroller = new TagController();
$totalTags = $tagcontroller->getTotalTags();
$courseController = new CourseController();

$courses = $courseController->getTotalCourses();
$coursesCategs = $courseController->getTotalCoursesInCategorie();
$totalInscriptionInCourses = $courseController->getTotalInscriptionInCourse();
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
    <style>
        /* Style for the statistics section */
        .content {
            padding: 2rem;
            background-color: #f8f9fa;
            /* Light gray background */
        }

        .small-box {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #6c757d;
            /* Secondary color */
            color: #fff;
            /* White text */
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;

            &:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            }

            .inner {
                text-align: center;

                p {
                    font-size: 1rem;
                    margin-bottom: 0.5rem;
                    font-weight: bold;
                }

                h3 {
                    font-size: 1.5rem;
                    margin: 0;
                }
            }

            .icon {
                position: absolute;
                top: 10px;
                right: 15px;
                font-size: 2.5rem;
                opacity: 0.3;
            }
        }

        .row {
            display: flex;
            gap: 1.5rem;

            @media (max-width: 768px) {
                flex-wrap: wrap;
                gap: 1rem;
            }
        }

        /* Responsive styles for small screens */
        @media (max-width: 576px) {
            .small-box {
                padding: 1rem;

                .inner {
                    p {
                        font-size: 1rem;
                    }

                    h3 {
                        font-size: 2rem;
                    }
                }

                .icon {
                    font-size: 2rem;
                }
            }
        }
    </style>
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
            <!-- section -->
            <section class="content">

                <div class="container">
                    <!-- Small boxes (Stat box) -->

                    <div class="row mt-3 " style="display:flex;">
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <p>Total Categories</p>
                                    <h3>
                                        <?php echo $totalcategories; ?><sup style="font-size: 20px"></sup>
                                    </h3>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->

                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <p>Total Tags</p>
                                    <h3>
                                        <?php echo $totalTags; ?>
                                    </h3>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <!-- nombre total du coures  -->
                        <div class="col-sm-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <p>Total Courses</p>
                                    <h3>
                                        <?php echo $courses; ?>
                                    </h3>

                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                        </div>

                        <!-- nombre de cour dans chaque categories  -->
                        <div class="col-sm-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <p>Total Courses dans chaque categorie</p>
                                    <h3>
                                        <?php
                                        foreach ($coursesCategs as $courseCateg) {
                                            echo $courseCateg['categorieName'] . " : " . $courseCateg['total_courses'] . "<br>";
                                        }
                                        ?>
                                    </h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <p>Le cour avec le plus d' étudiants</p>
                                    <h3>
                                        <?php foreach ($totalInscriptionInCourses as $totalInscriptionInCourse) {
                                            echo $totalInscriptionInCourse['courseName'] . " : " . $totalInscriptionInCourse['ToTalStudents'] . "<br>";
                                        }
                                        ?>
                                    </h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-secondary">
                                <div class="inner">
                                    <p>Les Top 3 enseignants</p>
                                    <h3>
                                        <!-- <?php
                                                foreach ($coursesCategs as $courseCateg) {
                                                    echo $courseCateg['categorieName'] . " : " . $courseCateg['total_courses'] . "<br>";
                                                }
                                                ?> -->
                                    </h3>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../Assets/script.js"></script>
</body>

</html>