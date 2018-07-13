<?php
/**
 * Created by Naieem Mahmud Supto.
 * User: Naieem
 * Email: naieemsupto@gmail.com
 * Date: 7/13/2018
 * Time: 4:00 PM
 */

// registering meta boxes
add_action('add_meta_boxes', 'add_embed_meta_box');
// saving meta boxes data
add_action('save_post', 'save_embed_meta');

/**
 * Registering meta boxes
 */
function add_embed_meta_box() {
	$types = array('film');
	foreach ($types as $postType) {
		add_meta_box(
			'custom_header', // $id
			'Select Settings for the page', // $title
			'show_embed_meta_box', // $callback
			$postType, // $page
			'normal', // $context
			'high'); // $priority
	}
}

/**
 * Save the meta fields on save of the post
 * @param  [type] $post_id
 * @return [type]
 */
function save_embed_meta($post_id) {
	// verify nonce
	if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}

	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	$ticket_price = $_POST["ticket_price"];
	$release_date = $_POST['release_date'];
	update_post_meta($post_id, "ticket_price", $ticket_price);
	update_post_meta($post_id, "release_date", $release_date);
}

/**
 * showing meta boxes view in the film admin page
 * @return [type]
 */
function show_embed_meta_box() {
	global $post;
	$ticket_price = get_post_meta($post->ID, 'ticket_price', true);
	$release_date = get_post_meta($post->ID, 'release_date', true);

	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="' . wp_create_nonce(basename(__FILE__)) . '" />';

	echo '<table class="form-table">';
	// begin a table row with
	?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.custom_date').datepicker({
                dateFormat : 'yy-mm-dd'
            });
        });
    </script>
    <style>
    .form-table th {
        width: 50% !important;
    }

    .form-table input[type='text'] {
        width: 100%;
    }
</style>
<tr>
    <th>
        <label for="">Ticket Price:</label></th>
        <td>
            <input type="text" value="<?php echo $ticket_price; ?>" name="ticket_price">
        </td>
    </tr>
    <tr>
        <th>
            <label for="">Release Date:</label></th>
            <td>
                <input type="text" class="custom_date" value="<?php echo $release_date; ?>" name="release_date">
            </td>
        </tr>
        <?php
echo '</table>';
}