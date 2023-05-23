<?php
session_start();
require_once("db.php");

// Run for candidate
if (isset($_POST['run_for_candidate'])) {

    $ConnectingDB = $GLOBALS['connexion'];
    $user_id = $_SESSION['user_id'];
    $c = "INSERT INTO candidates (candidate_id, election_id, name, photo) 
             VALUES('$user_id', '$_POST[election_id]', '$_POST[name]', '$_POST[photo]')";
    $stmt = $ConnectingDB->prepare($c);
    $stmt->execute();
    if ($stmt) {
        echo "<script>alert('Successful candidature. Wait for the admin to approve your candidature.')</script>";
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
    <link rel="stylesheet" href="/css/homepage.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <title>Be a candidate</title>
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
            <h1>Thank you for your initiative!</h1>

            <div class="col-md-6 grid-margin stretch-card">
                <div>
                    <div class="card-body">

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
                        <p class="card-description">Please fill up this form.</p>

                        <form class="forms-sample" method="post">
                            <input type="hidden" name="election_id" value="<?php echo $_POST['election_id'] ?>" />
                            <div class="form-group">
                                <label>Full name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="photo" placeholder="Photo" />
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary me-2" name="run_for_candidate"> Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

</body>

</html>