<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    echo "<p>Hallo</p>";
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
    <div class="navbar">
        <div class="logo">
            <img src="/gfx/logo.svg" alt="Logo">
        </div>
        <div class="menu-icon" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="nav-list">
            <li><a href="saved-meals.php">Saved Meals</a></li>
            <li><a href="index.php">Ingredients</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="Dispenser.php">Dispenser</a></li>
            <li><a href="About.php">About</a></li>
            <li><a href="Account.php">Account</a></li>
        </ul>
    </div>
    <div id="register">
        <h3>Register</h3>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } ?>
        <form method="post" action="php/signup.php" name="register">
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
    <script src="scripts/nav.js"></script>
</body>

</html>