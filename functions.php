<?php
/**
 * Enjoyou functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Enjoyou
 */
//Start session if not started
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!defined('_API_KEY')) {
	// Replace the api placeholder with api from spoonacular (https://spoonacular.com/food-api/docs)
	define('_API_KEY', 'api placeholder');
}
add_action('template_redirect', 'ten11_if_user_not_logged_in');
add_filter('login_redirect', 'ten11_if_user_not_logged_in', 10, 3);

function ten11_if_user_not_logged_in()
{
	if (!is_user_logged_in() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) && !is_page(['Login', 'login', 'user-quiz'])) {
		wp_redirect(home_url('/user-quiz/'));
		exit;
	}
}

add_action('wp_logout', 'custom_logout_redirect');
function custom_logout_redirect()
{
	wp_redirect(home_url('/login'));
	exit();
}

add_shortcode('user_logout', 'ten11_if_user_logout_url');
function ten11_if_user_logout_url()
{
	echo wp_logout_url();
}
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function enjoyou_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Enjoyou, use a find and replace
	 * to change 'enjoyou' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('enjoyou', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'enjoyou'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'enjoyou_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'enjoyou_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function enjoyou_content_width()
{
	$GLOBALS['content_width'] = apply_filters('enjoyou_content_width', 640);
}
add_action('after_setup_theme', 'enjoyou_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function enjoyou_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'enjoyou'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'enjoyou'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'enjoyou_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function enjoyou_scripts()
{
	wp_enqueue_style('enjoyou-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('your-plan-design', get_template_directory_uri() . '/css/yourplandesign.css', array(), _S_VERSION, 'all');
	wp_style_add_data('enjoyou-style', 'rtl', 'replace');

	wp_enqueue_script('enjoyou-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('1011-fontawesome-scripts', 'https://kit.fontawesome.com/b5983e4169.js', array(), _S_VERSION, true);
	wp_enqueue_script('1011-jquery-scripts', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('your-plan-responsive', get_template_directory_uri() . '/js/your-plan-responsive.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'enjoyou_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Enque Script for ajax call to updates user's data
 * 
 */

function ajax_script()
{
	wp_enqueue_script('user-data-ajax-script', get_template_directory_uri() . '/js/ajax-script.js', array('jquery'), _S_VERSION, true);
	wp_localize_script(
		'user-data-ajax-script',
		'ajax_admin_url',
		array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'api_key' => _API_KEY
		)
	);

	if (is_page('user-quiz')) {
		wp_enqueue_style('user-quiz-design', get_template_directory_uri() . '/css/user-quiz-design.css', array(), _S_VERSION, 'all');
		wp_enqueue_script('fontawesome-kit', 'https://kit.fontawesome.com/b5983e4169.js', array(), _S_VERSION, true);
		wp_enqueue_script('user-quiz-ajax-script', get_template_directory_uri() . '/js/user-quiz-script.js', array('jquery'), _S_VERSION, true);
		wp_localize_script(
			'user-quiz-ajax-script',
			'ajax_admin_url',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
			)
		);
	}
}
add_action('wp_enqueue_scripts', 'ajax_script');

/**
 * Ajax handler for getting meal plan
 * @param int $user_id
 * @return array $meal_plan
 * @since 1.0.0
 * 
 * */

function get_meal_plan()
{
	$week_number = $_POST['week_number'] ?: "1";
	ob_start(); ?>

	<?php
	$weekly_plan = generateMealPlan($week_number);
	if ($weekly_plan['error']) {
		echo '<div class="meal-item-error"><h3>' . $weekly_plan['error'] . '</h3></div>';
	} else {
		$day_counter = 1;
		foreach ($weekly_plan as $day => $meals) {
			$breakfast = $meals['meals'][0];
			$lunch = $meals['meals'][1];
			$dinner = $meals['meals'][2];
			?>
			<div class="meal-item-row">
				<div class="day-heading">
					<button>Day
						<?php echo $day_counter ?>
					</button>
				</div>
				<div id="<?php echo $breakfast['id']; ?>" style="cursor: pointer;" class="meal-item">
					<button>Breakfast</button>
					<div class="card">
						<div class="card-image"
							style="background-image: url(https://spoonacular.com/recipeImages/<?php echo $breakfast['id']; ?>-556x370.jpg)">
						</div>
						<div class="card-details">
							<h5>
								<?php echo $breakfast['title']; ?>
							</h5>
						</div>
						<div class="deit-details">
							<p><i class="fa-solid fa-fire"></i> Ready in
								<?php echo $breakfast['readyInMinutes'] ?> Minutes
							</p>
							<p><i class="fa-solid fa-arrow-up-9-1"></i>
								<?php echo $breakfast['servings'] ?> Servings
							</p>
						</div>
					</div>
				</div>
				<div id="<?php echo $lunch['id']; ?>" style="cursor: pointer;" class="meal-item">
					<button>Lunch</button>
					<div class="card">
						<div class="card-image"
							style="background-image: url(https://spoonacular.com/recipeImages/<?php echo $lunch['id']; ?>-556x370.jpg)">
						</div>
						<div class="card-details">
							<h5>
								<?php echo $lunch['title']; ?>
							</h5>
						</div>
						<div class="deit-details">
							<p><i class="fa-solid fa-fire"></i> Ready in
								<?php echo $lunch['readyInMinutes'] ?> Minutes
							</p>
							<p><i class="fa-solid fa-arrow-up-9-1"></i>
								<?php echo $lunch['servings'] ?> Servings
							</p>
						</div>
					</div>
				</div>
				<div id="<?php echo $dinner['id']; ?>" style="cursor: pointer;" class="meal-item">
					<button>Dinner</button>
					<div class="card">
						<div class="card-image"
							style="background-image: url(https://spoonacular.com/recipeImages/<?php echo $dinner['id']; ?>-556x370.jpg)">
						</div>
						<div class="card-details">
							<h5>
								<?php echo $dinner['title']; ?>
							</h5>
						</div>
						<div class="deit-details">
							<p><i class="fa-solid fa-fire"></i> Ready in
								<?php echo $dinner['readyInMinutes'] ?> Minutes
							</p>
							<p><i class="fa-solid fa-arrow-up-9-1"></i>
								<?php echo $dinner['servings'] ?> Servings
							</p>
						</div>
					</div>
				</div>
			</div>
			<hr class="divider" />

			<?php $day_counter++;
		}
	} ?>
	<?php
	$my_html = ob_get_contents();
	ob_end_clean();
	wp_send_json_success($my_html);

}

add_action("wp_ajax_nopriv_get_meal_plan", "get_meal_plan");
add_action("wp_ajax_get_meal_plan", "get_meal_plan");


/**
 * Generate 8 weeks meal plan. Each day will have 4 recipes(Breakfast, Lunch, Dinner, Snack).
 */

function generateMealPlan($week_number)
{
	$user_id = get_current_user_id();
	$user_TDEE = get_user_meta($user_id, 'TDEE', true) ?: '2000';
	$excluded_ingredients_meta = get_user_meta($user_id, 'excluded_ingredients', true) ?: [];
	if (!empty($excluded_ingredients_meta)) {
		$excluded_ingredients = implode(',', $excluded_ingredients_meta);
		$excluded_ingredients_key = implode('_', $excluded_ingredients_meta);
	}
	$weekly_plan = get_user_meta($user_id, 'weekly_plan_' . $user_TDEE . '_' . $excluded_ingredients_key . '_' . $week_number, true) ?: [];
	// $all_recipes_list = get_user_meta($user_id, '$recipes_list_' . $user_TDEE . '_' . $excluded_ingredients_key, true) ?: [];
	// wp_send_json_success($all_recipes_list);

	if (!empty($weekly_plan) && !$weekly_plan['error']) {
		return $weekly_plan;
	}

	// get data from Spoonacular API
	$url = "https://api.spoonacular.com/mealplanner/generate?apiKey=" . _API_KEY . "&timeFrame=week&targetCalories=" . $user_TDEE . "&exclude=" . $excluded_ingredients;
	$response = wp_remote_get(
		$url,
		array()
	);

	if (is_wp_error($response)) {
		$error = $response->get_error_message();
		$error_message = array('error' => "Something went wrong: $error");
		update_user_meta($user_id, 'weekly_plan_' . $user_TDEE . '_' . $excluded_ingredients_key . '_' . $week_number, $error_message);
		return $error_message;
	} else {
		$apiBody = wp_remote_retrieve_body($response);
		$apiBody = json_decode($apiBody, true);
		$week_plan = $apiBody['week'];
		if (isset($week_plan)) {
			$all_recipes_list = get_user_meta($user_id, '$recipes_list_' . $user_TDEE . '_' . $excluded_ingredients_key, true) ?: [];
			foreach ($week_plan as $day => $dayData) {
				foreach ($dayData['meals'] as $key => $meal) {
					if (!in_array($meal['id'], $all_recipes_list)) {
						$all_recipes_list[] = $meal['id'];
					} else {
						$new_meals = getNewUniqueRecipe($excluded_ingredients, $key, $week_number);
						foreach ($new_meals as $new_meal) {
							if (!in_array($new_meal['id'], $all_recipes_list)) {
								$all_recipes_list[] = $new_meal['id'];
								$week_plan[$day]['meals'][$key] = $new_meal;
								break;
							}
						}
					}
				}
			}
			update_user_meta($user_id, '$recipes_list_' . $user_TDEE . '_' . $excluded_ingredients_key, $all_recipes_list);
			update_user_meta($user_id, 'weekly_plan_' . $user_TDEE . '_' . $excluded_ingredients_key . '_' . $week_number, $week_plan);
			return $week_plan;
		} else {
			$error_message = array('error' => "Something went wrong " . $apiBody['message']);
			update_user_meta($user_id, 'weekly_plan_' . $user_TDEE . '_' . $excluded_ingredients_key . '_' . $week_number, $error_message);
			return $error_message;
		}

	}
}

function getNewUniqueRecipe($excluded_ingredients, $key, $week_number)
{

	$offset = $week_number * 10 * 5;
	$type = "breakfast";
	if ($key == 1) {
		$type = "main course, Salad or Soup";
	} else if ($key == 2) {
		$type = "main course, Dessert, Bread";
	}
	$url = 'https://api.spoonacular.com/recipes/complexSearch?number=20&offset=' . $offset . '&type=' . $type . '&excludeIngredients=' . $excluded_ingredients . '&apiKey=' . _API_KEY;
	$response = wp_remote_get(
		$url,
		array()
	);
	if (is_wp_error($response)) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		$apiBody = wp_remote_retrieve_body($response);
		$apiBody = json_decode($apiBody, true);
		return $apiBody['results'];
	}

}


/**
 *  Get excluded ingredients from ajax call and Store excluded ingredients in user meta
 */

function exclude_ingredients()
{

	$user_id = get_current_user_id();
	$excluded_ingredients = $_POST['excluded_ingredients'];
	// Check if the new and previous are not the same

	$call_type = $_POST['call_type'];
	if ($call_type == 'add') {
		if ($excluded_ingredients != get_user_meta($user_id, 'excluded_ingredients', true)) {
			update_user_meta($user_id, 'excluded_ingredients', $excluded_ingredients);
		}
	} else {
		$excluded_ingredients = get_user_meta($user_id, 'excluded_ingredients', true) ?: [];
	}
	wp_send_json_success($excluded_ingredients);
}

add_action('wp_ajax_exclude_ingredients', 'exclude_ingredients');
add_action('wp_ajax_nopriv_exclude_ingredients', 'exclude_ingredients');


/**
 * Calculate required water intake
 * @param float $user_weight
 * @param float $user_height
 * @return float $calculatedWaterIntake
 */
function calculateWaterIntake($user_weight)
{
	// Using Harris Benedict Equation to calculate DRI
	$calculatedWaterIntake = $user_weight * 0.035;
	return $calculatedWaterIntake;
}


/**
 * Ajax handler for updating user's data
 */
function update_user_data()
{
	$field_name = $_POST['name'];
	$field_value = $_POST['value'];

	$user_id = get_current_user_id();

	$current_field_data = get_user_meta($user_id, $field_name, true);
	if (isset($current_field_data)) {
		update_user_meta($user_id, $field_name, $field_value);
	} else {
		add_user_meta($user_id, $field_name, $field_value);
	}

	$user_weight = floatval(get_user_meta($user_id, 'current-weight', true) ?: '80.0');
	$user_height = floatval(get_user_meta($user_id, 'height', true) ?: '160.0');
	$user_age = floatval(get_user_meta($user_id, 'age', true) ?: '25');
	$user_daily_goal = floatval(get_user_meta($user_id, 'daily-goal', true) ?: '0');
	$user_activity_level = floatval(get_user_meta($user_id, 'activity-level', true) ?: '1.4');

	$user_calculated_water_intake = round(calculateWaterIntake($user_weight), 2);


	$user_stored_water_intake = get_user_meta($user_id, 'water-intake', true);
	if (isset($user_stored_water_intake)) {
		update_user_meta($user_id, 'water-intake', $user_calculated_water_intake);
	} else {
		add_user_meta($user_id, 'water-intake', $user_calculated_water_intake);
	}

	$user_calculated_TDEE = intval(calculateTDEE($user_weight, $user_height, $user_age, $user_activity_level, $user_daily_goal));
	$user_stored_TDEE = get_user_meta($user_id, 'TDEE', true);
	if (isset($user_stored_TDEE)) {
		update_user_meta($user_id, 'TDEE', $user_calculated_TDEE);
	} else {
		add_user_meta($user_id, 'TDEE', $user_calculated_TDEE);
	}


	$user_calculated_DRI = calculateDRI($user_calculated_TDEE);


	$user_stored_DRI = get_user_meta($user_id, 'DRI', true);
	if (isset($user_stored_DRI)) {
		update_user_meta($user_id, 'DRI', $user_calculated_DRI);
	} else {
		add_user_meta($user_id, 'DRI', $user_calculated_DRI);
	}



	$send_TDEE_DRI = [
		'status' => 'success',
		'TDEE' => $user_calculated_TDEE,
		'DRI' => $user_calculated_DRI,
		'waterIntake' => $user_calculated_water_intake
	];

	echo json_encode($send_TDEE_DRI);
	die();
}
add_action("wp_ajax_nopriv_update_user_data", "update_user_data");
add_action("wp_ajax_update_user_data", "update_user_data");

/**
 * Ajax handler for updating user's data
 */
function update_quiz_data()
{
	$field_name = $_POST['field_name'];
	$field_value = $_POST['field_value'];

	$user_quiz_data = [
		$field_name => $field_value,
	];
	if (!isset($_SESSION['user_quiz_data'])) {
		$_SESSION['user_quiz_data'] = array();
	}


	$_SESSION['user_quiz_data'] = array_merge($_SESSION['user_quiz_data'], $user_quiz_data);

	$data = [
		'status' => 'success',
		'field_name' => $field_name,
		'field_value' => $_SESSION['user_quiz_data'][$field_name],
	];

	echo json_encode($data);
	die();
}
add_action("wp_ajax_nopriv_update_quiz_data", "update_quiz_data");
add_action("wp_ajax_update_quiz_data", "update_quiz_data");

/**
 * Calculate TDEE
 * @return float $calculatedTDEE
 * @param array $user_data
 *
 */
function calculateTDEE($user_weight, $user_height, $user_age, $user_activity, $user_goal)
{
	// Using Harris Benedict Equation to  calculate TDEE
	// $TDEE = (9.247 * $user_weight) + (3.098 * $user_height) - (4.33 * $user_age) + 447.593;
	$TDEE = 655.1 + (9.563 * $user_weight) + (1.850 * $user_height) - (4.676 * $user_age);

	$calculatedTDEE = applyActivityLevel($TDEE, $user_activity);
	$calculatedTDEE = adjustTDEEforGoal($calculatedTDEE, $user_goal);
	return $calculatedTDEE;
}
/**
 * Multiply the calculated TDEE by the activity level
 * and return the result
 * @param float $TDEE
 * @param float $activity
 * @return float $calculatedTDEE
 * 
 */
function applyActivityLevel($TDEE, $activity)
{
	// Check activity level value 
	$validLevels = [1.2, 1.4, 1.6, 1.725, 1.9];
	if (!in_array($activity, $validLevels)) {
		return $TDEE;
	}

	$calculatedTDEE = $TDEE * $activity;
	return $calculatedTDEE;
}

/**
 * 
 * Adjust TDEE based on user input for user goal
 * @param float $TDEE
 * @param string $user_goal
 * @param string $user_goal_details
 * @param array $user_data
 * @return float $final-adjusted-TDEE
 */

function adjustTDEEforGoal($TDEE, $user_goal)
{
	// $goal_adjustments = [
	// 	'cutting' => [
	// 		'advanced' => -500,
	// 		'strong' => -400,
	// 		'accelerated' => -300,
	// 		'regular' => -200,
	// 	],
	// 	'bulking' => [
	// 		'regular' => 200,
	// 		'accelerated' => 300,
	// 		'strong' => 400,
	// 		'advanced' => 500,
	// 	],
	// ];

	// if (!array_key_exists($user_goal, $goal_adjustments) || !array_key_exists($user_goal_details, $goal_adjustments[$user_goal])) {
	// 	return $TDEE;
	// }

	// $final_adjusted_TDEE = $TDEE + $goal_adjustments[$user_goal][$user_goal_details];
	$final_adjusted_TDEE = $TDEE + $user_goal;
	return $final_adjusted_TDEE;
}

/**
 * Calculate Dietary Reference Intake (DRI)
 * @param float $TDEE
 * @param array $ration = [fat, carbs, protein]
 * @return array $dri
 */
function calculateDRI($TDEE, $ratio = ['fat' => 65, 'carbs' => 15, 'protein' => 20])
{
	$dri = [];
	$calories_per_gram = [
		'fat' => 9,
		'carbs' => 4,
		'protein' => 4,
	];
	foreach ($ratio as $macronutrients => $percentage) {
		$calories = $TDEE * ($percentage / 100);
		$grams = $calories / $calories_per_gram[$macronutrients];

		$dri[$macronutrients] = ['calories' => $calories, 'grams' => $grams];

	}
	return $dri;

}


function getNewUniqueRecipeSimilar($recipe_id)
{
	// Get data from api
	$url = 'https://api.spoonacular.com/recipes/' . $recipe_id . '/similar?apiKey=' . _API_KEY;
	$response = wp_remote_get(
		$url,
		array()
	);
	if (is_wp_error($response)) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		$apiBody = wp_remote_retrieve_body($response);
		$apiBody = json_decode($apiBody, true);
		return $apiBody;
	}

}

// Assuming this code is in your theme's functions.php file or in a custom plugin

// Hook into user registration
add_action('user_register', 'update_user_meta_from_session');

function update_user_meta_from_session($user_id)
{
	// Check if the session data exists
	if (isset($_SESSION['user_quiz_data'])) {
		// Get the session data
		$user_quiz_data = $_SESSION['user_quiz_data'];

		// Update user meta with the session data
		update_user_meta($user_id, 'current-weight', $user_quiz_data['current-weight']);
		update_user_meta($user_id, 'height', $user_quiz_data['height']);
		update_user_meta($user_id, 'age', $user_quiz_data['age']);
		update_user_meta($user_id, 'daily-goal', $user_quiz_data['daily_goal']);
		update_user_meta($user_id, 'activity-level', $user_quiz_data['activity_level']);


		$user_weight = floatval(get_user_meta($user_id, 'current-weight', true) ?: '80.0');
		$user_height = floatval(get_user_meta($user_id, 'height', true) ?: '160.0');
		$user_age = floatval(get_user_meta($user_id, 'age', true) ?: '25');
		$user_daily_goal = floatval(get_user_meta($user_id, 'daily-goal', true) ?: '0');
		$user_activity_level = floatval(get_user_meta($user_id, 'activity-level', true) ?: '1.4');

		$user_calculated_water_intake = round(calculateWaterIntake($user_weight), 2);


		$user_stored_water_intake = get_user_meta($user_id, 'water-intake', true);
		if (isset($user_stored_water_intake)) {
			update_user_meta($user_id, 'water-intake', $user_calculated_water_intake);
		} else {
			add_user_meta($user_id, 'water-intake', $user_calculated_water_intake);
		}

		$user_calculated_TDEE = intval(calculateTDEE($user_weight, $user_height, $user_age, $user_activity_level, $user_daily_goal));
		$user_stored_TDEE = get_user_meta($user_id, 'TDEE', true);
		if (isset($user_stored_TDEE)) {
			update_user_meta($user_id, 'TDEE', $user_calculated_TDEE);
		} else {
			add_user_meta($user_id, 'TDEE', $user_calculated_TDEE);
		}


		$user_calculated_DRI = calculateDRI($user_calculated_TDEE);


		$user_stored_DRI = get_user_meta($user_id, 'DRI', true);
		if (isset($user_stored_DRI)) {
			update_user_meta($user_id, 'DRI', $user_calculated_DRI);
		} else {
			add_user_meta($user_id, 'DRI', $user_calculated_DRI);
		}

		// Optionally, you can unset the session data after updating user meta
		unset($_SESSION['user_quiz_data']);
	}

}
