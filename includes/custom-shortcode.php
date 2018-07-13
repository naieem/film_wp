<?php
// [latestfilm count="5"]
function show_film($atts) {
	$films = shortcode_atts(array(
		'count' => '',
	), $atts);
	ob_start();
	$args = array(
		'numberposts' => $films['count'],
		'offset' => 0,
		'category' => 0,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'film',
		'post_status' => 'draft, publish, future, pending, private',
		'suppress_filters' => true,
	);

	$recent_posts = wp_get_recent_posts($args, ARRAY_A);
	foreach ($recent_posts as $recent) {
		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"] . '</a> </li> ';
	}
	wp_reset_query();
	$all_film = ob_get_clean();
	return $all_film;
}
add_shortcode('latestfilm', 'show_film');