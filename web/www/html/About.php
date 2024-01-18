<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
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
        <h1 class="title title-l title-center">About us</h1>
    <p>
        Welcome to Motiv, where your health journey is our priority. At Motiv, we believe in empowering individuals to make conscious choices for a healthier and more balanced life. Our team of dedicated professionals, driven by a passion for health and innovation, has created Motiv as a comprehensive ecosystem to guide you towards your wellness goals.
    </p>
    <p>
        We understand that health is personal, and each individual has unique needs. That's why Motiv offers more than just measurement data; it provides insights, support, and inspiration for your specific health journey. Whether you're aiming for weight loss, muscle building, or overall well-being, Motiv stands by your side.
    </p>
    <p>
        Our mission is clear: to push the boundaries of health management by combining advanced technology and user-friendly designs. At Motiv, we aspire to be not just a product provider but a partner on your path to a healthier and happier life.
    </p>
    <p>
        Thank you for being part of the Motiv community. Together, we embark on a journey of discovery, every step of the way.
    </p>
    <p>
        With healthy regards,<br>
        The Movit Team
    </p>
    <script src="nav.js"></script>
</body>
</html>