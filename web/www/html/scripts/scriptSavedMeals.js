function displaySavedMeals() {
    const savedMeals = JSON.parse(localStorage.getItem('meals')) || [];
    console.log(savedMeals);
    const recipeContainer = document.querySelector("#recipe-container");
  
    savedMeals.forEach((recipe, index) => {
        const card = document.createElement('div');
        card.classList.add('recipe-card');

        const title = document.createElement('h2');
        title.textContent = recipe.title;

        const image = document.createElement('img');
        image.src = recipe.image;

        const calories = document.createElement('p');
        calories.textContent = `Calories: ${recipe.calories}kcal`;
        calories.classList.add('label');

        const protein = document.createElement('p');
        protein.textContent = `Protein: ${recipe.protein}g`;
        protein.classList.add('label');

        //Button container
        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('button-container');

        //Recipe button
        const recipeButton = document.createElement('button');
        recipeButton.classList.add('button', 'button--primary');
        recipeButton.textContent = 'Recipe';
        recipeButton.addEventListener('click', () => {
            window.open(recipe.url);
        });

        card.appendChild(title);
        card.appendChild(image);
        card.appendChild(calories);
        card.appendChild(protein);
        buttonContainer.appendChild(recipeButton);
        card.appendChild(buttonContainer);

        recipeContainer.appendChild(card);
    });
  
    // Calculate the total of all meals
    // const totalRow = document.createElement("tr");
  
    // const totalLabelCell = document.createElement("td");
    // totalLabelCell.textContent = "Total";
    // totalRow.appendChild(totalLabelCell);
  
    // const emptyCell = document.createElement("td");
    // totalRow.appendChild(emptyCell);
  
    // const totalCaloriesCell = document.createElement("td");
    // const totalCalories = savedMeals.reduce((sum, meal) => sum + (typeof meal.calories === 'number' ? parseFloat(meal.calories) : 0), 0);
    // totalCaloriesCell.textContent = totalCalories.toFixed(2);
    // totalRow.appendChild(totalCaloriesCell);
  
    // const totalFatCell = document.createElement("td");
    // const totalFat = savedMeals.reduce((sum, meal) => sum + (typeof meal.fat === 'number' ? parseFloat(meal.fat) : 0), 0);
    // totalFatCell.textContent = totalFat.toFixed(2);
    // totalRow.appendChild(totalFatCell);
  
    // const totalProteinCell = document.createElement("td");
    // const totalProtein = savedMeals.reduce((sum, meal) => sum + (typeof meal.protein === 'number' ? parseFloat(meal.protein) : 0), 0);
    // totalProteinCell.textContent = totalProtein.toFixed(2);
    // totalRow.appendChild(totalProteinCell);
  
    // const totalWeightCell = document.createElement("td");
    // const totalWeight = savedMeals.reduce((sum, meal) => sum + (typeof meal.weight === 'number' ? parseFloat(meal.weight) : 0), 0);
    // totalWeightCell.textContent = totalWeight.toFixed(2);
    // totalRow.appendChild(totalWeightCell);
  
    // tableBody.appendChild(totalRow);
  }
  
  function formatIngredients(ingredients) {
    return ingredients.map(ingredient => `<li>${ingredient}</li>`).join('');
  }
  
  displaySavedMeals();
  
  function clearLocalStorage() {
    localStorage.clear();
    displaySavedMeals();
  }