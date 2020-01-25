<?php
/**
 * Plugin Name:  News 
 * Plugin URI:   https://github.com/anisur2805/news
 * Description:  News Description
 * Author:       Anisur Rahman
 * Author URI:   https://github.com/anisur2805/
 * Version:      1.0.0
 * Text Domain:  arnews
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	die;
}

require_once ( plugin_dir_path( __FILE__ ) . 'functions.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'post-type.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'metabox.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'sc.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'settings.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'query-news.php' );
// require_once ( plugin_dir_path( __FILE__ ) . 'news-single.php' );

