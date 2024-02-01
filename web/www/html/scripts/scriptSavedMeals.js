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
  }
  
  function formatIngredients(ingredients) {
    return ingredients.map(ingredient => `<li>${ingredient}</li>`).join('');
  }
  
  displaySavedMeals();
  
  function clearLocalStorage() {
    localStorage.clear();
    displaySavedMeals();
  }