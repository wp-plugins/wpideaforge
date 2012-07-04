<?php

/**
 * Publish Button in Post Row 
 */
add_filter('post_row_actions','wpideaforge_action_row',10,2);

function wpideaforge_action_row( $actions, $post ) {
    if( $post->post_type == "ideas" ) {
        // Only show for Drafts
        if( $post->post_status == 'draft' ) {
            $url = add_query_arg( array( 'action' => 'wpif_publish', 'post' => $post->ID ) );
            $actions['wpif_publish'] = 
                '<a href="'
                .wp_nonce_url( $url, "wpif_publish_{$post->ID}" )
                .'">'
                . __('Publish',WPIDEAFORGE_TEXTDOMAIN)
                . '</a>';        
        }
    }
    return $actions;
}

/**
 * Publish when Publish Button has been Pressed 
 */
add_action( 'admin_init','wpideaforge_action_save');

function wpideaforge_action_save() {
    // Click ob Publish
    if( isset($_GET['action'], $_GET['_wpnonce'], $_GET['post']) && 'wpif_publish' == $_GET['action'] ) {
        // Check Nonce
        if( wp_verify_nonce( $_GET['_wpnonce'], 'wpif_publish_' . $_GET['post'] ) ) {
            // Redirect to Referer
            $referer = remove_query_arg( array( 'action', '_wpnonce', 'post' ), wp_get_referer() );
            //
            $update_post = array();
            $update_post['ID'] = absint($_GET['post']);
            $update_post['post_status'] = 'publish';
            wp_update_post( $update_post );
            // Redirect to Index
            wp_redirect( $referer );
            exit;
        }
    }    
 }

/**
 * Hooks for Custom Columns 
 */
add_filter('manage_edit-ideas_columns', 'wpideaforge_columns');
add_filter('manage_edit-ideas_sortable_columns', 'wpideaforge_sortable' );
add_action('manage_posts_custom_column', 'wpideaforge_columns_content', 10, 2);  

/**
 * Custom Columns for Index of Custom Post Type
 */
function wpideaforge_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['votes'] = __('Votes',WPIDEAFORGE_TEXTDOMAIN);
    $new_columns['date'] = $columns['date'];
    // titel kommentare datum
    return $new_columns;    
}

/**
 * Register Columns as Sortable
 */
function wpideaforge_sortable( $columns ) {
    $columns['votes'] = 'votes';
    return $columns;
}

/**
 * Content of Custom Columns
 */
function wpideaforge_columns_content( $column_name, $post_ID ) {
   if( $column_name == 'votes' ) {
       echo get_post_meta( $post_ID, 'wpideaforge_counter', true );
   }     
}
