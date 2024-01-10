<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Motiv</title>
    <link rel="stylesheet" href="/css/main.css">
</head>

<body>
    <div style="display: block;">
        <?php require_once('conn.php')?>
    </div>
    <nav>
        <ul>
            <li><a href="saved-meals.php">Saved Meals</a></li>
            <li><a href="index.php">Ingredients</a></li>
            <li><a href="recipes.php">Recipes</a></li>
        </ul>
    </nav>
    <?php if (isset($_SESSION['loggedin'])) {
        echo "Welcome back " . $_SESSION['name'] . "<br>";
        echo "<a href=\"logout.php\">Logout</a>";
    } else{
        echo "<a href=\"loginForm.php\">login</a>";
        echo "<a href=\"registerForm.php\">register</a>";
    } ?>
    
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
</body>

</html>