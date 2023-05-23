<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/signupstyle.css">
    <title>Sign up</title>
</head>

<body>

    <form action="server.php" method="post">

        <h3>Sign up</h3>

        <div class="container">
            <div>
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password_1">
            </div>
            <div>
                <label>Confirm password</label>
                <input type="password" name="password_2">
            </div>
            <div>
                <button type="submit" class="btn" name="reg_submit">Sign up</button>
            </div>

        </div>

        <p>
            Already a member? <a href="../index.php">Log in</a>
        </p>

    </form>




</body>

</html>