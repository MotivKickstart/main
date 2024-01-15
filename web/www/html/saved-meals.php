<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saved Meals</title>
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
    <div id="saved-meals-container">
        <h2>Saved Meals</h2>
        <table>
            <thead>
            <tr>
                <th>Meal Name</th>
                <th>Ingredients</th>
                <th>Calories (kcal)</th>
                <th>Fat (g)</th>
                <th>Protein (g)</th>
                <th>Weight (g)</th>
            </tr>
            </thead>
            <tbody id="saved-meals-table-body">
            <!-- Saved meal details will be added here dynamically -->
            </tbody>
        </table>
        <button class="button button--primary" onclick="clearLocalStorage()">Clear Local Storage</button> <!-- Added button to trigger clearLocalStorage -->
    </div>
    <script src="scriptSavedMeals.js"></script>
    <script src="nav.js"></script>
</body>
</html>
