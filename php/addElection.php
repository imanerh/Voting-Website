<?php
session_start();
require_once("db.php");

// Add a new election
if (isset($_POST['confirm'])) {

    $ConnectingDB = $GLOBALS['connexion'];
    $user_id = $_SESSION['user_id'];

    if (!empty($_POST['election_id']) && !empty($_POST['election_title']) && !empty($_POST['election_description']) && !empty($_POST['election_start_date']) && !empty($_POST['election_end_date'])) { // if all required fields are filled

        $election_id = $_POST['election_id'];
        $election_title = $_POST['election_title'];
        $election_description = $_POST['election_description'];
        $election_start_date = $_POST['election_start_date'];
        $election_end_date = $_POST['election_end_date'];

        $add = "INSERT INTO elections (election_id, title, description, start_date, end_date) 
                VALUES('$election_id', '$election_title', '$election_description', '$election_start_date', '$election_end_date')";

        $stmt = $ConnectingDB->prepare($add);
        $stmt->execute();
        if ($stmt) {
            echo "<script>alert('Election added!')</script>";
        }

    }
}
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
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/admin.css">
    <title>Admin Dashboard</title>
</head>

<body>

    <div class="page-container">

        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand text-white" href="DashboardAdmin.php">University</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="DashboardAdmin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logOut.php">Log out</a>
                    </li>
                </ul>
            </div>
        </nav>


        <main class="main">
            <div class="">
                <div class="row">
                    <div class="card-body mx-auto col-10 col-md-8 col-lg-6">
                        <p class="card-description">Add a new election by filling this form</p>
                        <form class="forms-sample" method="post">
                            <div class="form-group">
                                <input class="typeahead" type="text" name="election_id" placeholder="Election Id" required>
                            </div>
                            <div class="form-group">
                                <input class="typeahead" type="text" name="election_title" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <input class="typeahead" type="text" name="election_description" placeholder="Description" required>
                            </div>
                            <div class="form-group">
                                <input class="typeahead" type="date" name="election_start_date" placeholder="Start Date" required>
                            </div>
                            <div class="form-group">
                                <input class="typeahead" type="date" name="election_end_date" placeholder="End Date" required>
                            </div>
                            <button type="submit" class="btn btn-primary me-2 bg-warning" name="confirm" style="border:none; color:black"> Add </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>