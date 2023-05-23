<?php
session_start();
require_once("db.php");

// Insert into cart in db
if (isset($_POST['vote_candidate'])) {

      $ConnectingDB = $GLOBALS['connexion'];
      $user_id = $_SESSION['user_id'];
      $vote = "INSERT INTO votes (user_id, election_id, vote) 
               VALUES('$user_id', '$_POST[election_id]', '$_POST[candidate_id]')";
      $stmt = $ConnectingDB->prepare($vote);
      $stmt->execute();
      if ($stmt) {
        echo "<script>alert('Thank you for voting!')</script>";
      }
}

// View the program of the candidate
if (isset($_POST['view_program'])) {
    header('location: program.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/homepage.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <title>Vote</title>
</head>

<body>

    <div class="page-container">

        <nav class="nav">
            <div class="nav__border"></div>
            <a href="DashboardStudent.php" class="nav__link">
                <div class="nav__icon-container">
                    <i class="material-icons">home</i>
                </div>
                <span class="nav__label">Home</span>
            </a>
            <a href="logOut.php" class="nav__link">
                <div class="nav__icon-container">
                    <i class="material-icons">power_settings_new</i>
                </div>
                <span class="nav__label">Log Out</span>
            </a>
        </nav>
        <script>
            // Navigation
            {
                const collapsedClass = "nav--collapsed";
                // To save the state of the navbar (collapsed/not collapsed) upon refresh
                const lsKey = true;
                const nav = document.querySelector(".nav");
                const navBorder = nav.querySelector(".nav__border");
                if (localStorage.getItem(lsKey) === "true") {
                    nav.classList.add(collapsedClass);
                }
                navBorder.addEventListener("click", () => {
                    nav.classList.toggle(collapsedClass);
                    // lsKey is set to true if nav is collapsed, otherwise false
                    localStorage.setItem(lsKey, nav.classList.contains(collapsedClass));
                });
            }
        </script>

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
                        $candidate = $ConnectingDB->query("SELECT * FROM candidates WHERE election_id='$_POST[election_id]'");
                        while ($c = $candidate->fetch(PDO::FETCH_ASSOC)) { ?>

                            <div class="card">
                                <h2>
                                    <?php echo $c['name']; ?>
                                </h2>

                                <?php 
                                    if ($c['photo']) {
                                        echo "<img src='../images/' alt='candidate_pic'>";
                                    } else {
                                        echo "<img src='../images/candidate.jpg' alt='candidate_pic'>";
                                    }
                                ?>

                                <form method="POST">
                                    <input type="hidden" name="election_id" value="<?php echo $c['election_id'] ?>">
                                    <input type="hidden" name="candidate_id" value="<?php echo $c['candidate_id'] ?>">
                                    <button type="submit" id="program" name="view_program">View Program</button>
                                    <button type="submit" id="vote" name="vote_candidate">Vote</button>
                                </form>
                            </div>

                    <?php } }?>
                </div>
            </div>

        </main>

</body>

</html>