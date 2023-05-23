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
        </main>

</body>
</html>