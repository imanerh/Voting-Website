<?php
session_start();
require_once("db.php");

// Insert into cart in db
if (isset($_POST['vote_candidate'])) {

    $ConnectingDB = $GLOBALS['connexion'];
    $user_id = $_SESSION['user_id'];
    $vote = "INSERT INTO votes (user_id, election_id, vote, timestamp) 
               VALUES('$user_id', '$_POST[election_id]', '$_POST[candidate_id]')";
    $stmt = $ConnectingDB->prepare($vote);
    $stmt->execute();
    if ($stmt) {
        echo "<script>alert('Thank you for voting!')</script>";
    }
}

// View the program of the candidate
if (isset($_POST['view_program'])) {

    $candidate_id = $_POST["candidate_id"];
    $election_id = $_POST["election_id"];
    $photo = $_POST["photo"];
    $name = $_POST["name"];
    $title = $_POST["program_title"];
    $description = $_POST["program_description"];
    $video = $_POST["program_video"];
    $affiche = $_POST["program_affiche"];

    header('location: program.php?cid='.$candidate_id.'&eid='.$election_id.'&photo='.$photo.'&name='.$name.'&title='.$title.'&description='.$description.'&video='.$video.'&affiche='.$affiche);
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

            <div class="big-card-container">
                <div class="card-container">

                    <?php
                    $ConnectingDB = $GLOBALS['connexion'];
                    $user_id = $_SESSION['user_id'];

                    // Check if the user has already voted for this election
                    $check_already_voted = "SELECT * FROM votes WHERE user_id='$user_id' AND election_id='$_POST[election_id]'";
                    $stmt = $ConnectingDB->prepare($check_already_voted);
                    $stmt->execute();
                    if ($stmt->rowCount() != 0) {
                        echo "<h1>You already voted</h1>";
                    } else {
                        $candidate = $ConnectingDB->query("SELECT * FROM (candidates NATURAL JOIN programs) WHERE election_id='$_POST[election_id]'");
                        while ($c = $candidate->fetch(PDO::FETCH_ASSOC)) { 
                            // If the user is a candidate, he/she can vote on other candidates, but not on himself/herself 
                            if ($c["candidate_id"] == $user_id) {
                                continue;
                            } else {
                        ?>

                            <div class="card">
                                <h2>
                                    <?php echo $c['name']; ?>
                                </h2>

                                <?php
                                if ($c['photo']) {
                                    echo "<img src='".$c['photo']."' alt='candidate_pic'>";
                                } else {
                                    echo "<img src='../images/candidate.jpg' alt='candidate_pic'>";
                                }
                                ?>

                                <form method="POST">
                                    <input type="hidden" name="election_id" value="<?php echo $c['election_id'] ?>">
                                    <input type="hidden" name="candidate_id" value="<?php echo $c['candidate_id'] ?>">
                                    <input type="hidden" name="name" value="<?php echo $c['name'] ?>">
                                    <input type="hidden" name="photo" value="<?php echo $c['photo'] ?>">
                                    <input type="hidden" name="program_title" value="<?php echo $c['program_title'] ?>">
                                    <input type="hidden" name="program_description" value="<?php echo $c['program_description'] ?>">
                                    <input type="hidden" name="program_video" value="<?php echo $c['program_video'] ?>">
                                    <input type="hidden" name="program_affiche" value="<?php echo $c['program_affiche'] ?>">

                                    <button type="submit" id="program" name="view_program" class="btn">View Program</button>
                                    <button type="submit" id="vote" name="vote_candidate" class="btn">Vote</button>
                                </form>
                            </div>

                        <?php }}
                    } ?>
                </div>
            </div>

        </main>

</body>

</html>