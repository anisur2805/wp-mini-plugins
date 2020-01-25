<?php
/**
 * @package oopwpplugin
 */
/*
Plugin Name: OOP WP Plugin
Plugin URI: https://github.com/oop-wpp
Description: OOP WP Plugin is fully wordpress OOP base
Version: 1.0.0
Author: Anisur
Author URI: https://github.com/anisur2805
Licence: GPLv2 or later
Text Domain: oop-wp
 */

defined('ABSPATH') or die('Hey you can\'n access this file, you silly human!');


if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define( 'OOP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'OOP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'OOP_PLUGIN', plugin_basename( __FILE__ ) );



if( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}