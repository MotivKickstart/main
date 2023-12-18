<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>My Recipes</title>
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
  <div class="search-form">
    <div id="search-container">
      <input type="text" id="search-input" placeholder="Search for recipes">
      <button class="button button--primary" id="search-button">Search</button>
    </div>
    <div id="filter-container">
      <label for="meal-type">Meal Type:</label>
      <select id="meal-type">
        <option value="">None</option>
        <option value="Breakfast">Breakfast</option>
        <option value="Lunch">Lunch</option>
        <option value="Dinner">Dinner</option>
        <option value="Snack">Snack</option>
      </select>
      <label for="allergies">Allergies:</label>
      <select id="allergies">
        <option value="">None</option>
        <option value="gluten-free">Gluten</option>
        <option value="wheat-free">Wheat</option>
        <option value="tree-nut-free">Tree nut free</option>
        <option value="peanut-free">Peanut free</option>
      </select>
      <label for="diet">Diet:</label>
      <select id="diet">
        <option value="">None</option>
        <option value="balanced">Balanced</option>
        <option value="high-fiber">High fiber</option>
        <option value="high-protein">High protein</option>
        <option value="low-carb">Low carb</option>
        <option value="low-fat">Low fat</option>
        <option value="low-sodium">Low sodium</option>
      </select>
    </div>
  </div>
  <div id="recipe-container"></div>
  <script src="scriptRecipes.js"></script>
</body>
</html>
