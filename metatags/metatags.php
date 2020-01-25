<?php
	/**
	 * Plugin Name: MetaTags
	 * Plugin URI: https://vanaf1979.nl/
	 * Description: Gutenberg search engine metatag sidebar plugin.
	 * Version: 1.0
	 * Author: Vanaf1979
	 * Author URI: https://vanaf1979.nl/
	 * Text Domain: metatags
	 * Domain Path: languages
	 */

	namespace MetaTags;

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	class MetaTags {

		private static $instance;

		private static $pluginslug = 'metatags';

		/**
		 * WordPress post meta fields
		 * @var array $metafields
		 */
		private $metafields = [
			'title'       => 'metatags_brower_title',
			'description' => 'metatags_description_field',
			'robots'      => 'metatags_robots_field'
		];

		/**
		 * @var array $dependencies
		 */
		private $dependencies = [
			'wp-plugins',
			'wp-edit-post',
			'wp-element',
			'wp-components',
			'wp-data',
			'wp-dom-ready'
		];

		/**
		 * MetaTags constructor.
		 */
		public function __construct() {
		}

		/**
		 * @return MetaTags
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && !( self::$instance instanceof MetaTags ) ) {
				self::$instance = new Self();
			}

			return self::$instance;
		}

		/**
		 * Register hook with WP
		 * @return
		 * @uses add_action()
		 * @access public
		 */
		public function register() {
			add_action(
				'enqueue_block_editor_assets',
				[ $this, 'enqueue_styles' ],
				999
			);

			add_action(
				'enqueue_block_editor_assets',
				[ $this, 'enqueue_scripts' ],
				999
			);

			add_action(
				'init',
				[ $this, 'register_meta_fields' ],
				1
			);
		}

		public function enqueue_styles() {
			wp_enqueue_style(
				self::$pluginslug . '-styles',
//				'metatags-styles',
				plugin_dir_url( __FILE__ ) . 'dist/css/metatags.css',
				[],
				time(),
				'all'
			);
		}

		public function enqueue_scripts() {
			wp_enqueue_script(
				self::$pluginslug . '-scripts',
//				'metatags-scripts',
				plugin_dir_url( __FILE__ ) . 'dist/js/metatags.js',
				$this->dependencies,
				time(),
				'all'
			);
		}

		public function register_meta_fields() {
			$args = [
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string'
			];

			foreach ($this->metafields as $key => $value){
				register_meta('post', $value, $args);
			}
		}
	}

	function runMetaTagse() {
		MetaTags::instance()->register();
	}
	runMetaTagse();