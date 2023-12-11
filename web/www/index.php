<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motiv</title>

    <script src="scripts.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <div style="display: block;">
            <?php require_once('conn.php') ?>
        </div>
        <h1>Dashboard</h1>
    </header>

    <main>
        <?php if (isset($_SESSION['loggedin'])) {
            echo "Welcome back " .  $_SESSION['name'] . "<br>";
        } ?>
        <a href="logout.php">Logout</a>
        <div id="login">
            <h3>Login</h3>
            <?php if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            } ?>
            <form method="post" action="login.php" name="login">
                <label>Username</label>
                <input type="text" name="username" autocomplete="off" required/>
                <label>Password</label>
                <input type="password" name="password" autocomplete="off" required/>
                <input type="submit" class="button" name="loginSubmit" value="Login">
            </form>
        </div>
        <a href="register.php">register</a>
    </main>

</body>

</html>