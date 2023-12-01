<?php /* Template Name: Your Plan Page */?>
<?php
/**
 * The template for displaying your plan page
 *
 * This is the template that displays your plan page
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Enjoyou
 */

get_header();
?>
<?php

$user_id = get_current_user_id();

$activity_levels = array(
    'Sedentary' => 1.2,
    'Lightly Active' => 1.4,
    'Moderately Active' => 1.6,
    'Very Active' => 1.725,
    'Extra Active' => 1.9,
);
$daily_goals = array(
    '+5' => 500,
    '+4' => 400,
    '+3' => 300,
    '+2' => 200,
    '+1' => 100,
    '0' => 0,
    '-1' => -100,
    '-2' => -200,
    '-3' => -300,
    '-4' => -400,
    '-5' => -500,
);

$user_weight = get_user_meta($user_id, 'current-weight', true) ?: '80.0';
$user_height = get_user_meta($user_id, 'height', true) ?: '160.0';
$user_age = get_user_meta($user_id, 'age', true) ?: '25';
$user_daily_goal = get_user_meta($user_id, 'daily-goal', true) ?: '-250';
$user_activity_level = get_user_meta($user_id, 'activity-level', true) ?: 'Moderate';
$user_TDEE = get_user_meta($user_id, 'TDEE', true) ?: '2000';
$user_DRI = get_user_meta($user_id, 'DRI', true);
$user_water_intake = get_user_meta($user_id, 'water-intake', true) ?: '2.5';
if (!empty($user_DRI)) {
    $fat = intval($user_DRI['fat']['grams']);
    $carbs = intval($user_DRI['carbs']['grams']);
    $protein = intval($user_DRI['protein']['grams']);
    $user_DRI = $fat . '-' . $carbs . '-' . $protein;
} else {
    $user_DRI = '169-126-56';

}

?>

<div class="wrapper">
    <div class="col2">
        <div class="meal-header">
            <div class="meal-plan-heading">
                <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>Livello-23.png" />
                <h1>Hi<strong> There!</strong> This is your custom meal plan</h1>
            </div>
        </div>
        <div class="category">
            <div class="row">
                <div class="category-item-container">
                    <div class="category-item">
                        <div class="category-item-icon">
                            <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>a159-1-768x742.png">
                        </div>
                        <div class="category-item-heading">
                            <input oninput="this.style.width = (this.value.length+0.5) + 'ch';" class="editable-field"
                                type="number" min="40" max="150" name="current-weight"
                                value="<?php echo $user_weight; ?>" readonly>
                            <span class="category-item-unit">Kg</span>
                            <p>Current Weight </p>
                        </div>
                        <div class="category-item-edit">
                            <i class="fa-solid fa-pencil edit-button"></i>
                        </div>
                    </div>
                </div>
                <div class="category-item-container">
                    <div class="category-item">
                        <div class="category-item-icon">
                            <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>Livello-44.png">
                        </div>
                        <div class="category-item-heading">
                            <input oninput="this.style.width = (this.value.length+0.5) + 'ch';" class="editable-field"
                                type="number" min="100" max="250" name="height" value="<?php echo $user_height; ?>"
                                readonly>
                            <span class="category-item-unit">cm</span>
                            <p>Your Height</p>
                            <p></p>
                        </div>
                        <div class="category-item-edit">
                            <i class="fa-solid fa-pencil edit-button"></i>
                        </div>
                    </div>
                </div>
                <div class="category-item-container">
                    <div class="category-item update-item">
                        <div class="category-item-icon">
                            <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>Livello-8.png">
                        </div>
                        <div class="category-item-heading">
                            <h1 class="category-item-h1" id='dee-goal'>
                                <?php echo $user_TDEE; ?>
                            </h1>
                            <span class="category-item-unit">kcal</span>
                            <p>Daily Intake Goal</p>
                        </div>
                    </div>
                </div>
                <div class="category-item-container">
                    <div class="category-item update-item">
                        <div class="category-item-icon">
                            <img
                                src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>3d-icon-illustrations-startup-removebg-preview.png">
                        </div>
                        <div class="category-item-heading">
                            <h1 class="category-item-h1" id='dri-goal'>
                                <?php echo $user_DRI; ?>
                            </h1>
                            <span class="category-item-unit">gr</span>
                            <p>Prot-Carbs-Fat</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="category-item-container">
                    <div class="category-item">
                        <div class="category-item-icon">
                            <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>Target.png">
                        </div>
                        <div class="category-item-heading">
                            <select class="select-field" name="daily-goal" id="daily-goal">
                                <?php foreach ($daily_goals as $key => $value): ?>
                                    <option value="<?php echo $value; ?>" <?php echo $user_daily_goal == $value ? 'selected' : ''; ?>>
                                        <?php echo $key; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="category-item-unit">Kg</span>
                            <p>Your Daily Deficit Goal</p>
                        </div>
                        <div class="category-item-edit">
                            <i class="fa-solid fa-pencil edit-button"></i>
                        </div>
                    </div>
                </div>
                <div class="category-item-container">
                    <div class="category-item">
                        <div class="category-item-icon">
                            <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>Design.png">
                        </div>
                        <div class="category-item-heading">
                            <select class="select-field" name="activity-level" id="activity-level">
                                <?php foreach ($activity_levels as $key => $value): ?>
                                    <option value="<?php echo $value; ?>" <?php echo $user_activity_level == $value ? 'selected' : ''; ?>>
                                        <?php echo $key; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p>Activity Level</p>
                        </div>
                        <div class="category-item-edit">
                            <i class="fa-solid fa-pencil edit-button"></i>
                        </div>
                    </div>
                </div>
                <div class="category-item-container">
                    <div class="category-item">
                        <div class="category-item-icon">
                            <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>cake.png">
                        </div>
                        <div class="category-item-heading">
                            <input oninput="this.style.width = (this.value.length+0.5) + 'ch';" class="editable-field"
                                type="number" min="18" max="100" name="age" value="<?php echo $user_age; ?>" readonly>
                            <span class="category-item-unit">years</span>
                            <p>Your Age</p>
                        </div>
                        <div class=" category-item-edit">
                            <i class="fa-solid fa-pencil edit-button"></i>
                        </div>
                    </div>
                </div>
                <div class="category-item-container">
                    <div class="category-item update-item">
                        <div class="category-item-icon">
                            <img src="<?php echo get_template_directory_uri() . '/your-plan-page-images/'; ?>LAST-PIECE-DROP.png">
                        </div>
                        <div class="category-item-heading">
                            <h1 class="category-item-h1" id='water-intake'>
                                <?php echo $user_water_intake; ?>
                            </h1>
                            <span class="category-item-unit">liters</span>
                            <p>Daily Water Intake</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reload-button-wrapper">
            <div class="reload-button">
                <button id="generate-meal-plan">Generate Meal Plan</button>
            </div>
        </div>
        <div class="week-wrapper">
            <div class="week-heading">
                <i id="left-arrow" style="cursor: pointer;" class="fa-solid fa-arrow-left"></i>
                <h1 id="week-number">Week 1</h1>
                <i id="right-arrow" style="cursor: pointer;" class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="div week-change">

                <i class="fa-solid fa-arrows-rotate"></i>
                <a
                    href='#elementor-action%3Aaction%3Dpopup%3Aopen%26settings%3DeyJpZCI6IjE3MTciLCJ0b2dnbGUiOmZhbHNlfQ%3D%3D'>Change
                    Ingredients</a>
            </div>
        </div>
        <div class="meal-row">
            <div class="meal-button-empty"></div>
            <div class="meal-button">
                <button>Breakfast</button>
            </div>
            <div class="meal-button">
                <button>Lunch</button>
            </div>
            <div class="meal-button">
                <button>Dinner</button>
            </div>
        </div>
        <div id="meal-plan">
            <div class="loader-container">
                <div class="loader"></div>
            </div>
        </div>
    </div>
</div>
<?php
get_sidebar();
get_footer();

