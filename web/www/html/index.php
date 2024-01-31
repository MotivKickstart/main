<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>Motiv | Motiv</title>
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
    <link rel="icon" type="image/png" sizes="192x192" href="/gfx/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/gfx/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/gfx/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/gfx/favicon/favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/gfx/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#8FC0A9">
</head>

<body>
    <div style="display: block;">
        <?php require_once('php/conn.php') ?>
    </div>
    <div class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="/gfx/logo.svg" alt="Logo">
            </a>
        </div>

        <div class="menu-icon-holder">
            <!-- <a class="menu-icon menu-icon--user" href="Account.php">
            <a class="menu-icon menu-icon--user" href="loginForm.php"> -->
            <?php
            if (isset($_SESSION['loggedin'])) {
                echo "<a class=\"menu-icon menu-icon--user\" href=\"Account.php\">";
            } else {
                echo "<a class=\"menu-icon menu-icon--user\" href=\"loginForm.php\">Login</a>";
            } ?>
            <img src="/gfx/user.svg" alt="User">
            </a>

            <div class="menu-icon" onclick="toggleMenu()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>

        <ul class="nav-list">
            <li><a href="Dispenser.php">Dispenser</a></li>
            <li><a href="ingredients.php">Meal tracking</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="saved-meals.php">Saved Meals</a></li>
            <li><a href="About.php">About</a></li>
            <!-- <li><a href="loginForm.php">login</a></li> temp links for testing
            <li><a href="registerForm.php">register</a></li> temp links for testing -->
        </ul>
    </div>

    <div class="container dashboard">
        <h1 class="title title-l title-center">Dashboard</h1>
        <a class="button button--primary" href="Dispenser.php">Dispenser</a>
        <a class="button button--primary" href="scale.php">Scale</a>
        <a class="button button--primary" href="recipes.php">Recipes</a>

        <h2 class="title title-m">Progress</h2>
        <p>Weight lost: 5kg</p>

        <h2 class="title title-m">Overview today</h2>
        <p>Calories consumed: 2000kcal</p>

        <a class="button button--primary" href="About.php">About us</a>
    </div>
    <script src="scripts/main.js"></script>
    <script src="scripts/nav.js"></script>
</body>

</html>