<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <title>Ingredients</title>
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <div style="display: block;">
        <?php require_once('conn.php')?>
    </div>
    <div class="navbar">
        <div class="logo">
            <a href="index.php">
                <a href="index.php">
                <img src="/gfx/logo.svg" alt="Logo">
            </a>
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
    
    <div class="form">
        <label for="recipe">Enter Food Items:</label>
        <textarea id="recipe" placeholder="Enter your food items, each item on a new line"></textarea>
        <button class="button button--primary" onclick="analyzeNutrition()">Analyze Nutrition</button>
    </div>
    <div id="result-container">
        <!-- Results will be displayed here dynamically -->
        <table>
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th>Calories (kcal)</th>
                    <th>Fat (g)</th>
                    <th>Protein (g)</th>
                    <th>Weight (g)</th>
                </tr>
            </thead>
            <tbody id="result-table-body">
                <!-- Ingredient details will be added here dynamically -->
            </tbody>
            <tfoot>
                <tr id="total-row">
                    <td>Total</td>
                    <td id="total-calories"></td>
                    <td id="total-fat"></td>
                    <td id="total-protein"></td>
                    <td id="total-weight"></td>
                </tr>
                <tr id="total-nutrients">
                    <td colspan="5" id="overview-label"></td>
                </tr>
            </tfoot>
        </table>
        <button class="button button--primary" onclick="saveMeal()">Save meal +</button>
    </div>
    <script src="main.js"></script>
    <script src="nav.js"></script>
</body>

</html>