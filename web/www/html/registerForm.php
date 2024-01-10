<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
</head>

<body>
    <a href="index.php">Home</a>
    <div id="register">
        <h3>Register</h3>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } ?>
        <form method="post" action="signup.php" name="register">
            <label>Username</label>
            <input type="text" name="username" autocomplete="off" required />
            <label>Password</label>
            <input type="password" name="password" autocomplete="off" required />
            <label>Phone number</label>
            <input type="text" name="phone" autocomplete="off" required />
            <label>Email</label>
            <input type="email" name="email" autocomplete="off" required />
            <input type="submit" class="button" name="registerSubmit" value="Register">
        </form>
    </div>
</body>

</html>