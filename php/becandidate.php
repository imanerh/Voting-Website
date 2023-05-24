<?php
session_start();
require_once("db.php");

$ConnectingDB = $GLOBALS['connexion'];
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id='$user_id'";
$stmt = $ConnectingDB->prepare($query);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Run for candidate
if (isset($_POST['run_for_candidate'])) {

    $photo = "";
    $video = "";
    $affiche = "";

    if (!empty($_POST["photo"])) {
        $photo = $_POST["photo"];
    }
    if (!empty($_POST["program_video"])) {
        $video = $_POST["program_video"];
    }
    if (!empty($_POST["program_affiche"])) {
        $affiche = $_POST["program_affiche"];
    }

    // A candidature cannot be accepted until the candidate enters his program title and description
    if (!empty($_POST["program_title"]) && !empty($_POST["program_description"])) {

        $title = $_POST["program_title"];
        $description = $_POST["program_description"];

        // Insert the candidate and his/her program in the awaiting_candidates table
        $c = "INSERT INTO awaiting_candidates (candidate_id, election_id, name, photo, program_title, program_description, program_video, program_affiche) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        // Execute the queries
        $stmt = $ConnectingDB->prepare($c);

        $stmt->execute([$user_id, $_POST["election_id"], $user["username"], $photo, $title, $description, $video, $affiche]);

        if ($stmt) {
            echo "<script>alert('Successful candidature. Wait for the admin to approve your candidature.')</script>";
        }
    }
    else {
        echo "<script>alert('Please fill up the required fields!')</script>";
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
    <title>Be a candidate</title>
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
            <div class="">
                <div class="row">
                    <div class="card-body mx-auto col-10 col-md-8 col-lg-6">

                        <?php
                        $election_id = $_POST["election_id"];
                        $ConnectingDB = $GLOBALS['connexion'];
                        $user_id = $_SESSION['user_id'];

                        // Check if the user is already a candidate
                        $check_already_candidate = "SELECT * FROM candidates WHERE candidate_id='$user_id' AND election_id='$election_id'";
                        $stmt = $ConnectingDB->prepare($check_already_candidate);
                        $stmt->execute();

                        // Check if the user already applied for candidature and is waiting for the approval of the admin
                        $check_already_aw_candidate = "SELECT * FROM awaiting_candidates WHERE candidate_id='$user_id' AND election_id='$election_id'";
                        $stmt2 = $ConnectingDB->prepare($check_already_aw_candidate);
                        $stmt2->execute();

                        if ($stmt2->rowCount() != 0) {
                            echo "<p class='card-description'>You already applied. Wait for the approval of the admin.</p>";
                        } else if ($stmt->rowCount() != 0) {
                            echo "<p class='card-description'>You are already a candidate.";
                        } else {
                            ?>
                                <h1>Thank you for your initiative!</h1>
                                <h2><b>Election Title: </b>
                                <?php echo $_POST['election_title'] ?>
                                </h2>
                                <p><b>Description: </b>
                                <?php echo $_POST['election_description'] ?>
                                </p>
                                <p><b>Start date: </b>
                                <?php echo $_POST['election_start_date'] ?>
                                </p>
                                <p><b>End date: </b>
                                <?php echo $_POST['election_end_date'] ?>
                                </p>
                                <h3 class="card-description">Please fill up this form.</h3>

                                <form class="forms-sample" method="post">
                                    <input type="hidden" name="election_id" value="<?php echo $_POST['election_id'] ?>" />
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="photo"
                                            Placeholder="You can upload an optional photo here" />
                                    </div>
                                    <p class="card-description">Promote yourself by filling up the following about your program
                                    </p>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="program_title"
                                            Placeholder="Your program title (can be a motto for example)" required />
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="program_description"
                                            Placeholder="Briefly describe your program" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="program_video" Placeholder="Video URL" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="program_affiche"
                                            Placeholder="Program Announcement Picture URL" />
                                    </div>
                                    <button type="submit" class="btn btn-warning me-2" name="run_for_candidate"> Submit
                                    </button>
                                </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </main>

</body>

</html>