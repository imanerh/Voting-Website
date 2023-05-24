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
    <link rel="stylesheet" href="/css/navbar.css">
    <!-- <script src="../Javascript/closeElection.js"></script> -->
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

            <form method="POST" action="addElection.php">
                <button type="submit" name="add" class="btn" id="admin_btn">Add a new election</button>
            </form>

            <form method="POST" action="awaiting_candidates.php">
                <button type="submit" name="view_cand" class="btn" id="admin_btn">View candidature Applications</button>
            </form>

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
                            <h3>Code:
                                <?php echo $e["election_id"]; ?>
                            </h3>
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
                            <form method="POST" action="modifyElection.php">
                                <input type="hidden" name="election_id" value="<?php echo $e["election_id"]; ?>">
                                <button type="submit" name="modify" class="btn">Modify</button>
                            </form>
                            <form method="post" action="deleteElection.php">
                                <input type="hidden" name="election_id" value="<?php echo $e["election_id"]; ?>">
                                <button type="submit" id="delete" name="delete" class="btn">Delete</button>
                            </form>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </main>
    </div>

</body>

</html>