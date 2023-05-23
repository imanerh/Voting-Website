<?php

require_once("db.php");

session_start();

// REGISTER USER
if (isset($_POST['reg_submit'])) {

    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password_1']) && !empty($_POST['password_2'])) { // if all required fields are filled

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];

        if ($password_1 != $password_2) { // if the user confirms the passwords correctly
            echo "<script>alert('Passwords missmatched!')</script>";
            // header('location: signup.php');
        } else {

            // Check that the user does not already exist with the same username and/or email
            global $ConnectingDB;
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
            $stmt = $ConnectingDB->prepare($user_check_query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) { // if user exists
                if ($user['username'] === $username) {
                    echo "<script>alert('This username already exists!')</script>";
                    // header('location: signup.php');
                } else if ($user['email'] === $email) {
                    echo "<script>alert('Email already exists!')</script>";
                    // header('location: signup.php');
                }
            } else { // if the user doesn't exist, register the user
                //encrypt the password before saving in the database
                $hashed_password = password_hash($password_1, PASSWORD_BCRYPT);
                $add_user_query = "INSERT INTO users (username, email, upassword, statut) 
                        VALUES('$username', '$email', '$hashed_password', 'client')";
                $stmt = $ConnectingDB->prepare($add_user_query);
                $stmt->execute();
                $_SESSION['username'] = $username;
                $_SESSION['message'] = "Thank you for your registration!";

                $id_query = "SELECT * FROM users WHERE username='$username'";
                $stmt = $ConnectingDB->prepare($id_query);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['id'] = $user['user_id'];

                header('location: homepageClient.php');
            }
        }
    } else { // if some required field isn't filled
        echo "<script>alert('All fields are required!')</script>";
        // header('location: signup.php');
    }
}

// LOGIN USER
if (isset($_POST['log_submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) { // if all required fields are filled

        $query = "SELECT * FROM users WHERE username= '$username'";
        $stmt = $ConnectingDB->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) { // if username exists
            if (password_verify($password, $user['upassword'])) { // verify if the password is correct
                $_SESSION['username'] = $username;
                $_SESSION['message'] = "You are now logged in";

                $id_query = "SELECT * FROM users WHERE username='$username'";
                $stmt = $ConnectingDB->prepare($id_query);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION['id'] = $user['user_id'];

                if ($user['statut'] == 'client') {
                    header('location: homepageClient.php');
                } else {
                    header('location: homepageRes.php');
                }
            } else {
                // header('location: login.php');
                echo "<script>alert('Incorrect password!')</script>";
            }

        } else {
            // header('location: login.php');
            echo "<script>alert('Username doesn\'t exist!')</script>";
        }
    } else { // if some required field isn't filled
        // header('location: login.php');
        echo "<script>alert('All fields are required')</script>";
    }
}

?>