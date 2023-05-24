<?php
session_start();
require_once("db.php");

$ConnectingDB = $GLOBALS['connexion'];

// If the candidate is accepted
if (isset($_POST['accept_candidate'])) {

    $candidate_id = $_POST["candidate_id"];
    $election_id = $_POST["election_id"];
    $name = $_POST["name"];
    $photo = $_POST["photo"];
    $title = $_POST["program_title"];
    $description = $_POST["program_description"];
    $video = $_POST["program_video"];
    $affiche = $_POST["program_affiche"];

    // Add the candidate to the candidates table and his/her program to the programs table
    $make_candidate = "INSERT INTO candidates (candidate_id, election_id, name, photo) 
             VALUES('$candidate_id', '$election_id', '$name', '$photo')";
    $stmt = $ConnectingDB->prepare($make_candidate);
    $stmt->execute();

    // Save his/her program in the programs table
    $p = "INSERT INTO programs (candidate_id, program_title, program_description, program_video, program_affiche) VALUES(?, ?, ?, ?, ?)";
    $stmt1 = $ConnectingDB->prepare($p);
    $stmt1->execute([$candidate_id, $title, $description, $video, $affiche]);

    // Remove the candidate from the awaiting_candidates table
    $remove_awaiting = "DELETE FROM awaiting_candidates WHERE candidate_id='$candidate_id' AND election_id='$election_id'";
    $stmt2 = $ConnectingDB->prepare($remove_awaiting);
    $stmt2->execute();

    if ($stmt && $stmt1 && $stmt2) {
        echo "<script>alert('Candidate Accepted!')</script>";
    }
}

// If the candidate is rejected
if (isset($_POST['reject_candidate'])) {

    $candidate_id = $_POST["candidate_id"];
    $election_id = $_POST["election_id"];

    // Remove the candidate from the awaiting_candidates table
    $remove_awaiting = "DELETE FROM awaiting_candidates WHERE candidate_id='$candidate_id' AND election_id='$election_id'";
    $stmt = $ConnectingDB->prepare($remove_awaiting);
    $stmt->execute();

    if ($stmt) {
        echo "<script>alert('Candidate Rejected!')</script>";
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
    <link rel="stylesheet" href="/css/tables.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/admin.css">
    <!-- <script src="../Javascript/closeElection.js"></script> -->
    <title>Candidates</title>
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


            <?php
            // Display the candidates that are to be confirmed/rejected by the admin
            $ConnectingDB = $GLOBALS['connexion'];
            $q = "SELECT * FROM elections NATURAL JOIN awaiting_candidates";
            $stmt = $ConnectingDB->prepare($q);
            $stmt->execute();
            if ($stmt->rowCount() != 0) { // If the cart is not empty
                echo "<table class='table table-striped' >";
                echo "<tr><th>Candidate Id</th><th>Candidate Name</th><th>Picture</th><th>Election title</th><th>Election Description</th><th>Program Title</th><th>Program Description</th><th>Video</th><th>Affiche</th><th>Action</th></tr>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["candidate_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["photo"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["program_title"] . "</td>";
                    echo "<td>" . $row["program_description"] . "</td>";
                    echo "<td>" . $row["program_video"] . "</td>";
                    echo "<td>" . $row["program_affiche"] . "</td>";
                    echo "<td>"
                        ?>
                    <form method="post">
                        <input type="hidden" name="candidate_id" value="<?php echo $row["candidate_id"]; ?>">
                        <input type="hidden" name="election_id" value="<?php echo $row["election_id"]; ?>">
                        <input type="hidden" name="name" value="<?php echo $row["name"]; ?>">
                        <input type="hidden" name="photo" value="<?php echo $row["photo"]; ?>">
                        <input type="hidden" name="program_title" value="<?php echo $row["program_title"]; ?>">
                        <input type="hidden" name="program_description" value="<?php echo $row["program_description"]; ?>">
                        <input type="hidden" name="program_video" value="<?php echo $row["program_video"]; ?>">
                        <input type="hidden" name="program_affiche" value="<?php echo $row["program_affiche"]; ?>">
                        <div style="display:inline;">
                            <button type="submit" class="reject_btn btn" name="reject_candidate">
                                <i class="delete-icon material-icons">delete</i>
                            </button>
                            <button type="submit" class="accept_btn btn" name="accept_candidate">
                                <i class="delete-icon material-icons">check</i>
                            </button>
                        </div>
                    </form>
                    <?php
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else { // If there are no candidates
                echo "<p class='empty_cart'>There are no candidates!</p>";
            }
            ?>

        </main>
    </div>

</body>

</html>