<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/loginstyle.css">
    <title>Login Page</title>
</head>

<body>

    <form method="post" action="php/server.php">

        <h3>Login</h3>

        <div class="container">
            <div>
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div>
            <div>
                <button type="submit" class="btn" name="log_submit">Login</button>
            </div>
        </div>

        <p>
            Not yet a member? <a href="php/signup.php">Sign up</a>
        </p>

    </form>
</body>

</html>