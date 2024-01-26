<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  <title>Motiv | My Recipes</title>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
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
  <div class="container padding">
    <div id="search-container">
      <input type="text" id="search-input" placeholder="Search for recipes">
      <button class="button button--primary" id="search-button">Search</button>
    </div>
    <div id="filter-container" class="padding">
      <div>
        <label for="meal-type">Meal Type:</label>
        <select id="meal-type">
          <option value="">None</option>
          <option value="Breakfast">Breakfast</option>
          <option value="Lunch">Lunch</option>
          <option value="Dinner">Dinner</option>
          <option value="Snack">Snack</option>
        </select>
      </div>
      <div>
        <label for="allergies">Allergies:</label>
        <select id="allergies">
          <option value="">None</option>
          <option value="gluten-free">Gluten</option>
          <option value="wheat-free">Wheat</option>
          <option value="tree-nut-free">Tree nut free</option>
          <option value="peanut-free">Peanut free</option>
        </select>
      </div>
      <div>
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
  </div>
  <div id="recipe-container" class="container padding"></div>
  <script src="scripts/scriptRecipes.js"></script>
  <script src="scripts/nav.js"></script>
</body>
</html>
