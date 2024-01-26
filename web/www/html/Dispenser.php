<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motiv | Dispenser</title>
    <link rel="stylesheet" href="/css/main.css">
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
            <li><a href="Dispenser.php">Dispenser</a></li>
            <li><a href="ingredients.php">Meal tracking</a></li>
            <li><a href="recipes.php">Recipes</a></li>
            <li><a href="saved-meals.php">Saved Meals</a></li>
            <li><a href="About.php">About</a></li>
            <?php if (isset($_SESSION['loggedin'])) { ?>
                <li class="nav-list__login"><a href="/php/logout.php">Logout</a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="container"> 
        <h1 class="title title-l title-center">Dispenser</h1>
        <button class="button button--primary" onclick="">Dispense</button>
        <div class="checkboxContainer">
            <input type="checkbox" id="autoDispense" name="autoDispense" value="autoDispense">
            <label for="autoDispense">Auto Dispense</label>
        </div>
        <div class="alarms">
            <h2 class="title title-m">Alarms</h2>
            <form>
                <input type="time" id="alarm" name="alarm" value="">
                <input class="button button--primary" type="submit" value="Add Alarm">
            </form>
            <div class="alarmsContainer">
                <p class="alarm">11:00</p>
            </div>
        </div>
    </div>

    <script src="scripts/nav.js"></script>
    <script src="scripts/dispenser.js"></script>
</body>
</html>