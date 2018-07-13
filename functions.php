<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('init', 'film_post_type_init');
add_action('init', 'create_film_taxonomies', 0);
// ===============================================
// for datepicker
// ===============================================
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

function theme_enqueue_styles() {

	$parent_style = 'unite-parent-style';

	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
	wp_enqueue_style('child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('Version')
	);
}
/**
 * Register film post type.
 *
 */
function film_post_type_init() {
	$labels = array(
		'name' => _x('Films', 'post type general name', 'unite-child'),
		'singular_name' => _x('Films', 'post type singular name', 'unite-child'),
		'menu_name' => _x('Films', 'admin menu', 'unite-child'),
		'name_admin_bar' => _x('Films', 'add new on admin bar', 'unite-child'),
		'add_new' => _x('Add New', 'book', 'unite-child'),
		'add_new_item' => __('Add New Films', 'unite-child'),
		'new_item' => __('New Films', 'unite-child'),
		'edit_item' => __('Edit Films', 'unite-child'),
		'view_item' => __('View Films', 'unite-child'),
		'all_items' => __('All Films', 'unite-child'),
		'search_items' => __('Search Films', 'unite-child'),
		'parent_item_colon' => __('Parent Films:', 'unite-child'),
		'not_found' => __('No Films found.', 'unite-child'),
		'not_found_in_trash' => __('No Films found in Trash.', 'unite-child'),
	);

	$args = array(
		'labels' => $labels,
		'description' => __('Description.', 'unite-child'),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'film'),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt'),
	);

	register_post_type('film', $args);
}

// create two taxonomies, genres,countries,years,actors for the post type "film"
function create_film_taxonomies() {
	// Genre
	$labels = array(
		'name' => _x('Genres', 'taxonomy general name', 'unite-child'),
		'singular_name' => _x('Genre', 'taxonomy singular name', 'unite-child'),
		'search_items' => __('Search Genres', 'unite-child'),
		'all_items' => __('All Genres', 'unite-child'),
		'parent_item' => __('Parent Genre', 'unite-child'),
		'parent_item_colon' => __('Parent Genre:', 'unite-child'),
		'edit_item' => __('Edit Genre', 'unite-child'),
		'update_item' => __('Update Genre', 'unite-child'),
		'add_new_item' => __('Add New Genre', 'unite-child'),
		'new_item_name' => __('New Genre Name', 'unite-child'),
		'menu_name' => __('Genre', 'unite-child'),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'genre'),
	);

	register_taxonomy('genre', array('film'), $args);
	// Country
	$labels = array(
		'name' => _x('Countries', 'taxonomy general name', 'unite-child'),
		'singular_name' => _x('Country', 'taxonomy singular name', 'unite-child'),
		'search_items' => __('Search Countries', 'unite-child'),
		'popular_items' => __('Popular Countries', 'unite-child'),
		'all_items' => __('All Countries', 'unite-child'),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __('Edit Country', 'unite-child'),
		'update_item' => __('Update Country', 'unite-child'),
		'add_new_item' => __('Add New Country', 'unite-child'),
		'new_item_name' => __('New Country Name', 'unite-child'),
		'separate_items_with_commas' => __('Separate Countries with commas', 'unite-child'),
		'add_or_remove_items' => __('Add or remove Countries', 'unite-child'),
		'choose_from_most_used' => __('Choose from the most used Countries', 'unite-child'),
		'not_found' => __('No Countries found.', 'unite-child'),
		'menu_name' => __('Country', 'unite-child'),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'country'),
	);

	register_taxonomy('country', 'film', $args);

	// Actor
	$labels = array(
		'name' => _x('Actors', 'taxonomy general name', 'unite-child'),
		'singular_name' => _x('Actor', 'taxonomy singular name', 'unite-child'),
		'search_items' => __('Search Actors', 'unite-child'),
		'popular_items' => __('Popular Actors', 'unite-child'),
		'all_items' => __('All Actors', 'unite-child'),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __('Edit Actor', 'unite-child'),
		'update_item' => __('Update Actor', 'unite-child'),
		'add_new_item' => __('Add New Actor', 'unite-child'),
		'new_item_name' => __('New Actor Name', 'unite-child'),
		'separate_items_with_commas' => __('Separate Actors with commas', 'unite-child'),
		'add_or_remove_items' => __('Add or remove Actors', 'unite-child'),
		'choose_from_most_used' => __('Choose from the most used Actors', 'unite-child'),
		'not_found' => __('No Actors found.', 'unite-child'),
		'menu_name' => __('Actor', 'unite-child'),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'actor'),
	);

	register_taxonomy('actor', 'film', $args);
	// year
	$labels = array(
		'name' => _x('Years', 'taxonomy general name', 'unite-child'),
		'singular_name' => _x('Year', 'taxonomy singular name', 'unite-child'),
		'search_items' => __('Search Years', 'unite-child'),
		'popular_items' => __('Popular Years', 'unite-child'),
		'all_items' => __('All Years', 'unite-child'),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __('Edit Year', 'unite-child'),
		'update_item' => __('Update Year', 'unite-child'),
		'add_new_item' => __('Add New Year', 'unite-child'),
		'new_item_name' => __('New Year Name', 'unite-child'),
		'separate_items_with_commas' => __('Separate Years with commas', 'unite-child'),
		'add_or_remove_items' => __('Add or remove Years', 'unite-child'),
		'choose_from_most_used' => __('Choose from the most used Years', 'unite-child'),
		'not_found' => __('No Years found.', 'unite-child'),
		'menu_name' => __('Year', 'unite-child'),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => false,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array('slug' => 'Year'),
	);

	register_taxonomy('year', 'film', $args);
}

/**
 * Custom post meta
 */
require get_stylesheet_directory() . '/includes/custom-post-meta.php';
/**
 * Custom table listing
 */
require get_stylesheet_directory() . '/includes/custom-listing-film.php';
?>