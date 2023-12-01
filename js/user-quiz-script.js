
let currentPage = 1;
function showPage(pageNumber) {
    var progressBar = $('.progcomp');
    $('.form-page').fadeOut(500);
    setTimeout(function () {

        progressBar.css('width', ((pageNumber - 2) / 9.0) * 100 + '%');

        $('#page' + pageNumber).fadeIn(500);
    }, 500);
}

function nextPage(currentPage) {
    if (currentPage < 15) {
        showPage(currentPage + 1);
    }
}

function previousPage(currentPage) {
    if (currentPage > 1) {
        showPage(currentPage - 1);
    }
}

function submitForm() {
    // Add your form submission logic here
    alert('Form submitted successfully!');
}

$(document).ready(function () {
    showPage(currentPage);
    $(".item-container").on('click', function () {
        var clickedItem = $(this).find('input');
        if (clickedItem.length > 0) {
            var clickedItemName = clickedItem.prop('name');
            var clickedItemValue = clickedItem.prop('value');
            sendSignUpQuizData(clickedItemName, clickedItemValue);
        }
    });
    $(".quiz-field").focusout(function () {
        const editableField = $(this);
        var fieldValue = editableField.val();
        var fieldName = editableField.attr("name");
        if (fieldName == 'height-in') {
            if (!validateUserInput(fieldName, fieldValue)) {
                $('#height-btn').prop('disabled', true);
                return;
            }
            var heightInFeet = $('input[name="height-ft"]').val();
            if (heightInFeet == "" || heightInFeet == 0) {
                $('#height-btn').prop('disabled', true);
                return;
            }

            sendSignUpQuizData(fieldName, fieldValue);
        }
        if (fieldValue == "" || fieldValue == 0) {
            if (fieldName == 'current-weight-lbs')
                fieldName = 'current-weight';
            if (fieldName == 'height-ft')
                fieldName = 'height';
            $('#' + fieldName + '-btn').prop('disabled', true);
            return;
        }
        if (!validateUserInput(fieldName, fieldValue)) {
            if (fieldName == 'current-weight-lbs')
                fieldName = 'current-weight';
            if (fieldName == 'height-ft')
                fieldName = 'height';
            $('#' + fieldName + '-btn').prop('disabled', true);
            editableField.val(0);
            return;
        }
        sendSignUpQuizData(fieldName, fieldValue);
        if (fieldName == 'current-weight-lbs')
            fieldName = 'current-weight';
        if (fieldName == 'height-ft' || fieldName == 'height-in')
            fieldName = 'height';
        $('#' + fieldName + '-btn').prop('disabled', false);
    });
    $(".weight-type").on('click', function () {
        $('.weight-type').css('background', '#EEEBEA');
        $(this).css('background', '#E78B7C');


        const clickedWeightUnit = $(this).text().trim();
        if (clickedWeightUnit == 'lbs') {
            $('#weight-input-kgs').hide();
            $('#weight-input-lbs').show();
            var weightInLbs = $('#weight-input-kgs input').val() * 2.20462;
            $('#weight-input-lbs input').val(Math.floor(weightInLbs));
        } else {
            var weightInKgs = $('#weight-input-lbs input').val();
            weightInKgs = (weightInKgs > 0) ? weightInKgs / 2.20462 : 0;
            var decimalPart = weightInKgs % 1;
            $('#weight-input-kgs input').val(decimalPart <= 0.5 ? Math.floor(weightInKgs) : Math.ceil(weightInKgs));
            $('#weight-input-lbs').hide();
            $('#weight-input-kgs').show();
        }
    });
    $(".height-type").on('click', function () {
        $('.height-type').css('background', '#EEEBEA');
        $(this).css('background', '#E78B7C');


        const clickedWeightUnit = $(this).text().trim();
        if (clickedWeightUnit == 'In') {
            $('#height-input-cm').hide();
            $('#height-input-in').show();
            var heightInCm = $('input[name="height"]').val();
            if (heightInCm <= 0) {
                $('input[name="height-ft"]').val(0);
                $('input[name="height-in"]').val(0);
                return;
            }
            var heightInFeet = Math.floor(heightInCm / 30.48);
            var heightInInches = Math.floor((heightInCm % 30.48) / 2.54);
            $('input[name="height-ft"]').val(heightInFeet);
            $('input[name="height-in"]').val(heightInInches);
        } else {
            $('#height-input-cm').show();
            $('#height-input-in').hide();
            var heightInFeet = $('input[name="height-ft"]').val();
            var heightInInches = $('input[name="height-in"]').val();
            var heightInCm = heightInFeet * 30.48 + heightInInches * 2.54;
            if (heightInCm > 250) {
                heightInCm = 250;
            }
            else if (heightInCm < 100 && heightInCm > 0) {
                heightInCm = 100;
            }
            $('input[name="height"]').val(Math.floor(heightInCm));
        }
    });
});
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
        case "current-weight-lbs":
            if (fieldValue < 88 || fieldValue > 330) {
                alert("Please enter a valid weight between 88 and 330");
                return false;
            }
            break;
        case "height":
            if (fieldValue < 100 || fieldValue > 250) {
                alert("Please enter a valid height between 100 and 250");
                return false;
            }
            break;
        case "height-ft":
            if (fieldValue < 3 || fieldValue > 8) {
                alert("Please enter a valid height feets between 3 and 8");
                return false;
            }
            break;
        case "height-in":
            if (fieldValue < 0 || fieldValue > 12) {
                alert("Please enter a valid height Inches between 0 and 12");
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

/**
 * Sends user data to the server for updating.
 *
 * @param {string} fieldName - The name of the field to update.
 * @param {any} fieldValue - The value to update the field with.
 * @return {void} This function does not return anything.
 */

function sendSignUpQuizData(fieldName, fieldValue) {
    if (fieldName == 'height-ft' || fieldName == 'height-in') {
        fieldValue = $('input[name="height-ft"]').val() * 30.48 + $('input[name="height-in"]').val() * 2.54;
        if (fieldValue > 250) {
            fieldValue = 250;
        }
        else if (fieldValue < 100 && fieldValue > 0) {
            fieldValue = 100;
        }
        fieldName = 'height';
    }
    if (fieldName == 'current-weight-lbs') {
        fieldValue = fieldValue ? fieldValue / 2.20462 : 0;
        fieldValue = Math.ceil(fieldValue);
        fieldName = 'current-weight';
    }
    console.log(fieldName, fieldValue);
    $.ajax({
        url: ajax_admin_url.ajax_url,
        dataType: "json",
        method: "POST",
        data: {
            action: "update_quiz_data",
            field_name : fieldName,
            field_value : fieldValue
        },
        success: function (result) {
            console.log(result);
            if (result.status == "success") {
                console.log("SUCCESS");
            }
        },
    });
}