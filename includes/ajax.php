<?php

if( is_admin() ) {
    add_action( 'wp_ajax_nopriv_wpideaforge_save', 'wpideaforge_save' );
    add_action( 'wp_ajax_wpideaforge_save', 'wpideaforge_save' );

    add_action( 'wp_ajax_nopriv_wpideaforge_counter', 'wpideaforge_counter' );
    add_action( 'wp_ajax_wpideaforge_counter', 'wpideaforge_counter' );
}

function wpideaforge_save() {

    // Check Nonce
    $nonce = $_POST['wpidea_nonce'];
    if ( !wp_verify_nonce( $nonce, 'wpidea_nonce' ) ) {
        // Wromg Nonce = Fraud
        die('no wine, no wife, no carrier ...');
    }
    
    // Create New Post
    $idea_post = array(
        'post_title' => wp_filter_nohtml_kses($_POST['idea']),
        'post_type' => 'ideas',
        'post_content' => '',
        'post_status' => 'draft',
        'post_author' => 1
    );
    $postid = wp_insert_post( $idea_post );
        
    // Set Counter to 0
    update_post_meta( $postid, 'wpideaforge_counter', 0 );
    
    // Success Output
    header( "Content-Type: application/json" );
    $response = json_encode( array( 'success' => true ) );
    echo $response;
    
    // Terminate Ajax
    exit;
}


function wpideaforge_counter() {

    // Check Nonce
    $nonce = $_POST['wpidea_nonce'];
    if ( !wp_verify_nonce( $nonce, 'wpidea_nonce' ) ) {
        // Wromg Nonce = Fraud
        die('no wine, no wife, no carrier ...');
    }
    
    // Update Counter of Post
    $postId = intval($_POST['postId']);
    $votes = get_post_meta( $postId, 'wpideaforge_counter', true);
    $votes = intval($votes)+1;
    update_post_meta( $postId, 'wpideaforge_counter', $votes );
    
    // Success Output
    header( "Content-Type: application/json" );
    $response = json_encode( array( 'success' => true, 'postId' => $postId, 'votes' => $votes ) );
    echo $response;
    
    // Terminate Ajax
    exit;
}