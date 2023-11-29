$(document).ready(function () {
  if ($("#recipe-name").length > 0) {
    setRecipeDetails();
  }
  if ($("#meal-plan").length > 0) {
    var weekNumber = 1;
    var excluded_ingredients = [];

    excluded_ingredients = getExcludedIngredients();
    getMealPlan(weekNumber);
    $(".editable-field").on("keypress", function (e) {
      if (e.keyCode == 13) {
        var editableField = $(this);
        var fieldValue = editableField.val();
        var fieldName = editableField.attr("name");
        if (!validateUserInput(fieldName, fieldValue)) {
          return;
        }
        editableField.prop("readonly", true);
        sendUserData(fieldName, fieldValue);
      }
    });
    // Event listener for clicking the edit icon
    $(".editable-field").focusout(function () {
      const editableField = $(this);
      var fieldValue = editableField.val();
      var fieldName = editableField.attr("name");
      if (!validateUserInput(fieldName, fieldValue)) {
        return;
      }
      editableField.prop("readonly", true);
      sendUserData(fieldName, fieldValue);
    });

    // Event listener for clicking the generate meal plan button
    $("#generate-meal-plan").on("click", function () {
      getMealPlan(weekNumber);
    });

    //Event listener for changing the activity level field
    $("select").change(function () {
      var optionSelected = $(this).find("option:selected");
      var fieldName = $(this).attr("name");
      var fieldValue = optionSelected.val();
      sendUserData(fieldName, fieldValue);
    });

    // Select the node that will be observed for mutations
    const targetNode = document.getElementById("meal-plan");
    // Options for the observer (which mutations to observe)
    const config = { childList: true, subtree: true };

    // Callback function to execute when mutations are observed
    const callback = (mutationList, observer) => {
      $(".meal-item").on("click", function () {
        var recipeId = $(this).attr("id");
        $.ajax({
          url:
            "https://api.spoonacular.com/recipes/" +
            recipeId +
            "/information?apiKey=" +
            ajax_admin_url.api_key +
            "&includeNutrition=false",
          dataType: "json",
          method: "GET",
          data: {},
          async: false,
          success: function (result) {
            localStorage.setItem("recipe", JSON.stringify(result));
            window.location.href = "/recipe-details/";
          },
          error: function (error) {
            alert("The API limit has reached for today.");
          },
        });
      });
    };

    // Create an observer instance linked to the callback function
    const observer = new MutationObserver(callback);

    // Start observing the target node for configured mutations
    observer.observe(targetNode, config);

    $(document).on("elementor/popup/show", (event, id, instance) => {
      if (id === 1717) {
        $(".tab-ingredients").each(function () {
          var ingredient = $(this).attr("id");
          if (excluded_ingredients.includes(ingredient)) {
            $(this).css({ opacity: "0.5" });
          }
        });
        // Event listener for clicking the items
        $(".tab-ingredients").on("click", function () {
          var selectedIngredients = $(this).attr("id");

          if (!excluded_ingredients.includes(selectedIngredients)) {
            excluded_ingredients.push(selectedIngredients);
            $(this).css({ opacity: "0.5" });
          } else {
            excluded_ingredients.splice(
              excluded_ingredients.indexOf(selectedIngredients),
              1
            );
            $(this).css({ opacity: "1" });
          }
        });
        // Event listener for clicking the exclude button and sending the excluded ingredients to the server
        $("#exclude-ingredients").on("click", function () {
          //Send excluded ingredients to server
          $.ajax({
            url: ajax_admin_url.ajax_url,
            dataType: "json",
            method: "POST",
            data: {
              action: "exclude_ingredients",
              excluded_ingredients: excluded_ingredients,
              call_type: "add",
            },
            success: function (result) {
              document.querySelector(".dialog-close-button").click();
              console.log(result);
            },
          });
        });
      }
    });

    $("#right-arrow").on("click", function () {
      if (weekNumber == 8) {
        alert("You have reached the end of the plan");
        return;
      }
      $(this).css("color", "black");
      $("#left-arrow").css("color", "black");
      if (weekNumber == 7) {
        $(this).css("color", "grey");
      }
      weekNumber++;
      $("#week-number").text("Week " + weekNumber);
      getMealPlan(weekNumber);
    });

    $("#left-arrow").on("click", function () {
      if (weekNumber == 1) {
        alert("You have reached the beginning of the plan");
        return;
      }
      $("#right-arrow").css("color", "black");
      $(this).css("color", "black");
      if (weekNumber == 2) {
        $(this).css("color", "grey");
      }
      weekNumber--;
      $("#week-number").text("Week " + weekNumber);
      getMealPlan(weekNumber);
    });
  }
});

$(document).on("click", "#gform_submit_button_1", function (e) {
  var formData = jQuery("#gform_1").serializeArray();
  sendQuizData(formData);
});

/**
 * Get recipe detials from local storage and append them to the page.
 */
function setRecipeDetails() {
  if (localStorage.getItem("recipe")) {
    var recipe = JSON.parse(localStorage.getItem("recipe"));

    $("#recipe-name > div").text(recipe.title);
    $("#recipe-steps > div > div > div").html(recipe.instructions);
    $("#recipe-image > div").css(
      "background-image",
      "url(" + recipe.image + ")"
    );

    const recipeText = recipe.summary;
    // Regular expressions to extract information
    const caloriesRegex = /<b>(\d+) calories<\/b>/i;
    const proteinRegex = /<b>(\d+)g of protein<\/b>/i;
    const fatRegex = /<b>(\d+)g of fat<\/b>/i;
    const carbsRegex = /<b>(\d+)g of carbs<\/b>/i;

    // Extracting information using regex
    const caloriesMatch = recipeText.match(caloriesRegex);
    const proteinMatch = recipeText.match(proteinRegex);
    const fatMatch = recipeText.match(fatRegex);
    const carbsMatch = recipeText.match(carbsRegex);

    // Displaying the extracted information
    const calories = caloriesMatch ? parseInt(caloriesMatch[1]) + "g" : "N/A";
    const protein = proteinMatch ? parseInt(proteinMatch[1]) + "g" : "N/A";
    const fat = fatMatch ? parseInt(fatMatch[1]) + "g" : "N/A";
    const carbs = carbsMatch ? parseInt(fatMatch[1]) + "g" : "N/A";

    $("#recipe-protein > div > div").text(protein);
    $("#recipe-carbs > div > div").text(carbs);
    $("#recipe-calories > div > div").text(calories);
    $("#recipe-fats > div > div").text(fat);
  }
}

/**
 * Get excluded ingredients from the server.
 */
function getExcludedIngredients() {
  excluded_ingredients = [];
  $.ajax({
    url: ajax_admin_url.ajax_url,
    dataType: "json",
    method: "POST",
    async: false,
    data: {
      action: "exclude_ingredients",
      call_type: "get",
    },
    success: function (result) {
      excluded_ingredients = result.data;
    },
  });
  return excluded_ingredients;
}

/**
 * Sends user data to the server for updating.
 *
 * @param {string} fieldName - The name of the field to update.
 * @param {any} fieldValue - The value to update the field with.
 * @return {void} This function does not return anything.
 */
function sendUserData(fieldName, fieldValue) {
  $.ajax({
    url: ajax_admin_url.ajax_url,
    dataType: "json",
    method: "POST",
    data: {
      action: "update_user_data",
      name: fieldName,
      value: fieldValue,
    },
    success: function (result) {
      console.log(result);
      if (result.status == "success") {
        tdee = parseInt(result.TDEE);
        $("#dee-goal").text(tdee);

        fat = parseInt(result.DRI.fat.grams);
        carbs = parseInt(result.DRI.carbs.grams);
        protein = parseInt(result.DRI.protein.grams);
        $("#dri-goal").text(fat + "-" + carbs + "-" + protein);

        waterIntake = result.waterIntake;
        $("#water-intake").text(waterIntake);
        blinkElement($(".update-item"));

        $(".edit-button")
          .removeClass()
          .addClass("fa-solid fa-pencil edit-button");
      }
    },
  });
}
function blinkElement(element) {
  element.addClass("blink"); // Add a class for styling during animation
  setTimeout(function () {
    element.removeClass("blink"); // Remove the class after 1 second
  }, 500); // Adjust the duration as needed (in milliseconds)
}

/**
 * Validates the user input based on the given field name and field value.
 *
 * @param {string} fieldName - The name of the field to be validated.
 * @param {number} fieldValue - The value of the field to be validated.
 * @return {boolean} Returns true if the input is valid, false otherwise.
 */
function validateUserInput(fieldName, fieldValue) {
  switch (fieldName) {
    case "current-weight":
      if (fieldValue < 40 || fieldValue > 150) {
        alert("Please enter a valid weight between 40 and 150");
        return false;
      }
      break;
    case "height":
      if (fieldValue < 100 || fieldValue > 250) {
        alert("Please enter a valid height between 100 and 250");
        return false;
      }
      break;
    case "age":
      if (fieldValue < 18 || fieldValue > 100) {
        alert("Please enter a valid age between 18 and 100");
        return false;
      }
      break;
    case "daily-goal":
      if (fieldValue < -5 || fieldValue > 5) {
        alert("Please enter a valid daily goal between -500 and 500");
        return false;
      }
      break;
    default:
      break;
  }
  return true;
}

function getMealPlan(WeekNumber) {
  scrollBy({
    top: 400,
    behavior: "smooth",
  });

  $("#meal-plan").html(
    '<div class="loader-container"> <span class="loader"></span></div>'
  );

  $.ajax({
    url: ajax_admin_url.ajax_url,
    dataType: "json",
    method: "POST",
    data: {
      action: "get_meal_plan",
      week_number: WeekNumber,
    },
    success: function (result) {
      if (result.success) {
        console.log(result);

        // Hide the loader after 5 seconds
        setTimeout(function () {
          $(".loader-container").fadeOut("slow", function () {
            // After hiding the loader, append the API content and fade it in
            $("#meal-plan").hide().html(result.data).fadeIn("slow");
          });
        }, 1000); // 5000 milliseconds = 5 seconds
      }
    },
  });
}

function sendQuizData(formData) {
  $.ajax({
    url: ajax_admin_url.ajax_url,
    dataType: "json",
    method: "POST",
    data: {
      action: "update_quiz_data",
      weight: formData[1].value,
      height: formData[2].value,
      age: formData[3].value,
      daily_goal: formData[4].value,
      activity_level: formData[5].value,
    },
    success: function (result) {
      console.log(result);
      if (result.status == "success") {
        console.log("SUCCESS");
      }
    },
  });
}
