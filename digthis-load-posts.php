<?php
/*
Plugin Name: Digthis Load More Posts
Description: Load Posts via wordpress underscore templating
Plugin URI: https://github.com/digamber89/wp-js-templating
Author: Author
Author URI: https://www.digamberpradhan.com.np/
Version: 1.0
License: https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
Text Domain: Text Domain
Domain Path: digthis-load-posts
*/

/**
 * Register Posts for Later User
 */
if( !defined( 'DLP_FILE_PATH' ) ){
	define( 'DLP_FILE_PATH', __FILE__ );
}

if( !defined('DLP_DIR_PATH') ){
	define( 'DLP_DIR_PATH', dirname( __FILE__ ) );
}

/**
 * Load Shortcode 
 */
require_once( DLP_DIR_PATH.'/inc/shortcode.php' );

/**
 * Load Ajax Hanlder 
 */
require_once( DLP_DIR_PATH.'/inc/ajax.php' );

add_action('init', 'digthis_register_posts');
function digthis_register_posts(){
	
	//https://developer.wordpress.org/rest-api/using-the-rest-api/pagination/
	$default_posts_per_page = get_option( 'posts_per_page' );
	$ajax_url = admin_url( 'admin-ajax.php' );
	//get_rest_url( int $blog_id = null, string $path = '/', string $scheme = 'rest' )
	//https://developer.wordpress.org/reference/functions/get_rest_url/
	$rest_url = get_rest_url( NULL, '/wp/v2/posts'); 
	$rest_url .= '?per_page='.$default_posts_per_page;
	/*No Need to Register Underscore comes pre-packaged simpy use dependency wp-util*/
	
	wp_register_script( 'digthis-load-more-js', plugins_url( 'assets/js/load-more.js', DLP_FILE_PATH ), array( 'wp-util'), '1.0.0', true );
	wp_localize_script( 'digthis-load-more-js', 'digthis', array('ajaxUrl' => $ajax_url, 'restUrl' => $rest_url ) );
}