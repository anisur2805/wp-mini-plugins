<?php // Myplugin - Settings Validate

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function myplugin_callback_validate_option( $input ){

	//custom url
	if(isset($input['custom_url'])){
		$input['custom_url'] = esc_url( $input['custom_url'] );
	}

	// custom title
	if(isset($input['custom_title'])){
		$input['custom_title'] = sanitize_text_field( $input['custom_title'] );
	}

	// custom style
	$radio_options = array(

		'enable'		=> 'Enable custom styles',
		'disable'		=> 'Disable custom style'
	);

	if( ! isset( $input['custom_style'] )){
		$input['custom_style'] = null;
	}
	if( ! array_key_exists( $input['custom_style'], $radio_options )){

		$input['custom_style'] = null;
	}

	// custom footer
	if(isset( $input['custom_footer'])){

		$input['custom_footer'] = sanitize_text_field($input['custom_footer']);
	}

	if(!isset($input['custom_toolbar'])){
		$input['custom_toolbar'] = null;
	}

	$input['custom_toolbar'] = ($input['custom_toolbar'] == 1 ? 1 : 0);

	$selected_option = array(
		'default'		=> 'Default',
		'light'			=> 'Light',
		'blue'			=> 'Blue',
		'coffee'		=> 'Coffee',
		'ectoplasm'		=> 'Ectoplasm',
		'midnight'		=> 'Midnight',
		'ocean'			=> 'Ocean',
		'sunrise'		=> 'Sunrise',

	);

	if(!isset($input['custom_scheme'])){
		$input['custom_scheme'] = null;
	}

	if( !array_key_exists( $input['custom_scheme'], $selected_option )){
		$input['custom_scheme'] = null;
	}

	return $input;
}