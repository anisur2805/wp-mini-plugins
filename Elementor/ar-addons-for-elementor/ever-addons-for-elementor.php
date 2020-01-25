<?php
/**
 * Plugin Name: AR Addons For Elementor
 * Plugin URI:  #
 * Description: The best Elementor addon!
 * Version:     1.0.0
 * Author:      Anisur Rahman
 * Author URI:  https://github.com/anisur2805
 * License:     GPLv2+
 * Text Domain: ar-addons-for-elementor
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2018 PluginEver (email : anisur2805@gmail.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// don't call the file directly
if (!defined('ABSPATH')) {
    exit;
}

final class AR_Addons_for_Elementor {
    /**
     * Add-on Version
     *
     * @since 1.0.0
     * @var  string
     */
    public $version = '1.0.0';

    /**
     * The single instance of the class.
     *
     * @since 1.0.0
     * @var AR_Addons_for_Elementor
     */
    protected static $instance = null;

    /**
     * @since 1.0.0
     *
     * @var string
     */
    public $plugin_name = 'AR Addons For Elementor';

    /**
     * AR_Addons_for_Elementor constructor.
     */
    public function __construct() {
        register_activation_hook(__FILE__, array($this, 'auto_deactivate'));
        $this->define_constants();

        if ($this->is_elementor_installed()) {
            $this->includes();
            $this->init_hooks();
        }
    }

    /**
     * @since 1.0.0
     */
    public function auto_deactivate() {
        if ($this->is_elementor_installed()) {
            return;
        }

        deactivate_plugins(plugin_basename(__FILE__));

        //todo need to change the lines
        $error = __('<h1>Missing Required Plugin</h1>', 'ar-addons-for-elementor');
        $error .= __('<p>The <strong>Ultimate Elementor Addons</strong> plugin requires Elementor <strong>', 'ar-addons-for-elementor') . $this->min_php . __('</strong> or greater', 'ar-addons-for-elementor');
        $error .= __('<p>The version of your PHP is ', 'ar-addons-for-elementor') . '<a href="http://php.net/supported-versions.php" target="_blank"><strong>' . __('unsupported and old', 'ar-addons-for-elementor') . '</strong></a>.';
        $error .= __('You should update your PHP software or contact your host regarding this matter.</p>', 'ar-addons-for-elementor');

        wp_die($error, __('Plugin Activation Error', 'ar-addons-for-elementor'), array('back_link' => true));
    }

    /**
     * Checks if elementor installed or not
     *
     * @return bool
     * @since 1.0.0
     */
    public function is_elementor_installed() {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');

        $file_path = 'elementor/elementor.php';
        $installed_plugins = get_plugins();

        return isset($installed_plugins[$file_path]);
    }

    /**
     * Define constants
     *
     * @return void
     * @since 1.0.0
     *
     */
    private function define_constants() {
        define('AR_ADDONS_VERSION', $this->version);
        define('AR_ADDONS_FILE', __FILE__);
        define('AR_ADDONS_PATH', dirname(AR_ADDONS_FILE));
        define('AR_ADDONS_INCLUDES', AR_ADDONS_PATH . '/includes');
        define('AR_ADDONS_URL', plugins_url('', AR_ADDONS_FILE));
        define('AR_ADDONS_ASSETS', AR_ADDONS_URL . '/assets');
        define('AR_ADDONS_VIEWS', AR_ADDONS_PATH . '/views');
        define('AR_ADDONS_TEMPLATES_DIR', AR_ADDONS_PATH . '/templates');
    }

    /**
     * Include required files
     *
     * @return void
     * @since 1.0.0
     *
     */
    private function includes() {
        require dirname(__FILE__) . '/vendor/autoload.php';
        //require PLVR_UEA_INCLUDES .'/functions.php';
    }

    /**
     * Init Hooks
     *
     * @return void
     * @since 1.0.0
     *
     */
    private function init_hooks() {
        // Localize our plugin
        add_action('init', [$this, 'localization_setup']);

        //add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );

        add_action('elementor/init', [$this, 'add_category']);

        add_action('elementor/widgets/widgets_registered', array($this, 'init_widgets'), 10);
        add_action('elementor/frontend/after_register_scripts', array($this, 'register_frontend_scripts'), 10);
        add_action('elementor/frontend/after_register_styles', array($this, 'register_frontend_styles'), 10);
        add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_frontend_styles'), 10);
    }

    /**
     * Initialize plugin for localization
     *
     * @return void
     * @since 1.0.0
     *
     */
    public function localization_setup() {
        load_plugin_textdomain('ar-addons-for-elementor', false, dirname(plugin_basename(__FILE__)) . '/languages/i18n/');
    }

    /**
     * Adds the category on the editor
     * @since 1.0.0
     */
    public function add_category() {
        Elementor\Plugin::$instance->elements_manager->add_category('ar-addons', ['title' => __('AR Addons', 'ar-addons-for-elementor'), 'icon' => 'fa fa-plug', //default icon
            ]);
    }

    public function init_widgets() {
        $widgets = ['Pluginever\EverAddons\Widgets\InfoBox', 'Pluginever\EverAddons\Widgets\Testimonial', 'Pluginever\EverAddons\Widgets\TeamMember',];


        error_log('initiated');
        foreach ($widgets as $element) {
            Elementor\Plugin::instance()->widgets_manager->register_widget_type(new $element);
        }
    }

    /**
     * Register frontend scripts
     *
     * @since 1.0.0
     */
    public function register_frontend_scripts() {

    }

    /**
     * Register frontend styles
     *
     * @since 1.0.0
     */
    public function register_frontend_styles() {
        wp_register_style('ar-addons', AR_ADDONS_ASSETS . '/css/ar-addons.css', array(), $this->version);
        wp_register_style('ea-infobox', AR_ADDONS_ASSETS . '/css/infobox.css', array('ar-addons'), $this->version);
    }

    /**
     * enqueue global styles
     *
     * @since 1.0.0
     */
    public function enqueue_frontend_styles() {

    }


    /**
     * Initializes the class
     *
     * Checks for an existing instance
     * and if it does't find one, creates it.
     *
     * @return object Class instance
     * @since 1.0.0
     *
     */
    public static function init() {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

function AR_Addons_for_Elementor() {
    return AR_Addons_for_Elementor::init();
}

//fire
AR_Addons_for_Elementor();
