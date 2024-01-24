async function analyzeNutrition() {
  const recipe = document.getElementById('recipe').value;
  const apiKey = 'b58f95562bb3cbeacfd41fa0b11547a7';
  const apiEndpoint = 'https://api.edamam.com/api/nutrition-details';
  const apiUrl = `${apiEndpoint}?app_id=9799eefd&app_key=${apiKey}`;

  try {
    const response = await fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ ingr: recipe.split('\n') }),
    });

    if (!response.ok) {
      throw new Error('Failed to fetch nutrition data');
    }

    const data = await response.json();
    displayResults(data.ingredients, data.totalNutrients);
    saveMeal(data.ingredients, data.totalNutrients);
    console.log(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

function displayResults(ingredients, totalNutrients) {
  const result = document.getElementById('result');
  const resultCard = document.createElement('div');
  resultCard.classList.add('card');
  const ingredientsElement = document.createElement('ul');
  const totalCaloriesElement = document.createElement('p');
  totalCaloriesElement.classList.add('label');
  const totalProteinElement = document.createElement('p');
  totalProteinElement.classList.add('label');

  result.innerHTML = '';

  let totalCalories = 0;
  let totalProtein = 0;

  ingredients.forEach(ingredient => {
    const { food, nutrients, weight } = ingredient.parsed[0];
    const name = food;
    const calories = parseFloat(nutrients.ENERC_KCAL.quantity).toFixed(2);
    const fat = parseFloat(nutrients.FAT.quantity).toFixed(2);
    const protein = parseFloat(nutrients.PROCNT.quantity).toFixed(2);
    const ingredientWeight = parseFloat(weight).toFixed(2);

    totalCalories += parseFloat(calories);
    totalProtein += parseFloat(protein);

    ingredientsElement.innerHTML += `<li>${ingredientWeight}g ${name}</li>`;
  });

  // Display total values
  totalCaloriesElement.innerHTML = `Total calories: ${totalCalories.toFixed(2)}g`;
  totalProteinElement.innerHTML = `Total protein: ${totalProtein.toFixed(2)}g`;

  // Append elements to the result card
  resultCard.appendChild(ingredientsElement);
  resultCard.appendChild(totalCaloriesElement);
  resultCard.appendChild(totalProteinElement);
  result.appendChild(resultCard);
}

function saveMeal(ingredients, totalNutrients) {
  const meal = {
    ingredients: ingredients,
    totalNutrients: totalNutrients,
  };

  let meals = JSON.parse(localStorage.getItem('totals')) || [];
  meals = Array.isArray(meals) ? meals : [];
  meals.push(meal);

  localStorage.setItem('totals', JSON.stringify(meals));
  displayTotal();
}

function displayTotal() {
  const meals = JSON.parse(localStorage.getItem('totals'));
  let totalCalories = 0;
  let totalProtein = 0;

  if (Array.isArray(meals)) {
    meals.forEach(meal => {
      const { totalNutrients } = meal;
      totalCalories += parseFloat(totalNutrients.ENERC_KCAL.quantity);
      totalProtein += parseFloat(totalNutrients.PROCNT.quantity);
    });
  }

  const totalElement = document.getElementById('total');
  totalElement.innerHTML = `Total calories: ${totalCalories.toFixed(2)}g<br> Total protein: ${totalProtein.toFixed(2)}g`;
}

displayTotal();


