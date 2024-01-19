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
    console.log(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

function displayResults(ingredients, totalNutrients) {
  const resultTableBody = document.getElementById('result-table-body');
  const totalCaloriesElement = document.getElementById('total-calories');
  const totalFatElement = document.getElementById('total-fat');
  const totalProteinElement = document.getElementById('total-protein');
  const totalWeightElement = document.getElementById('total-weight');
  const overviewLabelElement = document.getElementById('overview-label');

  resultTableBody.innerHTML = ''; // Clear previous results

  let totalCalories = 0;
  let totalFat = 0;
  let totalProtein = 0;
  let totalWeight = 0;

  ingredients.forEach(ingredient => {
    const { food, nutrients, weight } = ingredient.parsed[0];
    const name = food;
    const calories = parseFloat(nutrients.ENERC_KCAL.quantity).toFixed(2);
    const fat = parseFloat(nutrients.FAT.quantity).toFixed(2);
    const protein = parseFloat(nutrients.PROCNT.quantity).toFixed(2);
    const ingredientWeight = parseFloat(weight).toFixed(2);

    totalCalories += parseFloat(calories);
    totalFat += parseFloat(fat);
    totalProtein += parseFloat(protein);
    totalWeight += parseFloat(ingredientWeight);

    const row = document.createElement('tr');
    row.innerHTML = `<td>${name}</td><td>${calories}</td><td>${fat}</td><td>${protein}</td><td>${ingredientWeight}</td>`;
    resultTableBody.appendChild(row);
  });

  // Display total values
  totalCaloriesElement.textContent = totalCalories.toFixed(2);
  totalFatElement.textContent = totalFat.toFixed(2);
  totalProteinElement.textContent = totalProtein.toFixed(2);
  totalWeightElement.textContent = totalWeight.toFixed(2);

  // Display overview label
  const overviewText = `
    Total Fat ${totalNutrients.FAT.quantity.toFixed(2)} ${totalNutrients.FAT.unit} <br>
    Saturated Fat ${totalNutrients.FASAT.quantity.toFixed(2)} ${totalNutrients.FASAT.unit} <br>
    Trans Fat ${totalNutrients.FATRN.quantity.toFixed(2)} ${totalNutrients.FATRN.unit} <br>
    Cholesterol ${totalNutrients.CHOLE.quantity.toFixed(2)} ${totalNutrients.CHOLE.unit} <br>
    Sodium ${totalNutrients.NA.quantity.toFixed(2)} ${totalNutrients.NA.unit} <br>
    Total Carbohydrate ${totalNutrients.CHOCDF.quantity.toFixed(2)} ${totalNutrients.CHOCDF.unit} <br>
    Dietary Fiber ${totalNutrients.FIBTG.quantity.toFixed(2)} ${totalNutrients.FIBTG.unit} <br>
    Total Sugars ${totalNutrients.SUGAR.quantity.toFixed(2)} ${totalNutrients.SUGAR.unit} <br>
    Protein ${totalNutrients.PROCNT.quantity.toFixed(2)} ${totalNutrients.PROCNT.unit} <br>
    Vitamin D ${totalNutrients.VITD.quantity.toFixed(2)} ${totalNutrients.VITD.unit} <br>
    Calcium ${totalNutrients.CA.quantity.toFixed(2)} ${totalNutrients.CA.unit} <br>
    Iron ${totalNutrients.FE.quantity.toFixed(2)} ${totalNutrients.FE.unit} <br>
    Potassium ${totalNutrients.K.quantity.toFixed(2)} ${totalNutrients.K.unit}
  `;
  overviewLabelElement.innerHTML = overviewText;
}

function saveMeal() {
  const ingredientRows = document.querySelectorAll("#result-table-body tr");
  const ingredients = Array.from(ingredientRows).map(row => ({
    name: row.cells[0].textContent,
    calories: parseFloat(row.cells[1].textContent),
    fat: parseFloat(row.cells[2].textContent),
    protein: parseFloat(row.cells[3].textContent),
    weight: parseFloat(row.cells[4].textContent)
  }));

  const totalCalories = ingredients.reduce((sum, ingredient) => sum + ingredient.calories, 0);
  const totalFat = ingredients.reduce((sum, ingredient) => sum + ingredient.fat, 0);
  const totalProtein = ingredients.reduce((sum, ingredient) => sum + ingredient.protein, 0);
  const totalWeight = ingredients.reduce((sum, ingredient) => sum + ingredient.weight, 0);

  const mealData = {
    ingredients: ingredients.map(ingredient => `${ingredient.weight}g ${ingredient.name}`),
    calories: totalCalories.toFixed(2),
    fat: totalFat.toFixed(2),
    protein: totalProtein.toFixed(2),
    weight: totalWeight.toFixed(2)
  };  

  // Retrieve existing meals from local storage
  const existingMeals = JSON.parse(localStorage.getItem('meals')) || [];

  // Add the current meal to the existing meals array
  existingMeals.push(mealData);

  // Save updated meals in local storage
  localStorage.setItem('meals', JSON.stringify(existingMeals));

  displaySavedMeals();
}


