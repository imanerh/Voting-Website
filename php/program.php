<?php
session_start();
require_once("db.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/homepage.css">
    <link rel="stylesheet" href="/css/program.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <title>Vote</title>
</head>

<body>

    <div class="page-container">

        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand text-white" href="DashboardStudent.php">University</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="DashboardStudent.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logOut.php">Log out</a>
                    </li>
                </ul>
            </div>
        </nav>


        <main class="main">
            <?php
            // Get the candidate's information
            $cid = $_GET["cid"];
            $eid = $_GET["eid"];
            $photo = $_GET["photo"];
            $name = $_GET["name"];
            $title = $_GET["title"];
            $description = $_GET["description"];
            $video = $_GET["video"];
            $affiche = $_GET["affiche"];

            //  Display the candidate's information
            ?>
            <h3>The program of
                <?php echo $name; ?>
            </h3>
            <div class="program">
                <!-- Photo upload -->
                <?php
                if ($photo) {
                    echo "<img src='" . $photo . "' alt='candidate_pic' width='300px' height='250px' class='rounded mx-auto d-block'>";
                } else {
                    echo "<img src='../images/candidate.jpg' alt='candidate_pic'>";
                }
                ?>
                <p>
                    <?php echo $title; ?>
                </p>
                <h5>
                    <?php echo $description; ?>
                </h5>
                <?php
                // Video Upload
                if ($video) {
                    echo "<p class='announcements'>Enjo watching a video of my campaign:</p>";
                    echo "<iframe width='560' height='315' src='https://www.youtube.com/embed/" . $video . "?autoplay=1' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe><br>";
                } else {
                    echo "<iframe width='560' height='315'></iframe><br>";
                }
                // Affiche Upload
                if ($affiche) {
                    echo "<p class='announcements'>The poster of my campaign:</p>";
                    echo "<img src='" . $affiche . "' alt='candidate_pic' width='300px' height='600px'>";
                } else {
                    echo "<img src='../images/poster.avif' alt='candidate_pic'>";
                }
                ?>
            </div>
        </main>

</body>

</html>