<?php
/**
 * Plugin Name: AR Dev Plugin
 * Plugin URI:  https://github.com/anisur2805/ar-plugin-dev
 * Description: Description of the plugin.
 * Version:     1.0.0
 * Author:      Anisur Rahman
 * Author URI:  https://github.com/anisur2805
 * Text Domain: ardev
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */ 

defined( 'ABSPATH') || die("You can not access this file directly!" );
define( 'PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'PLUGIN_URL', plugin_dir_url(__FILE__) );
define('PLUGIN_FILE', __FILE__);

/*
 * Includes all files
 */
include PLUGIN_PATH.'inc/shortcodes.php';
include PLUGIN_PATH.'inc/metaboxes.php';
include PLUGIN_PATH.'inc/custom_post_types.php';
include PLUGIN_PATH.'inc/ajax.php';
include PLUGIN_PATH.'inc/db.php';
include PLUGIN_PATH.'inc/blocks.php';


if(!class_exists('ar_plugin_dev')):

	class ar_plugin_dev{

		public function __construct() {
			add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
			add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
			add_action('admin_menu', array($this, 'admin_menu'));
			add_action('admin_menu', array($this, 'form_process_function_settings'));
		}

		/*
		 * Enqueue all scripts
		 */
		public function enqueue_scripts() {
			wp_enqueue_script('jquery');
			wp_enqueue_style('ardev', PLUGIN_URL .'assets/css/style.css');
			wp_enqueue_script('ardev-script', PLUGIN_URL .'assets/js/custom.js', array('jquery'), '1.0.0', true);
			wp_localize_script( 
				'ardev-script', 'ardev_ajax_script', 
				array(
					'ajaxurl' 	=> admin_url('admin-ajax.php'), 
					'num1'		=> 10,
				)
			);
		}
		public function admin_enqueue_scripts(){
			wp_enqueue_script('ardev-script', PLUGIN_URL .'assets/js/custom.js', array('jquery'), '1.0.0', true);
		} 

		/*
		 * Register Settings 
		 * Settings Option
		 */
		public function form_process_function_settings(){
			register_setting( 'ardev_option_group', 'ardev_option_name' );
			if(isset($_POST['action']) && current_user_can('manage_options')) {
				update_option('ardev_option_1', sanitize_text_field($_POST['name']));
			}
		}



		/*
		 * Add menu page
		 */
		public function admin_menu(){
			add_menu_page('Ar Dev', 'Ar Dev', 'manage_options', 'ardev', array($this, 'option_func'), 'dashicons-plugins-checked' );
			add_submenu_page( 'ardev', 'Ar Dev Settings', 'Ar Dev Settings', 'manage_options', 'ardev_settings', array($this, 'settings_func' ));
		}
		public function option_func(){ ?>

			<div class="wrap">
				<h1>Ar Dev Options</h1>
				<?php settings_errors(); ?>
				<form class="ardev_ajax_form" action="options.php" method="post">
					<?php settings_fields('ardev_option_group') ?>
					<label for="name">Name: <input id="name" type="text" name="name" value="<?php echo esc_html(get_option('ardev_option_1')); ?>"> </label>
					<?php submit_button('Save changes'); ?>
				</form>

				<?php include PLUGIN_PATH.'inc/api.php'; ?>

			</div>
			<?php
		}

		public function settings_func(){
			return true;
		}

	}


	/*
	 * Create class object
	 */
	new ar_plugin_dev;

	register_activation_hook( PLUGIN_FILE, function(){
		add_option('ardev_option_1');
	});
	register_deactivation_hook( PLUGIN_FILE, function(){
		delete_option('ardev_option_1');
	});

endif;