
// Function to fetch recipes from the Edamam API
async function fetchRecipes() {
    const appId = 'e2a1cbc9';
    const appKey = '33131d41aff0f668ba3dee8575979a61';
    const query = document.getElementById('search-input').value;
    const allergies = document.getElementById('allergies').value;
    const nutrients = document.getElementById('diet').value;
    let apiUrl = `https://api.edamam.com/api/recipes/v2?type=public&q=${query}&app_id=${appId}&app_key=${appKey}`;

    if (allergies) {
        apiUrl += `&health=${allergies}`;
    }

    if (nutrients) {
        apiUrl += `&diet=${nutrients}`;
    }

    try {
        const response = await fetch(apiUrl);
        const data = await response.json();
        return data.hits;
    } catch (error) {
        console.error('Error fetching recipes:', error);
        return [];
    }
}

// Function to display recipes in HTML cards
function displayRecipes(recipes) {
    const recipeContainer = document.getElementById('recipe-container');
    recipeContainer.innerHTML = ''; // Clear previous results

    recipes.forEach((recipe, index) => {
        const card = document.createElement('div');
        card.classList.add('recipe-card');

        const title = document.createElement('h2');
        title.textContent = recipe.recipe.label;

        const image = document.createElement('img');
        image.src = recipe.recipe.image;

        const calories = document.createElement('p');
        calories.textContent = `Calories: ${recipe.recipe.calories.toFixed(2)}kcal`;
        calories.classList.add('label');

        const protein = document.createElement('p');
        protein.textContent = `Protein: ${recipe.recipe.totalNutrients.PROCNT.quantity.toFixed(2)} ${recipe.recipe.totalNutrients.PROCNT.unit}`;
        protein.classList.add('label');

        //Button container
        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('button-container');

        //Recipe button
        const recipeButton = document.createElement('button');
        recipeButton.classList.add('button', 'button--primary');
        recipeButton.textContent = 'Recipe';
        recipeButton.addEventListener('click', () => {
            window.open(recipe.recipe.url);
        });

        // Save button
        const saveButton = document.createElement('button');
        saveButton.classList.add('button', 'button--secondary');
        saveButton.textContent = 'Save';
        saveButton.addEventListener('click', () => {
            saveRecipeToLocalStorage(recipe.recipe);
            saveRecipeToDatabase(recipe.recipe);
        });

        card.appendChild(title);
        card.appendChild(image);
        // card.appendChild(ingredients);
        card.appendChild(calories);
        card.appendChild(protein);
        // card.appendChild(fat);
        buttonContainer.appendChild(recipeButton);
        buttonContainer.appendChild(saveButton);
        card.appendChild(buttonContainer);

        recipeContainer.appendChild(card);
    });
}

// Function to save recipe to local storage
function saveRecipeToLocalStorage(recipe) {
    const savedRecipeDetails = {
        title: recipe.label,
        calories: recipe.calories.toFixed(2),
        protein: recipe.totalNutrients.PROCNT.quantity.toFixed(2),
        image: recipe.image
    };

    console.log(savedRecipeDetails);

    // Retrieve existing meals from local storage
    const existingMeals = JSON.parse(localStorage.getItem('meals')) || [];

    // Add the current meal to the existing meals array
    existingMeals.push(savedRecipeDetails);

    // Save updated meals in local storage
    localStorage.setItem('meals', JSON.stringify(existingMeals));
}

function saveRecipeToDatabase(recipe) {
    const savedRecipeDetails = {
        name: recipe.label,
        ingredients: recipe.ingredients.map(ingredient => ingredient.text),
        calories: recipe.calories,
        protein: recipe.totalNutrients.PROCNT.quantity,
        fat: recipe.totalNutrients.FAT.quantity,
        weight: recipe.totalWeight
    };

    $.ajax({
        type: 'post',
        url: 'php/saveMeal.php',
        data: {
            payLoad: JSON.stringify(savedRecipeDetails)
        },
        success: function (data) {
            console.log(data);
        }
    });

}

const searchButton = document.getElementById('search-button');
searchButton.addEventListener('click', () => {
    fetchRecipes()
        .then((recipes) => {
            console.log('Recipes:', recipes);
            displayRecipes(recipes);
            const recipeContainer = document.getElementById('recipe-container');
            recipeContainer.scrollIntoView({ behavior: 'smooth' });
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});





