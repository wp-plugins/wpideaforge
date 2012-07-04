<?php

add_shortcode('wpideaforge', 'wpideaforge_filter');

function wpideaforge_filter( $attr ) {
global $post;

    ob_start ();
    // Include Form and Filter
    include WPIDEAFORGE_DIR . '/includes/html/form.php';
    include WPIDEAFORGE_DIR . '/includes/html/filter.php';    
    // Get all Ideas
	$args = array( 
		'post_type' => 'ideas',
		'order_by' => 'meta_value',
		'meta_key' => 'wpideaforge_counter',
		'order' => 'asc', 
		'post_status' => 'publish',
		'posts_per_page' => 9999 
	);
	$loop = new WP_Query( $args );
    // Templating of Ideas 
    echo '<div class="wpideaforge_votes">';
    include WPIDEAFORGE_DIR . '/includes/html/idea.php';
    echo '</div>';
    //
    $r = ob_get_contents(); 
    ob_end_clean();
    return $r;
}
