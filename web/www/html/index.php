<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>Motiv</title>
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <div style="display: block;">
        <?php require_once('conn.php')?>
    </div>
    <div class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="/gfx/logo.svg" alt="Logo">
            </a>
        </div>
        <div class="menu-icon" onclick="toggleMenu()">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="nav-list">
            <li><a href="saved-meals.php">Saved Meals</a></li>
            <li><a href="ingredients.php">Ingredients</a></li>
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
    
    <div class="container dashboard"> 
        <h1 class="title title-l title-center">Dashboard</h1>
        <a class="button button--primary" href="Dispenser.php">Dispenser</a>
        <a class="button button--primary" href="">Scale</a>
        <a class="button button--primary" href="recipes.php">Recipes</a>

        <h2 class="title title-m">Progress</h2>
        <p>Weight lost: 5kg</p>

        <h2 class="title title-m">Overview today</h2>
        <p>Calories consumed: 2000kcal</p>

        <a class="button button--primary" href="About.php">About us</a>
    </div>
    <script src="main.js"></script>
    <script src="nav.js"></script>
</body>

</html>