<?php /* Template Name: User Quiz */?>
<?php
/**
 * The template for displaying User Quiz
 *
 * This is the template that displays the user quiz
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Enjoyou
 */

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
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Multi-Step Form</title>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        #form-container {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-page {
            text-align: center;
            display: none;
        }

        .footer-page1 {
            margin-top: 200px;
        }

        /* Add your styling for buttons, images, etc. */
        .form-btn {
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }

        .images-container {
            padding: 0px 20%;
            display: inline-flex;
            justify-content: space-around;
            align-items: flex-end;
        }

        .image-box {
            width: 50%;
            margin: 10px;
            border: 1px solid lightblue;
            border-radius: 5px;
            height: 3px;
        }

        .image {
            background-color: lightblue;
        }

        .image img {
            margin-bottom: -5px;
            width: 100%;

        }

        .image-name {
            background-color: #c84d8d;
            color: white;
            padding: 10px 10px;
        }

        .progbar {
            margin-left: auto;
            margin-right: auto;
            width: 50vw;
            height: 3px;
            background-color: #dadde3;
            border-radius: 50px;
            max-width: 450px;
        }

        .progcomp {
            width: 5%;
            height: 3px;
            background-color: #ca5681;
            border-radius: 50px;
        }

        .progcontainer {
            width: 50vw;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 450px;
        }

        .menu-item {
            width: 45vw;
            max-width: 350px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: row;
            border: 1px solid #dfdfdf;
            height: 75px;
            margin-top: 25px;
            margin-bottom: 25px;
            border-radius: 10px;
        }

        .item-container {
            padding: 15px;
            width: 70%;
            display: flex;
        }

        .item-img {
            width: 30%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-img img {
            height: 100%;
            width: auto;
        }
    </style>
</head>

<body>

    <div id="form-container">
        <div class="form-page" id="page1">
            <div>
                <h2>PERSONALIZED KETO MEAL PLAN</h2>
                <p>CHOOSE YOUR AGE</p>
                <p><b>30-Seconds Quiz</b></p>
            </div>
            <div onclick="nextPage(1)" class="images-container">
                <div class="image-box">
                    <div class="image">
                        <img src="run-removebg-preview.png" alt="Image 1">
                        <div class="image-name">Age: 18-29</div>
                    </div>
                </div>
                <div class="image-box">
                    <div class="image">
                        <img src="run-removebg-preview.png" alt="Image 1">
                        <div class="image-name">Age: 18-29</div>
                    </div>
                </div>
                <div class="image-box">
                    <div class="image">
                        <img src="run-removebg-preview.png" alt="Image 1">
                        <div class="image-name">Age: 18-29</div>
                    </div>
                </div>
                <div class="image-box">
                    <div class="image">
                        <img src="run-removebg-preview.png" alt="Image 1">
                        <div class="image-name">Age: 18-29</div>
                    </div>
                </div>
            </div>
            <footer class="footer-page1">
                By <b>Selecting your gender and continuing</b> you agree to our <b><a href="#">Terms of
                        Service</a></b>
            </footer>
        </div>
        <div class="form-page" id="page2">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(2)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">1</label>/28</h4>
            </div>
            <h2 style="margin-bottom: 45px;">Select Your Current Body Type</h2>
            <div onclick="nextPage(2)" class="menu-item">
                <div class="item-container">
                    <p>Average
                    <p>
                </div>
                <div class="item-img">
                    <img src="hips.png" alt="">
                </div>
            </div>
            <div onclick="nextPage(2)" class="menu-item">
                <div class="item-container">
                    <p>Chubby
                    <p>
                </div>
                <div class="item-img">
                    <img src="muscle-removebg-preview.png" alt="">
                </div>
            </div>
            <div onclick="nextPage(2)" class="menu-item">
                <div class="item-container">
                    <p>Plus Size
                    <p>
                </div>
                <div class="item-img">
                    <img src="Image__8_-removebg-preview.png" alt="">
                </div>
            </div>
        </div>
        <div class="form-page" id="page3">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(3)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">2</label>/28</h4>
            </div>
            <h2 style="margin-bottom: 45px;">Choose Your Desired Body Goal</h2>
            <div onclick="nextPage(3)" class="menu-item">
                <div class="item-container">
                    <p>In Shape
                    <p>
                </div>
                <div class="item-img">
                    <img src="hips.png" alt="">
                </div>
            </div>
            <div onclick="nextPage(3)" class="menu-item">
                <div class="item-container">
                    <p>Athletic
                    <p>
                </div>
                <div class="item-img">
                    <img src="muscle-removebg-preview.png" alt="">
                </div>
            </div>
            <div onclick="nextPage(3)" class="menu-item">
                <div class="item-container">
                    <p>Curvy
                    <p>
                </div>
                <div class="item-img">
                    <img src="Image__8_-removebg-preview.png" alt="">
                </div>
            </div>
        </div>
        <div class="form-page" id="page4">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(4)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">3</label>/28</h4>
            </div>
            <h2 style="margin-bottom: 45px;">What is Your Main Goal</h2>
            <div onclick="nextPage(4)" class="menu-item">
                <div class="item-container">
                    <p>Lose Weight
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(4)" class="menu-item">
                <div class="item-container">
                    <p>Reduce Stress and Anxiety
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(4)" class="menu-item">
                <div class="item-container">
                    <p>Sleep Better
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(4)" class="menu-item">
                <div class="item-container">
                    <p>Increase Life Expectancy
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(4)" class="menu-item">
                <div class="item-container">
                    <p>Reduce the Risk of Cancer
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(4)" class="menu-item">
                <div class="item-container">
                    <p>Stimulate Brain Power
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
        </div>
        <div class="form-page" id="page5">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(5)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">1</label>/28</h4>
            </div>
            <h2 style="margin-bottom: 45px;">Do your prefer cooking at home or eating out</h2>
            <div onclick="nextPage(5)" class="menu-item">
                <div class="item-container">
                    <p>I usually cook at home
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(5)" class="menu-item">
                <div class="item-container">
                    <p>Generally, I go out
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(5)" class="menu-item">
                <div class="item-container">
                    <p>I like both
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
        </div>
        <div class="form-page" id="page6">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(6)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">1</label>/28</h4>
            </div>
            <h2 style="margin-bottom: 45px;">How often do you work out each week</h2>
            <div onclick="nextPage(6)" class="menu-item">
                <div class="item-container">
                    <p>I don't work out
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(6)" class="menu-item">
                <div class="item-container">
                    <p>I just started
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(6)" class="menu-item">
                <div class="item-container">
                    <p>3 Times a week
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(6)" class="menu-item">
                <div class="item-container">
                    <p>5 Time a week
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="nextPage(6)" class="menu-item">
                <div class="item-container">
                    <p>Everyday
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
        </div>
        <div class="form-page" id="page7">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(7)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">1</label>/28</h4>
            </div>
            <h2 style="margin-bottom: 45px;">What is your monthly weight goal</h2>

            <div onclick="submitForm()" class="menu-item">
                <div class="item-container">
                    <p>No change (0 lbs/month)
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="submitForm()" class="menu-item">
                <div class="item-container">
                    <p>Lose about 2 lbs/month
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="submitForm()" class="menu-item">
                <div class="item-container">
                    <p>Lose about 3 lbs/month
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="submitForm()" class="menu-item">
                <div class="item-container">
                    <p>Lose about 5 lbs/month
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="submitForm()" class="menu-item">
                <div class="item-container">
                    <p>Lose about 7 lbs/month
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
            <div onclick="submitForm()" class="menu-item">
                <div class="item-container">
                    <p>Lose about 9 lbs/month
                    <p>
                </div>
                <div class="item-img">
                    <h2>&#128293;</h2>
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentPage = 1;
        function showPage(pageNumber) {
            var progressBar = $('.progcomp');
            $('.form-page').fadeOut(500);
            setTimeout(function () {

            progressBar.css('width', ((pageNumber-2) / 6) * 100 + '%');
                $('#page' + pageNumber).fadeIn(500);
            }, 500);
        }

        function nextPage(currentPage) {
            if (currentPage < 7) {
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

        // Initial display
        showPage(currentPage);
    </script>
    <script src="https://kit.fontawesome.com/b5983e4169.js" crossorigin="anonymous"></script>
</body>

</html>

<?php
get_sidebar();
get_footer();

