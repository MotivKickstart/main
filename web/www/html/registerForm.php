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
    <link rel="stylesheet" href="/css/main.css">
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
            <?php if (isset($_SESSION['loggedin'])) { ?>
                <!-- // echo "Welcome back " . $_SESSION['name'] . "<br>"; -->
                <li><a href="Account.php">Account</a></li>
                <li class="nav-list__login"><a href="logout.php">Logout</a></li>
            <?php } else{ ?>
                <li class="nav-list__login"><a href="loginForm.php">Login</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="container">
        <h1 class="title title-l title-center">Register</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } ?>
        <form method="post" action="signup.php" name="register">
            <div>
                <label>Username</label>
                <input type="text" name="username" autocomplete="off" required />
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" autocomplete="off" required />
            </div>
            <div>    
                <label>Phone number</label>
                <input type="text" name="phone" autocomplete="off" required />
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" autocomplete="off" required />
            </div>
            <input type="submit" class="button button--primary" name="registerSubmit" value="Register">
        </form>
    </div>
    <script src="nav.js"></script>
</body>

</html>