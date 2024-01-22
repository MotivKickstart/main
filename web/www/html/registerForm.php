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
    <title>Motiv | Register</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="apple-touch-icon" sizes="57x57" href="/gfx/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/gfx/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/gfx/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/gfx/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/gfx/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/gfx/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/gfx/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/gfx/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/gfx/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/gfx/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/gfx/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/gfx/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/gfx/favicon/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/gfx/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#8FC0A9">
</head>

<body>
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
        <h1 class="title title-l title-center">Create account</h1>
        <?php
        $test1 = $_SESSION['status1'];
        $test2 = $_SESSION['status2'];
        echo print_r($_SESSION['status1']);
        echo "<br>";
        echo print_r($_SESSION['status2']);
        echo "<script>console.log('$test1');</script>";
        echo "<script>console.log('$test2');</script>";
        unset($_SESSION['status']);
        if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } ?>
        <form method="post" action="php/signup.php" name="register">
            <div>
                <label>Username</label>
                <input type="text" name="username" autocomplete="off" required />
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" autocomplete="off" required />
            </div>
            <!-- <div>    
                <label>Phone number</label>
                <input type="text" name="phone" autocomplete="off" required />
            </div> -->
            <div>
                <label>Email</label>
                <input type="email" name="email" autocomplete="off" required />
            </div>
            <div>
                <label>Sport goal</label>
                <input type="checkbox" id="toggle" class="toggleCheckbox" />
                <label for="toggle" class='toggleContainer'>
                <div>Muscle growth</div>   
                <div>Lose weight</div>
                </label>
            </div>
            <div>
                <label>How many times do you sport in a week?</label>
                <input type="number" name="sport" autocomplete="off" required />
            </div>
            <div>
                <label>How many hours do you sport in a week?</label>
                <input type="number" name="sportHours" autocomplete="off" required />
            </div>
            <input type="submit" class="button button--primary" name="registerSubmit" value="Register">
        </form>
    </div>
    <script src="scripts/nav.js"></script>
</body>

</html>