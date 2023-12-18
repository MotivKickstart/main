function displaySavedMeals() {
    const savedMeals = JSON.parse(localStorage.getItem('meals')) || [];
    console.log(savedMeals);
    const tableBody = document.querySelector("#saved-meals-table-body");
    tableBody.innerHTML = "";
  
    savedMeals.forEach((meal, index) => {
      const row = document.createElement("tr");
  
      const mealNameCell = document.createElement("td");
      mealNameCell.textContent = `Meal ${index + 1}`;
      row.appendChild(mealNameCell);
  
      const ingredientsCell = document.createElement("td");
      ingredientsCell.innerHTML = formatIngredients(meal.ingredients);
      row.appendChild(ingredientsCell);
  
      const caloriesCell = document.createElement("td");
      caloriesCell.textContent = typeof meal.calories === 'number' ? meal.calories.toFixed(2) : meal.calories;
      row.appendChild(caloriesCell);
  
      const fatCell = document.createElement("td");
      fatCell.textContent = typeof meal.fat === 'number' ? meal.fat.toFixed(2) : meal.fat;
      row.appendChild(fatCell);
  
      const proteinCell = document.createElement("td");
      proteinCell.textContent = typeof meal.protein === 'number' ? meal.protein.toFixed(2) : meal.protein;
      row.appendChild(proteinCell);
  
      const weightCell = document.createElement("td");
      weightCell.textContent = typeof meal.weight === 'number' ? meal.weight.toFixed(2) : meal.weight;
      row.appendChild(weightCell);
  
      tableBody.appendChild(row);
    });
  
    // Calculate the total of all meals
    const totalRow = document.createElement("tr");
  
    const totalLabelCell = document.createElement("td");
    totalLabelCell.textContent = "Total";
    totalRow.appendChild(totalLabelCell);
  
    const emptyCell = document.createElement("td");
    totalRow.appendChild(emptyCell);
  
    const totalCaloriesCell = document.createElement("td");
    const totalCalories = savedMeals.reduce((sum, meal) => sum + (typeof meal.calories === 'number' ? parseFloat(meal.calories) : 0), 0);
    totalCaloriesCell.textContent = totalCalories.toFixed(2);
    totalRow.appendChild(totalCaloriesCell);
  
    const totalFatCell = document.createElement("td");
    const totalFat = savedMeals.reduce((sum, meal) => sum + (typeof meal.fat === 'number' ? parseFloat(meal.fat) : 0), 0);
    totalFatCell.textContent = totalFat.toFixed(2);
    totalRow.appendChild(totalFatCell);
  
    const totalProteinCell = document.createElement("td");
    const totalProtein = savedMeals.reduce((sum, meal) => sum + (typeof meal.protein === 'number' ? parseFloat(meal.protein) : 0), 0);
    totalProteinCell.textContent = totalProtein.toFixed(2);
    totalRow.appendChild(totalProteinCell);
  
    const totalWeightCell = document.createElement("td");
    const totalWeight = savedMeals.reduce((sum, meal) => sum + (typeof meal.weight === 'number' ? parseFloat(meal.weight) : 0), 0);
    totalWeightCell.textContent = totalWeight.toFixed(2);
    totalRow.appendChild(totalWeightCell);
  
    tableBody.appendChild(totalRow);
  }
  
  function formatIngredients(ingredients) {
    return ingredients.map(ingredient => `<li>${ingredient}</li>`).join('');
  }
  
  displaySavedMeals();
  
  function clearLocalStorage() {
    localStorage.clear();
    displaySavedMeals();
  }