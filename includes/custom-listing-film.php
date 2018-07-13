<?php
// for adding in header title
add_filter('manage_film_posts_columns', 'manage_film_table_head');
// for adding value of the added header column titles
add_action('manage_film_posts_custom_column', 'manage_film_table_content', 10, 2);

/**
 * for adding header title of the admin menu
 * @param  [type] $defaults
 * @return [type]
 */
function manage_film_table_head($defaults) {
	$defaults['release_date'] = 'Release Date';
	$defaults['ticket_price'] = 'Ticket Price';
	return $defaults;
}

/**
 * for adding value of the added header titles
 * @param  [type] $column_name
 * @param  [type] $post_id
 * @return [type]
 */
function manage_film_table_content($column_name, $post_id) {
	if ($column_name == 'release_date') {
		$event_date = get_post_meta($post_id, 'release_date', true);
		echo date(_x('F d, Y', 'Event date format', 'textdomain'), strtotime($event_date));
	}
	if ($column_name == 'ticket_price') {
		$status = get_post_meta($post_id, 'ticket_price', true);
		echo $status;
	}

}