<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <div style="display: block;">
        <?php require_once('conn.php') ?>
    </div>

    <div class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="/gfx/logo.svg" alt="Logo">
            </a>
        </div>
        <div class="menu-icon-holder">
            <?php if (isset($_SESSION['loggedin'])) { ?>
                <a class="menu-icon menu-icon--user" href="Account.php">
            <?php } else{ ?>
                <a class="menu-icon menu-icon--user" href="loginForm.php">
            <?php } ?>
                <img src="/gfx/user.svg" alt="User">
            </a>

            <div class="menu-icon" onclick="toggleMenu()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>
        <ul class="nav-list">
            <li><a href="saved-meals.php">Saved Meals</a></li>
            <li><a href="ingredients.php">Ingredients</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="Dispenser.php">Dispenser</a></li>
            <li><a href="About.php">About</a></li>
            <?php if (isset($_SESSION['loggedin'])) { ?>
                <li class="nav-list__login"><a href="logout.php">Logout</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="container">
        <h1 class="title title-l title-center">Login</h1>
        <?php if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } ?>
        <form method="post" action="login.php" name="login">
            <div>
                <label>Username</label>
                <input type="text" name="username" autocomplete="off" required />
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" autocomplete="off" required />
            </div>
            <input type="submit" class="button button--primary" name="loginSubmit" value="Login">
        </form>
        <h2 class="title title-m">Don't have an account?</h2>
        <a class="button button--primary" href="registerForm.php">Register</a>
    </div>
    <script src="nav.js"></script>
</body>

</html>
<!-- test -->