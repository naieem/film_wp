<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('init', 'film_post_type_init');

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
?>