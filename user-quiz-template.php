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
    <title>User Quiz</title>

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
        }

        #form-container {
            height: 100%;
            display: flex;
            flex-direction: column;
            margin-top: 5vh;
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
            cursor: pointer;
        }

        .image-box {
            width: 50%;
            margin: 10px;
            margin-top: 150px;
            border: 1px solid lightblue;
            border-radius: 5px 5px 0 0;
            background-color: lightblue;
            height: 120px;
        }

        .image {
            margin-top: auto;
        }

        .image img {
            margin-bottom: -5px;
            margin-top: -64px;
            width: 100%;

        }

        .image-name {
            background-color: #c84d8d;
            color: white;
            padding: 10px 10px;
            border: 1px solid #c84d8d;
            border-radius: 0 0 5px 5px;
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
            cursor: pointer;
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
            cursor: pointer;
        }

        .menu-item:hover {
            background-color: #dfdfdf;
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

        .tall-input {
            width: 50%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            margin-right: auto;
            margin-left: auto;
        }

        .tall-input input {
            font-size: 36px;
            color: #636773;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            border: none;
            text-align: right;
            width: 1ch;
        }

        .continue-btn {
            background-color: black;
            padding: 10px;
            color: white;
            padding-left: 50px;
            padding-right: 50px;
            border-radius: 05px;
            border: none;
            cursor: pointer;
            margin-top: 25px;
            cursor: pointer;
        }

        .title {
            font-size: 20px;
            color: black;
            font-family: 'Montserrat', sans-serif;
        }

        .skip-btn-wrapper {
            display: flex;
            justify-content: right;
        }

        .skip-btn {
            display: flex;
            width: 2%;
            padding: 30px;
            cursor: pointer;
            justify-content: right;
        }

        @media screen and (max-width: 1050px) {
            .image-box {
                height: 77px;
            }
        }

        @media screen and (max-width: 900px) {
            .image-name {
                background-color: #c84d8d;
                color: white;
                padding: 10px 5px;
                border: 1px solid #c84d8d;
                border-radius: 0 0 5px 5px;
                font-size: 15px;
            }
        }

        @media screen and (max-width: 795px) {
            .images-container {
                padding: 0px 10%;
                display: inline-flex;
                justify-content: space-around;
                align-items: flex-end;
                cursor: pointer;
            }
        }

        @media screen and (max-width: 500px) {
            .images-container {
                padding: 0px 0%;
            }

            .image-name {
                font-size: 10px;
            }

            .image img {
                margin-bottom: -5px;
                margin-top: -30px;
                height: 110%;
                width: auto;
            }

            .image-box {
                width: 50%;
                margin: 3px;
                margin-top: 150px;
                border: 1px solid lightblue;
                border-radius: 5px 5px 0 0;
                background-color: lightblue;
                height: 80px;
                display: flex;
                flex-direction: column;
            }

            .image-name {
                background-color: #c84d8d;
                color: white;
                padding: 10px 5px;
                border: 1px solid #c84d8d;
                border-radius: 0 0 5px 5px;
            }

            h2 {
                font-size: 17px;
            }

            .menu-item {
                width: 66vw;
                max-width: 350px;

            }

            .item-container {
                padding: 12px;
                width: 70%;
                display: flex;
            }
        }




        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <div class='skip-btn-wrapper'>
        <div onclick="skipTologin()" class='skip-btn'>
            <h3> SKIP </h3>
        </div>
    </div>
    <div id="form-container">
        <div class="form-page" id="page1">
            <div>
                <h2>PERSONALIZED KETO MEAL PLAN</h2>
                <p class="title">CHOOSE YOUR AGE</p>
                <p><b>30-Seconds Quiz</b></p>
            </div>
            <div onclick="nextPage(1)" class="images-container">
                <div class="image-box">
                    <div class="image">
                        <img style="width: 77%;"
                            src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>run-removebg-preview.png"
                            alt="Image 1">
                        <div class="image-name">Age: 18-29</div>
                    </div>
                </div>
                <div class="image-box">
                    <div class="image">
                        <img style="width:74%"
                            src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>run2-removebg-preview.png"
                            alt="Image 1">
                        <div class="image-name">Age: 30-39</div>
                    </div>
                </div>
                <div class="image-box">
                    <div class="image">
                        <img style="width: 96%;"
                            src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>5.png" alt="Image 1">
                        <div class="image-name">Age: 40-49</div>
                    </div>
                </div>
                <div class="image-box">
                    <div class="image">
                        <img style="width: 91%;"
                            src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>run4-removebg-preview.png"
                            alt="Image 1">
                        <div class="image-name">Age: 50-59</div>
                    </div>
                </div>
            </div>
            <footer class="footer-page1">
                By <b>Selecting your gender and continuing</b> you agree to our <b><a href="#">Terms of
                        Service</a></b>
            </footer>
        </div>
        <div class="form-page" id="page2">
            <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>logo.png" alt=""
                style="margin-left: auto; margin-right: auto; margin-bottom: 35px;">
            <h3 style="margin-bottom: 0;">The Only AI Keto Meal Planner</h3>
            <h4 style="margin-bottom: 45px; margin-top: -0.1%;color: #181a1a">Developed with an IFBB Champion & Stanford
                Nutrition Expert</h4>

            <div>
                <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>women.png" alt=""
                    style="border-radius: 50%;width: 60%">
            </div>


            <div onclick="nextPage(2)">
                <div>
                    <button class="continue-btn" onclick="nextPage(2)">
                        Continue 👉</button>
                </div>
            </div>
        </div>
        <div class="form-page" id="page3">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(3)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">1</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">Select Your Current Body Type</h2>
            <div onclick="nextPage(3)" class="menu-item">
                <div class="item-container">
                    <p>Average
                    <p>
                </div>
                <div class="item-img">
                    <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>hips.png" alt="">
                </div>
            </div>
            <div onclick="nextPage(3)" class="menu-item">
                <div class="item-container">
                    <p>Chubby
                    <p>
                </div>
                <div class="item-img">
                    <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>muscle-removebg-preview.png"
                        alt="">
                </div>
            </div>
            <div onclick="nextPage(3)" class="menu-item">
                <div class="item-container">
                    <p>Plus Size
                    <p>
                </div>
                <div class="item-img">
                    <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>Image__8_-removebg-preview.png"
                        alt="">
                </div>
            </div>
        </div>
        <div class="form-page" id="page4">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(4)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">2</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">Choose Your Desired Body Goal</h2>
            <div style="height: 60vh; overflow-x: none;overflow-y: auto;">
                <div onclick="nextPage(4)" class="menu-item">
                    <div class="item-container">
                        <p>In Shape
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>hips.png" alt="">
                    </div>
                </div>
                <div onclick="nextPage(4)" class="menu-item">
                    <div class="item-container">
                        <p>Athletic
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>muscle-removebg-preview.png"
                            alt="">
                    </div>
                </div>
                <div onclick="nextPage(4)" class="menu-item">
                    <div class="item-container">
                        <p>Curvy
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>Image__8_-removebg-preview.png"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-page" id="page5">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(5)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">3</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">What is Your Main Goal?</h2>
            <div style="height: 60vh; overflow-x: none;overflow-y: auto;">
                <div onclick="nextPage(5)" class="menu-item">
                    <div class="item-container">
                        <p>Lose Weight
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>&#128293;</h2>
                    </div>
                </div>
                <div onclick="nextPage(5)" class="menu-item">
                    <div class="item-container">
                        <p>Reduce Stress & Anxiety
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>&#128524;</h2>
                    </div>
                </div>
                <div onclick="nextPage(5)" class="menu-item">
                    <div class="item-container">
                        <p>Sleep Better
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>&#128164;</h2>
                    </div>
                </div>
                <div onclick="nextPage(5)" class="menu-item">
                    <div class="item-container">
                        <p>Increase Life Expectancy
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>&#128117;</h2>
                    </div>
                </div>
                <div onclick="nextPage(5)" class="menu-item">
                    <div class="item-container">
                        <p>Reduce the Risk of Cancer
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🏥</h2>
                    </div>
                </div>
                <div onclick="nextPage(5)" class="menu-item">
                    <div class="item-container">
                        <p>Stimulate Brain Power
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🧠</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-page" id="page6">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(6)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">4</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">Do You prefer Cooking at Home or Eating Out?</h2>
            <div style="height: 60vh; overflow-x: none;overflow-y: auto;">
                <div onclick="nextPage(6)" class="menu-item">
                    <div class="item-container">
                        <p>I usually cook at home.
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🍳</h2>
                    </div>
                </div>
                <div onclick="nextPage(6)" class="menu-item">
                    <div class="item-container">
                        <p>Generally, I go out.
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🍽️</h2>
                    </div>
                </div>
                <div onclick="nextPage(6)" class="menu-item">
                    <div class="item-container">
                        <p>I like both.
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>&#x1f957;</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-page" id="page7">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(7)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">5</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">How Often Do You Work Out Each Week?</h2>
            <div style="height: 60vh; overflow-x: none;overflow-y: auto;">
                <div onclick="nextPage(7)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="activity_level" value="1.2" hidden>
                        <p>I don't work out
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>auntie-removebg-preview.png"
                            alt="">
                    </div>
                </div>
                <div onclick="nextPage(7)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="activity_level" value="1.3" hidden>
                        <p>I just started
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>sit.png" alt="">
                    </div>
                </div>
                <div onclick="nextPage(7)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="activity_level" value="1.5" hidden>
                        <p>3 Times a week
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>squat.png" alt="">
                    </div>
                </div>
                <div onclick="nextPage(7)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="activity_level" value="1.725" hidden>
                        <p>5 Time a week
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>11.png" alt=""
                            style="width: 90%;height:auto;">
                    </div>
                </div>
                <div onclick="nextPage(7)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="activity_level" value="1.9" hidden>
                        <p>Everyday
                        <p>
                    </div>
                    <div class="item-img">
                        <img src="<?php echo get_template_directory_uri() . '/quiz-images/'; ?>jump.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-page" id="page8">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(8)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">6</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">How Tall Are You?</h2>

            <div style="display: inline-flex; background-color: #EEEBEa;margin: 20px;padding: 3px;border-radius: 10px;">

                <div class="height-type"
                    style="padding: 10px; background-color:#E78b7C;padding-left: 40px;padding-right: 40px;border-radius: 10px; cursor: pointer; ">
                    In
                </div>
                <div class="height-type"
                    style="padding: 10px;background-color:#EEEBEa;padding-left: 40px;padding-right: 40px;border-radius: 10px; cursor: pointer;">
                    cm
                </div>
            </div>
            <div class="tall-input" id="height-input-in">
                <input class="quiz-field" type="number" min="3" max="8" name="height-ft" value="0"
                    style="width: 2.5ch; text-align: right;" />
                <sub style="font-size: 17px;color: #636773; font-weight: 600;padding-top: 16px">ft</sub>
                <input class="quiz-field" type="number" min="0" max="12" name="height-in" value="0"
                    style="width: 2.5ch; text-align: right;" />
                <sub style="font-size: 17px;color: #636773; font-weight: 600;padding-top: 16px">in</sub>
            </div>
            <div class="tall-input" id="height-input-cm" style="display: none;">
                <input class="quiz-field" type="number" min="100" max="250" name="height" value="0"
                    style="width: 3.5ch; text-align: right;" />
                <sub style="font-size: 17px;color: #636773; font-weight: 600;padding-top: 16px">cm</sub>

            </div>


            <div>
                <div>
                    <button id="height-btn" onclick="nextPage(8)" class="continue-btn" disabled> Continue
                        👉</button>
                </div>
            </div>
        </div>
        <div class="form-page" id="page9">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(9)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">8</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">What's Your Weight?</h2>

            <div style="display: inline-flex; background-color: #EEEBEa;margin: 20px;padding: 3px;border-radius: 10px;">
                <div class="weight-type"
                    style="padding: 10px; background-color:#EEEBEa;padding-left: 40px;padding-right: 40px;border-radius: 10px; cursor: pointer;">
                    lbs
                </div>
                <div class="weight-type"
                    style="padding: 10px;background-color:#E78b7C;padding-left: 40px;padding-right: 40px;border-radius: 10px; cursor: pointer;">
                    kg
                </div>
            </div>
            <div class="tall-input" id="weight-input-kgs">
                <input type="number" class="quiz-field" name="current-weight" value="0"
                    style="width: 3ch; text-align: right;" min="40" max="150" />
                <sub style="font-size: 17px;color: #636773; font-weight: 600;padding-top: 16px">kg</sub>

            </div>
            <div class="tall-input" id="weight-input-lbs" style="display: none;">
                <input type="number" class="quiz-field" name="current-weight-lbs" value="110"
                    style="width: 3ch; text-align: right;" min="88" max="330" />
                <sub style="font-size: 17px;color: #636773; font-weight: 600;padding-top: 16px">lbs</sub>

            </div>

            <div>
                <div>
                    <button id="current-weight-btn" onclick="nextPage(9)" class="continue-btn" disabled> Continue
                        👉</button>
                </div>
            </div>
        </div>
        <div class="form-page" id="page10">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(10)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">8</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">How Old Are You?</h2>

            <div class="tall-input">
                <input class="quiz-field" name="age" value="0" style="width: 5ch; text-align: center;" min="18"
                    max="100" />

                <!-- <sub style="font-size: 17px;color: #636773; font-weight: 600;padding-top: 16px">kg</sub> -->

            </div>

            <div>
                <div>
                    <button id="age-btn" onclick="nextPage(10)" class="continue-btn" disabled> Continue 👉</button>
                </div>
            </div>
        </div>
        <div class="form-page" id="page11">
            <div class="progbar">
                <div class="progcomp"></div>
            </div>
            <div onclick="previousPage(11)" class="progcontainer">
                <i class="fa-solid fa-arrow-left"></i>
                <h4><label style="color: #ca5681;">9</label>/9</h4>
            </div>
            <h2 style="margin-bottom: 45px;">What is your monthly weight goal</h2>
            <div style="height: 60vh; overflow-x: none;overflow-y: auto;">
                <div onclick="nextPage(11)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="daily_goal" value="0" hidden />
                        <p>No change (0 lbs/month)
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🤚</h2>
                    </div>
                </div>
                <div onclick="nextPage(11)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="daily_goal" value="-100" hidden />
                        <p>Lose about 2 lbs/month
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>👌</h2>
                    </div>
                </div>
                <div onclick="nextPage(11)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="daily_goal" value="-200" hidden />
                        <p>Lose about 3 lbs/month
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🙌</h2>
                    </div>
                </div>
                <div onclick="nextPage(11)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="daily_goal" value="-300" hidden />
                        <p>Lose about 5 lbs/month
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🤙</h2>
                    </div>
                </div>
                <div onclick="nextPage(11)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="daily_goal" value="-400" hidden />
                        <p>Lose about 7 lbs/month
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>🤟</h2>
                    </div>
                </div>
                <div onclick="nextPage(11)" class="menu-item">
                    <div class="item-container">
                        <input type="radio" name="daily_goal" value="-500" hidden />
                        <p>Lose about 9 lbs/month
                        <p>
                    </div>
                    <div class="item-img">
                        <h2>💪</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-page" id="page12">
            <h2> Thank You for Submitting the Form. Sign Up Now!</h2>
        </div>
    </div>
    <script>
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
            if (currentPage <= 11) {
                showPage(currentPage + 1);
            }
            if (currentPage == 11) {
                submitForm();
            }
        }

        function previousPage(currentPage) {
            if (currentPage > 1) {
                showPage(currentPage - 1);
            }
        }
        function skipTologin() {
            console.log("Submit Skipped");
            $('#form-container').fadeOut(500);
            $('.skip-btn').fadeOut(500);
            setTimeout(function () {
                window.location.href = '<?php echo get_site_url(); ?>/login';
            }, 1500); // 3000 milliseconds = 3 seconds
        }

        function submitForm() {
            console.log("Submit Form");
            setTimeout(function () {
                window.location.href = '<?php echo get_site_url(); ?>/login';
            }, 1500); // 3000 milliseconds = 3 seconds
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
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                dataType: "json",
                method: "POST",
                data: {
                    action: "update_quiz_data",
                    field_name: fieldName,
                    field_value: fieldValue
                },
                success: function (result) {
                    console.log(result);
                    if (result.status == "success") {
                        console.log("SUCCESS");
                    }
                },
            });
        }
    </script>
    <script src="https://kit.fontawesome.com/b5983e4169.js" crossorigin="anonymous"></script>
</body>

</html>