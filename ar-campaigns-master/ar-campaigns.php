<?php
/**
Plugin Name: AR Campaigns
Plugin URI: https://github.com/anisur2805/ar-campaigns
Description: Campaigns
Version: 0.1.0
Author: Anisur Rahman
Author URI: https://github.com/anisur2805
Text Domain: ar-campaigns
*/

defined( 'ABSPATH' ) or die( 'No Cheating!' );


define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_FILE', __FILE__ );
/*
 * Includes all files
 */
include PLUGIN_PATH.'inc/ar-campaigns-post-types.php';
include PLUGIN_PATH.'inc/ar-campaigns-shortcodes.php';
include PLUGIN_PATH.'inc/ar-functions.php';
//include PLUGIN_PATH.'inc/single-ar_campaign.php';


    /* Filter the single_template with our custom function*/
    add_filter('single_template', 'my_custom_template');

    function my_custom_template($single) {

        global $post;

        /* Checks for single template by post type */
        if ( $post->post_type == 'ar_campaign' ) {
            if ( file_exists( PLUGIN_PATH . 'inc/single-ar_campaign.php' ) ) {
                return PLUGIN_PATH . 'inc/single-ar_campaign.php';
            }
        }

        return $single;

    }