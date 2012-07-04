<?php

add_action('admin_menu', 'wpideaforge_countbox');
add_action('save_post', 'wpideaforge_countdata');

/**
 * Hook zum Hinzufügen der Metabox 
 */
function wpideaforge_countbox() { 

    add_meta_box(
            'wpideaforge_countbox', 
            __('Votes'), 
            'wpideaforge_show_countbox', 
            'ideas', 
            'normal', 
            'low');
}

/**
 * Show Metabox
 */
function wpideaforge_show_countbox() {
global $post;

    $meta = get_post_meta($post->ID, 'wpideaforge_counter', true);
    // Nonce For Verification
    echo '<input type="hidden" name="wpideaforge_countbox_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    echo '<table class="form-table">';
    echo '<tr>',
            '<th style="width:20%"><label for="wpideaforge_counter">', __('Votes',WPIDEAFORGE_TEXTDOMAIN), '</label></th>',
            '<td>';
    echo '<input type="text" name="wpideaforge_counter" id="wpideaforge_counter" value="';
    echo $meta;
    echo '" size="30" style="width:97%" />';
    echo '<br />', '';
    echo '<td></tr>';      
    echo '</table>';
}

/**
 * Save Meta on Submit
 */
function wpideaforge_countdata( $postid ) {

    // Verify Nonce
    if( !array_key_exists('wpideaforge_countbox_nonce', $_POST) ) {
        return $postid;
    } else {
        if (!wp_verify_nonce($_POST['wpideaforge_countbox_nonce'], basename(__FILE__))) {
            return $postid;
        }
    }

    // No Update on Autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $postid;
    }
 
    // Save Field
    update_post_meta($postid, 'wpideaforge_counter', intval($_POST['wpideaforge_counter']));
}