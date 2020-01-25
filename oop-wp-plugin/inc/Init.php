<?php

/**
 * @package oopwpplugin
 */

namespace Inc;

defined('ABSPATH') or die('Hey you can\'n access this file, you silly human!');

final class Init {

	/**
	 * Store all the classes inside an array
	 * @return array full list of class
	 */
	public static function get_services() {
		return [
			Pages\Admin::class,
			Base\Enqueue::class,
			Base\SettingsLinks::class
		];
	}

	/**
	 * Loop through the class, Initialize theme,
	 * and call the register method if exits 
	 * @return
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instantiate( $class );
			if( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class
	 * @param class $class class from the services array
	 * @return class instance new instance of the class
	 */
	private static function instantiate ( $class ) {
		$service = new $class();
		return $service;
	}
}



// use Inc\Activate;
// use Inc\Deactivate;

// if( !class_exists( 'OopWpPlugin' ) ) {

// 	class OopWpPlugin {

// 		public $plugin;

// 		function __construct() {
// 			$this->plugin = plugin_basename(__file__);
// 		}

// 		function register() {
// 			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

// 			add_action( 'admin_menu', array( $this, 'admin_menu_page') );

// 			add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
// 		}

// 		public function settings_link( $links ) {
// 			$settings_link = '<a href="admin.php?page=oop-wpp">Settings</a>';
// 			array_push( $links, $settings_link );
// 			return $links;
// 		}

// 		public function add_admin_page() {
// 			add_menu_page( 'OOP WP Plugin', 'OOP WP Plugin', 'manage_options', 'oop-wpp', array( $this, 'admin_menu_render' ), 'dashicons-store', 110 );
// 		}

// 		function admin_menu_render() {
// 			require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
// 		}

// 		protected function create_post_type() {
// 			add_action( 'init', array( $this, 'custom_post_type' ) );
// 		}

// 		function custom_post_type() {
// 			register_post_type( 'book', ['public' => true, 'label' => 'Books' ] );
// 		}

// 		function enqueue() {
// 			wp_enqueue_style( 'mystyle', plugins_url( '/assets/mystyle.css', __FILE__ ) );
// 			wp_enqueue_script( 'myscript', plugins_url( '/assets/myscript.js', __FILE__ ) );
// 		}

// 		function Activate() {
// 			Activate::Activate();
// 		}
// 	}


// 	$oopWpPlugin = new OopWpPlugin();
// 	$oopWpPlugin->register();


// 	register_activation_hook( __FILE__, array( $oopWpPlugin, 'activate' ) );
// 	register_deactivation_hook( __FILE__, array( 'Deactivate', 'deactivate' ) );

// }