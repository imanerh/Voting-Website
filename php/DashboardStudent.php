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
    <link rel="stylesheet" href="/css/homepage.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <title>Student Dashboard</title>
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
                    $election = $ConnectingDB->query("SELECT * FROM elections");
                    while ($e = $election->fetch(PDO::FETCH_ASSOC)) { ?>

                        <div class="card">
                            <h2>
                                <?php echo $e['title']; ?>
                            </h2>
                            <img src="../images/vote.jpg" alt="Vote">
                            <p>
                                <?php echo $e['description']; ?>
                            </p>
                            <p><b>Open from: </b>
                                <?php echo $e['start_date']; ?>
                            </p>
                            <p><b>To: </b>
                                <?php echo $e['end_date']; ?>
                            </p>
                            <form method="POST" action="vote.php">
                                <input type="hidden" name="election_id" value="<?php echo $e['election_id'] ?>">
                                <button type="submit" id="vote" name="vote">Vote</button>
                            </form>
                            <form method="POST" action="becandidate.php">
                                <input type="hidden" name="election_id" value="<?php echo $e['election_id'] ?>">
                                <input type="hidden" name="election_title" value="<?php echo $e['title'] ?>">
                                <input type="hidden" name="election_description" value="<?php echo $e['description'] ?>">
                                <input type="hidden" name="election_start_date" value="<?php echo $e['start_date'] ?>">
                                <input type="hidden" name="election_end_date" value="<?php echo $e['end_date'] ?>">
                                <button type="submit" id="vote" name="be_candidate">Be a candidate</button>
                            </form>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </main>

</body>

</html>