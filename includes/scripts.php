<?php

if ( is_admin() ) {   
    add_action('admin_enqueue_scripts', 'wpideaforge_admin_style');
} else {
    add_action('wp_enqueue_scripts', 'wpideaforge_style');
}

function wpideaforge_admin_style() {
    
}

function wpideaforge_style() {
    wp_register_style( 
            'wpideaforge_css', 
            WPIDEAFORGE_URL . '/css/frontend.css', 
            false, 
            WPIDEAFORGE_VERSION );
    wp_enqueue_style( 'wpideaforge_css' );    
    //
    wp_enqueue_script("jquery"); 
    //
    wp_register_script( 
            'wpideaforge_js', 
            WPIDEAFORGE_URL . '/js/frontend.js', 
            false, 
            WPIDEAFORGE_VERSION );
    wp_enqueue_script( 'wpideaforge_js' );    
    wp_localize_script( 
            'wpideaforge_js', 
            'cfg', 
            array( 
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'wpidea_nonce' => wp_create_nonce( 'wpidea_nonce' ),
                'txt_success' => __('Thanks for the new Idea.',WPIDEAFORGE_TEXTDOMAIN),
                'txt_nosuccess' => __('Something went wrong, please try again.',WPIDEAFORGE_TEXTDOMAIN)
            ));
}
