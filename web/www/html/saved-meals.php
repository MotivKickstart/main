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
    <nav>
        <ul>
            <li><a href="saved-meals.php">Saved Meails</a></li>
            <li><a href="index.php">Ingredients</a></li>
            <li><a href="recipes.php">Recipes</a></li>
        </ul>
    </nav>
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
</body>
</html>
