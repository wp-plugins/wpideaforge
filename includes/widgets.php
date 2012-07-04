<?php

function wpideaforge_widget_topideas( $args ) {
GLOBAL $wpideaforge_options;

    extract($args);
    echo $before_widget;
    echo $before_title . __('Top Ideas',WPIDEAFORGE_TEXTDOMAIN) . $after_title;
    // Query for <ul>
    $args = array( 
            'post_type' => 'ideas',
            'order_by' => 'meta_value',
            'meta_key' => 'wpideaforge_counter',
            'order' => 'asc', 
            'post_status' => 'publish',
            'posts_per_page' => 3 
    );
    $loop = new WP_Query( $args );
    // Output of Data
    echo "<ul>";
    while ( $loop->have_posts() ){ 
        $loop->the_post();
        echo "<li>";
        the_title();
        echo "</li>";
    }
    echo "</ul>";
    echo '<a href="'.$wpideaforge_options['wpideaforge_url_top'].'">'.__('Visit Ideas',WPIDEAFORGE_TEXTDOMAIN).'</a>';
    //
    echo $after_widget;
}
function wpideaforge_widget_newestideas( $args ) {
GLOBAL $wpideaforge_options;

    extract($args);
    echo $before_widget;
    echo $before_title . __('Newest Ideas',WPIDEAFORGE_TEXTDOMAIN) . $after_title;
    // Query for <ul>
    $args = array( 
            'post_type' => 'ideas',
            'post_status' => 'publish',
            'posts_per_page' => 3 
    );
    $loop = new WP_Query( $args );
    // Output of Data
    echo "<ul>";
    while ( $loop->have_posts() ){ 
        $loop->the_post();
        echo "<li>";
        the_title();
        echo "</li>";
    }
    echo "</ul>";
    echo '<a href="'.$wpideaforge_options['wpideaforge_url_new'].'">'.__('Visit Ideas',WPIDEAFORGE_TEXTDOMAIN).'</a>';
    //
    echo $after_widget;
}

function wpideaforge_widget_control_topideas() {
GLOBAL $wpideaforge_options;

    // On Post Save Options
    if ( isset( $_POST['wpideaforge_url_top'] ) ) {
        $url = wp_filter_nohtml_kses($_POST['wpideaforge_url_top']);
        $wpideaforge_options['wpideaforge_url_top'] = $url;
        update_option('wpideaforge_options',$wpideaforge_options);
    }
    //
    echo '<p style="text-align:right;">';
    echo '<label for "wpideaforge_url_top">';
    echo __('URL of Ideas',WPIDEAFORGE_TEXTDOMAIN);
    echo '</label>';
    echo '<input type="text" name="wpideaforge_url_top" id="wpideaforge_url_top" value="'.$wpideaforge_options['wpideaforge_url_top'].'"/>';
    echo '</p>'."\n";    
}

function wpideaforge_widget_control_newestideas() {
GLOBAL $wpideaforge_options;

    // On Post Save Options
    if ( isset( $_POST['wpideaforge_url_new'] ) ) {
        $url = wp_filter_nohtml_kses($_POST['wpideaforge_url_new']);
        $wpideaforge_options['wpideaforge_url_new'] = $url;
        update_option('wpideaforge_options',$wpideaforge_options);
    }
    //
    echo '<p style="text-align:right;">';
    echo '<label for "wpideaforge_url_new">';
    echo __('URL of Ideas',WPIDEAFORGE_TEXTDOMAIN);
    echo '</label>';
    echo '<input type="text" name="wpideaforge_url_new" id="wpideaforge_url_new" value="'.$wpideaforge_options['wpideaforge_url_new'].'"/>';
    echo '</p>'."\n";    
}

/**
 * Hooks for WordPress 
 */
function wpideaforge_register_widgets() {
    wp_register_sidebar_widget(
        'wpideaforge_widget_topideas',
        __('Top Ideas',WPIDEAFORGE_TEXTDOMAIN),          
        'wpideaforge_widget_topideas',  
        array(                  
            'description' => __('Top Ideas of wpIdeaForge',WPIDEAFORGE_TEXTDOMAIN),
        )
    );
    wp_register_widget_control(
            'wpideaforge_widget_topideas',        
            __('Top Ideas',WPIDEAFORGE_TEXTDOMAIN), 
            'wpideaforge_widget_control_topideas'
        );
    wp_register_sidebar_widget(
        'wpideaforge_widget_newestideas',
        __('Newest Ideas',WPIDEAFORGE_TEXTDOMAIN),          
        'wpideaforge_widget_newestideas',  
        array(                  
            'description' => __('Newest Ideas of wpIdeaForge',WPIDEAFORGE_TEXTDOMAIN),
        )
    );
    wp_register_widget_control(
            'wpideaforge_widget_newestideas',        
            __('Newest Ideas',WPIDEAFORGE_TEXTDOMAIN), 
            'wpideaforge_widget_control_newestideas'
        );
}

// Fallback for Widgets API
if( function_exists('load_plugin_textdomain') ) {
    load_plugin_textdomain( load_plugin_textdomain( WPIDEAFORGE_TEXTDOMAIN, false, WPIDEAFORGE_NAME . '/languages' ));
}
add_action('widgets_init', 'wpideaforge_register_widgets');