<?php
class arBlocks{
	public function __construct(){
		add_action('init', array($this, 'ar_custom_block_01'));
	}
	public function ar_custom_block_01(){
		wp_register_script( 'ar-block-script', PLUGIN_URL."/assets/js/blocks.js", array('wp-blocks', 'wp-element', 'wp-editor') );

		/*
		 *register front-end & back-end css file
		 */
		wp_register_style('ardev-admin-style', PLUGIN_URL.'assets/css/editor.css');
		wp_register_style('ardev-front-style', PLUGIN_URL.'assets/css/blocks.css');

		$name = "ar-plugin-dev/ar-block01";
		$args = array(
			'style'			=> 'ardev-front-style',		// css for front end 
			'editor_style'	=> 'ardev-admin-style',		// css for admin/ backend
			'editor_script'	=> 'ar-block-script'
		);

		register_block_type($name, $args);
	}
} new arBlocks;