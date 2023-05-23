<?php

require_once("db.php");

session_start();

// REGISTER USER
if (isset($_POST['reg_submit'])) {

    if (!empty($_POST['user_id']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password_1']) && !empty($_POST['password_2'])) { // if all required fields are filled

        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];

        if ($password_1 != $password_2) { // if the user confirms the passwords correctly
            echo "<script>alert('Passwords missmatched!')</script>";
            // header('location: signup.php');
        } else {

            // Check that the user does not already exist with the same username and/or email
            $ConnectingDB = $GLOBALS['connexion'];
            $user_check_query = "SELECT * FROM users WHERE user_id='$user_id' OR email='$email' LIMIT 1";
            $stmt = $ConnectingDB->prepare($user_check_query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 1) { // if user exists
                if ($user['user_id'] === $user_id) {
                    echo "<script>alert('This student already exists!')</script>";
                } else if ($user['email'] === $email) {
                    echo "<script>alert('Email already exists!')</script>";
                }
            } else { // if the user doesn't exist, register the user
                //encrypt the password before saving in the database
                $hashed_password = password_hash($password_1, PASSWORD_BCRYPT);
                $add_user_query = "INSERT INTO users (user_id, username, email, password) 
                        VALUES('$user_id', '$username', '$email', '$hashed_password')";
                $stmt = $ConnectingDB->prepare($add_user_query);
                $stmt->execute();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = "Student";
                
                header('location: DashboardStudent.php');
            }
        }
    } else { // if some required field isn't filled
        echo "<script>alert('All fields are required!')</script>";
        // header('location: signup.php');
    }
}

// LOGIN USER
if (isset($_POST['log_submit'])) {

    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    if (!empty($user_id) && !empty($password)) { // if all required fields are filled

        $ConnectingDB = $GLOBALS['connexion'];
        $query = "SELECT * FROM users WHERE user_id= '$user_id'";
        $stmt = $ConnectingDB->prepare($query);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) { // if username exists
            if (password_verify($password, $user['password'])) { // verify if the password is correct
                $_SESSION['user_id'] = $user_id;
                if ($user['is_admin']) {
                    $_SESSION['role'] = "Admin";
                } else {
                    $_SESSION['role'] = "Student";
                }
                $id_query = "SELECT * FROM users WHERE user_id='$user_id'";
                $stmt = $ConnectingDB->prepare($id_query);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user['is_admin'] == true) {
                    header('location: DashboardAdmin.php');
                } else {
                    header('location: DashboardStudent.php');
                }
            } else {
                echo "<script>alert('Incorrect password!')</script>";
            }

        } else {
            echo "<script>alert('Username doesn\'t exist!')</script>";
        }
    } else { // if some required field isn't filled
        echo "<script>alert('All fields are required')</script>";
    }
}

?>