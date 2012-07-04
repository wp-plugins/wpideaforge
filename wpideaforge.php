<?php
/**
Plugin Name:	wpIdeaForge
Plugin URI:		https://github.com/gmuehl/wpideaforge/
Description:	Let's user suggest Ideas for upcoming Articles.
Text Domain: 	wpideaforge
Domain Path: 	/languages
Version:		0.5.0
Author:			Guido Mühlwitz
Author URI:		http://www.guido-muehlwitz.de
Last change: 	02.07.2012
*/

$poedit_scanner = __("Let's user suggest Ideas for upcoming Articles.");

/**
 * Avoid direct calls to this file
 */
if ( !function_exists('add_action') ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
} elseif ( version_compare(phpversion(), '5.0.0', '<') ) {
	$exit_msg = 'The plugin require PHP 5 or newer';
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit($exit_msg);
}

/**
 * Plugin Options 
 */
$wpideaforge_options = get_option('wpideaforge_options');
// Workaround, wenn Array nicht geladen werden kann
if( !$wpideaforge_options ) {
    $wpideaforge_options = array(
        "wpideaforge_url_top" => "",
        "wpideaforge_url_new" => ""
    );
}

/**
 * Define Constants
 */
define( 'WPIDEAFORGE_NAME', 'wpideaforge');
define( 'WPIDEAFORGE_DIR', WP_PLUGIN_DIR . '/' . WPIDEAFORGE_NAME );
define( 'WPIDEAFORGE_CONTENT_URL', get_option('siteurl' ) . '/wp-content' );
define( 'WPIDEAFORGE_PLUGINS_URL', WPIDEAFORGE_CONTENT_URL.'/plugins' );
define( 'WPIDEAFORGE_URL', WPIDEAFORGE_PLUGINS_URL.'/'.WPIDEAFORGE_NAME );
define( 'WPIDEAFORGE_TEXTDOMAIN', 'wpideaforge' );
define( 'WPIDEAFORGE_VERSION', '0.5.0' );

/**
 * Init Text Domain 
 */
function wpideaforge_lang() {    
    load_plugin_textdomain( WPIDEAFORGE_TEXTDOMAIN, false, WPIDEAFORGE_NAME . '/languages' );
}

// Hooks for Frontend & Backend
add_action( 'init', 'wpideaforge_lang' );
require_once WPIDEAFORGE_DIR . '/includes/custom-post-type.php';
require_once WPIDEAFORGE_DIR . '/includes/scripts.php';
require_once WPIDEAFORGE_DIR . '/includes/ajax.php';
require_once WPIDEAFORGE_DIR . '/includes/widgets.php';
if( is_admin() ) {
    require_once WPIDEAFORGE_DIR . '/includes/countbox.php';
    require_once WPIDEAFORGE_DIR . '/includes/indexlist.php';
} else {
    require_once WPIDEAFORGE_DIR . '/includes/filter.php';        
}
