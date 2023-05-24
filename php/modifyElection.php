<?php
session_start();
require_once("db.php");

// Add a new election
if (isset($_POST['confirm'])) {

    $ConnectingDB = $GLOBALS['connexion'];
    $user_id = $_SESSION['user_id'];
    $election_id = $_POST["election_id"];

    if (!empty($_POST['election_title'])) {
        $election_title = $_POST['election_title'];
        $modify = "UPDATE elections SET title='$election_title' WHERE election_id = '$election_id'";
        $stmt = $ConnectingDB->prepare($modify);
        $stmt->execute();
        if ($stmt) {
            echo "<script>alert('Title modified!')</script>";
        }
    }
    if (!empty($_POST['election_description'])) {
        $election_description = $_POST['election_description'];
        $modify = "UPDATE elections SET description='$election_description' WHERE election_id = '$election_id'";
        $stmt = $ConnectingDB->prepare($modify);
        $stmt->execute();
        if ($stmt) {
            echo "<script>alert('Description modified!')</script>";
        }
    }
    if (!empty($_POST['election_end_date'])) {
        $election_end_date = $_POST['election_end_date'];
        $modify = "UPDATE elections SET end_date='$election_end_date' WHERE election_id = '$election_id'";
        $stmt = $ConnectingDB->prepare($modify);
        $stmt->execute();
        if ($stmt) {
            echo "<script>alert('End date modified!')</script>";
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
    <script src="date.js"></script>
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
            <h3 class="text-center">Modify Election
                <?php echo $_POST["election_id"]; ?>
            </h3>

            <div class="">
                <div class="row">
                    <div class="card-body mx-auto col-10 col-md-8 col-lg-6">
                        <p class="card-description">Add a new election by filling this form</p>
                        <form class="forms-sample" method="post">
                            <input type="hidden" name="election_id" value="<?php echo $_POST["election_id"]; ?>">
                            <div class="form-group">
                                <input class="typeahead" type="text" name="election_title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <input class="typeahead" type="text" name="election_description"
                                    placeholder="Description">
                            </div>
                            <div class="form-group">
                                <input class="typeahead" type="date" name="election_end_date" placeholder="End Date"
                                    id="myDate" min="yyyy-mm-dd">
                                <script>
                                    var today = new Date().toISOString().split('T')[0];
                                    document.getElementById("myDate").setAttribute("min", today);
                                </script>
                            </div>
                            <button type="submit" class="btn btn-primary me-2 bg-warning" name="confirm"
                                style="border:none; color:black"> Modify </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </div>
</body>

</html>