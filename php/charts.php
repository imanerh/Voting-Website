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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <title>Statistics</title>
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
            <canvas id="voteChart" width="404" height="404"></></canvas>

            <?php

            $conn = $GLOBALS['connexion'];
            $eid = $_POST["election_id"];
            // Retrieve the vote counts for each candidate
            $query = "SELECT c.name, COUNT(v.vote_id) AS count
                        FROM Candidates c
                        JOIN Votes v ON c.candidate_id = v.vote
                        WHERE c.election_id ='$eid' GROUP BY c.candidate_id";
            $result = $conn->query($query);

            $data = [];
            $labels = [];
            $totalVotes = 0;

            // Fetch the data and calculate the total number of votes
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row['count'];
                $labels[] = $row['name'];
                $totalVotes += $row['count'];
            }
            ?>

            <script>
                // Create the pie chart
                var ctx = document.getElementById('voteChart').getContext('2d');
                var voteChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?php echo json_encode($labels); ?>,
                        datasets: [{
                            data: <?php echo json_encode($data); ?>,
                            backgroundColor: [
                                '#c24d2c',
                                '#1a2639',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)',
                                'rgba(255, 159, 64, 0.7)'
                            ],
                            borderColor: [
                                '#c24d2c',
                                '#1a2639',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: true,
                                text: 'Voting Results'
                            }
                        },
                        aspectRatio: 2, // Set the aspect ratio to control the chart's width-to-height ratio
                    }
                });
            </script>

            <p class="text-center" style="margin-top:10px;">Total number of votes:
                <b>
                    <?php echo $totalVotes; ?> votes<b>
            </p>

        </main>
    </div>

</body>

</html>