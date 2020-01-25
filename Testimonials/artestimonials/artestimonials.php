<?php
/**
 * Plugin Name:  AR Testimonials
 * Plugin URI:   https://github.com/anisur2805/artestimonials
 * Description:  Testimonials many more example you get here. Use your choose style.
 * Author:       Anisur Rahman
 * Author URI:   https://github.com/anisur2805/
 * Version:      1.0.0
 * Text Domain:  art
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) { die; } 

// function art_setup_post_type() {
//     // register the "art" custom post type
//     register_post_type( 'art', ['public' => 'true'] );
// }
// add_action( 'init', 'art_setup_post_type' );
 
// function art_install() {
//     // trigger our function that registers the custom post type
//     art_setup_post_type();
 
//     // clear the permalinks after the post type has been registered
//     flush_rewrite_rules();
// }
// register_activation_hook( __FILE__, 'art_install' );

// function art_deactivation() {
//     // unregister the post type, so the rules are no longer in memory
//     unregister_post_type( 'art' );
//     // clear the permalinks to remove our post type's rules from the database
//     flush_rewrite_rules();
// }
// register_deactivation_hook( __FILE__, 'art_deactivation' );



require_once ( plugin_dir_path( __FILE__ ) . 'art-functions.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'art-post-type.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'art-texonomy.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'art-metaboxes.php' );
require_once ( plugin_dir_path( __FILE__ ) . 'art-shortcodes.php' ); 
require_once ( plugin_dir_path( __FILE__ ) . 'art-settings.php' );
