<?php

// Crate Custom Post Type Ideas
add_action('init', 'wpideaforge_cpt');

function wpideaforge_cpt() {

    $labels = array(
        'name' => __("Ideas", WPIDEAFORGE_TEXTDOMAIN),
        'all_items'=> __("All Ideas", WPIDEAFORGE_TEXTDOMAIN),
        'singular_name' => __("Idea", WPIDEAFORGE_TEXTDOMAIN),
        'add_new' => __("New Idea", WPIDEAFORGE_TEXTDOMAIN),
        'add_new_item' => __("Add new Idea", WPIDEAFORGE_TEXTDOMAIN),
        'edit_item' => __("Edit Idea", WPIDEAFORGE_TEXTDOMAIN),
        'new_item' => __("New Idea", WPIDEAFORGE_TEXTDOMAIN),
        'view_item' => __("View Idea", WPIDEAFORGE_TEXTDOMAIN),
        'search_items' => __("Search Ideas", WPIDEAFORGE_TEXTDOMAIN),
        'not_found' =>  __("No Ideas Found", WPIDEAFORGE_TEXTDOMAIN),
        'not_found_in_trash' => __("No Ideas Found in Trash", WPIDEAFORGE_TEXTDOMAIN)
    );    
    
    $args = array(
            'labels' => $labels,
            'public' => false,
            'query_var' => 'ideas',
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'supports' => array('title')
    );
    
    register_post_type( 'ideas' , $args );
}
