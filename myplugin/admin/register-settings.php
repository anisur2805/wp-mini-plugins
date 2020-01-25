<?php // Myplugin - Register Settings 

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function myplugin_register_settings(){
	register_setting( 
		'myplugin_section_id',
		'myplugin_option',
		'myplugin_callback_validate_option' 
	);

	add_settings_section(
		'myplugin_section_login', 
		'Customize Login Page', 
		'myplugin_callback_section_login', 
		'myplugin' 
	);

	add_settings_section( 
		'myplugin_section_admin', 
		'Customize Admin Area', 
		'myplugin_callback_section_admin', 
		'myplugin' 
	);

	add_settings_field( 
		'custom_url', 
		'Custom Url', 
		'myplugin_callback_field_text', 
		'myplugin', 
		'myplugin_section_login',
		['id' => 'custom_url', 'label' => 'Custom URL for the login page']
	);

	add_settings_field( 
		'custom_title', 
		'Custom Title', 
		'myplugin_callback_field_text', 
		'myplugin', 
		'myplugin_section_login',
		['id' => 'custom_title', 'label' => 'Custom Title attribute']
	);

	add_settings_field( 
		'custom_style', 
		'Custom Style', 
		'myplugin_callback_field_radio', 
		'myplugin', 
		'myplugin_section_login',
		['id' => 'custom_style', 'label' => 'Custom CSS for login Screen']
	);

	add_settings_field( 
		'custom_message', 
		'Custom Message', 
		'myplugin_callback_field_textarea', 
		'myplugin', 
		'myplugin_section_login',
		['id' => 'custom_message', 'label' => 'Custom text or markup']
	);

	add_settings_field( 
		'custom_footer', 
		'Custom Footer', 
		'myplugin_callback_field_text', 
		'myplugin', 
		'myplugin_section_admin',
		['id' => 'custom_footer', 'label' => 'Custom fiiter text']
	);

	add_settings_field( 
		'custom_toolbar', 
		'Custom Toolbar', 
		'myplugin_callback_field_checkbox', 
		'myplugin', 
		'myplugin_section_admin',
		['id' => 'custom_toolbar', 'label' => 'Remove new post and comment links from the toolbar']
	);

	add_settings_field( 
		'custom_scheme', 
		'Custom Scheme', 
		'myplugin_callback_field_select', 
		'myplugin', 
		'myplugin_section_admin',
		['id' => 'custom_scheme', 'label' => 'Default color scheme for new users']
	);



}
add_action('admin_init', 'myplugin_register_settings');