<?php
/**
 * Plugin Name: AR Testimonial Plugin
 * Plugin URI:  https://github.com/anisur2805/ar-plugin-dev
 * Description: Description of the plugin.
 * Version:     1.0.0
 * Author:      Anisur Rahman
 * Author URI:  https://github.com/anisur2805
 * Text Domain: artm
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */ 

defined( 'ABSPATH') || die("Nice Try!" );

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_FILE', __FILE__ );

/*
 * Includes all files
 */
include PLUGIN_PATH.'inc/shortcodes.php';
include PLUGIN_PATH.'inc/metaboxes.php';
include PLUGIN_PATH.'inc/postTypes.php';
include PLUGIN_PATH.'inc/ajax.php';
include PLUGIN_PATH.'inc/db.php';
include PLUGIN_PATH.'inc/blocks.php';
// include PLUGIN_PATH.'trait/AppSetting.php';


if(!class_exists('ArtmTestimonial')):

	class ArtmTestimonial{

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_filter( 'plugin_action_links', array( $this, 'action_plugin'), 10, 5 );
			// add_action('admin_menu', array($this, 'form_process_function_settings'));
			add_action('admin_menu', array($this, 'admin_menu'));
		}

		/*
		 * Enqueue all scripts
		 */
		public function enqueue_scripts() {
			wp_enqueue_script('jquery');
			wp_enqueue_style('artm', PLUGIN_URL .'assets/css/style.css');
			wp_enqueue_script('artm-script', PLUGIN_URL .'assets/js/custom.js', array('jquery'), '1.0.0', true);
			wp_localize_script( 
				'artm-script', 'artm_ajax_script', 
				array(
					'ajaxurl' 	=> admin_url('admin-ajax.php'), 
					'num1'		=> 10,
				)
			);
		}
		public function admin_scripts(){
			wp_enqueue_style( 'admin-style', PLUGIN_URL .'assets/css/admin-style.css' );
			wp_enqueue_script('artm-script', PLUGIN_URL .'assets/js/custom.js', array('jquery'), '1.0.0', true);
		} 

		/*
		 * Register Settings 
		 * Settings Option
		 */
		public function form_process_function_settings(){
			register_setting( 'artm_option_group', 'artm_option_name' );
			if(isset($_POST['action']) && current_user_can('manage_options')) {
				update_option('artm_option_1', sanitize_text_field($_POST['name']));
			}
		}


		/*
		 * Setting link
		 */
		public function action_plugin( $actions, $plugin_file ) {
			static $plugin;

			if ( !isset($plugin ))
				$plugin = plugin_basename( __FILE__ );
			if ( $plugin == $plugin_file ) {
				$settings = array('settings' => '<a href="edit.php?post_type=testimonial&page=artm-settings">' . __('Settings', 'General') . '</a>');
				$actions = array_merge($settings, $actions);
			}

			return $actions;
		}


		public function admin_menu(){
			add_submenu_page( 'edit.php?post_type=testimonial', 'Settings', 'Settings', 'manage_options', 'artm-settings', array( $this, 'submenu_callback') );
		}
		public function submenu_callback() {
			echo '<h3>Hey, Wanna Settings!</h3>';			
		}

	}

	new ArtmTestimonial;
	register_activation_hook( PLUGIN_FILE, function(){
		add_option('artm_option_1');
	});
	register_deactivation_hook( PLUGIN_FILE, function(){
		delete_option('artm_option_1');
	});

endif;