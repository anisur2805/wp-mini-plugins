<?php // Myplugin - Settings Callback

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Login Section Callback
function myplugin_callback_section_login(){
	echo '<p>These section enable you to customize WP Login screen.</p>';
}

// Admin Area Callback
function myplugin_callback_section_admin(){
	echo '<p>These section enable you to customize WP Admin Area.</p>';
}

function myplugin_callback_field_text( $args ){
	
	$options = get_option('myplugin_option', myplugin_options_default());

	$id = isset( $args['id'] ) ? $args['id']: '';
	$label = isset( $args['label'] ) ? $args['label']: '';

	$value = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ): '';

	echo '<input id="myplugin_option_'. $id .'" name="myplugin_option['.$id.']" type="text" size="40" value="'.$value.'"><br/>';
	echo '<label for="myplugin_option_'.$id.'">'.$label.'</label>';
}

function myplugin_callback_field_radio( $args ){

	$options = get_option('myplugin_option', myplugin_options_default());

	$id = isset( $args['id'] ) ? $args['id']: '';
	$label = isset( $args['label'] ) ? $args['label']: '';

	$selected_option = isset( $options[$id] ) ? sanitize_text_field( $options[$id] ): '';

	$radio_options = array(

		'enable'		=> 'Enable custom styles',
		'disable'		=> 'Disable custom style'
	);

	foreach ($radio_options as $value => $label) {

		$checked = checked( $selected_option === $value, true, false );

		echo '<label><input name="myplugin_option['. $id .']" type="radio" value="'. $value .'"'. $checked .'> ' ;
		echo '<span>'.$label.'</span><label><br/>';

	}
}

function myplugin_callback_field_textarea( $args ){
	
	$options = get_option('myplugin_option', myplugin_options_default());

	$id = isset( $args['id'] ) ? $args['id']: '';
	$label = isset( $args['label'] ) ? $args['label']: '';

	$allowed_tags = wp_kses_allowed_html( 'post' );

	$value = isset( $options[$id] ) ? wp_kses( stripslashes_deep( $options[$id] ), $allowed_tags): '';

	echo '<textarea id="myplugin_option_'. $id .'" name="myplugin_option['. $id .']" rows="5" cols="50">'. $value .'</textarea><br/>';
	echo '<label for="myplugin_option_'. $id .'">'. $label .'</label>' ;
}

function myplugin_callback_field_checkbox( $args ){
	
	$options = get_option('myplugin_option', myplugin_options_default());

	$id = isset( $args['id'] ) ? $args['id']: '';
	$label = isset( $args['label'] ) ? $args['label']: '';

	$checked = isset( $options[$id]) ? checked( $options[$id], 1, false ): '';

	echo '<input id="myplugin_option_'.$id.'" name="myplugin_option['.$id.']" type="checkbox" value="1"'.$checked .'>';
	echo '<label for="myplugin_option_'.$id.'">'. $label .'</label>';
}

function myplugin_callback_field_select( $args ){
	
	$options = get_option('myplugin_option', myplugin_options_default());

	$id = isset( $args['id'] ) ? $args['id']: '';
	$label = isset( $args['label'] ) ? $args['label']: '';

	$selected_option = isset( $options[$id]) ? sanitize_text_field( $options[$id] ): '';

	$selected_option = array(
		'default'		=> 'Default',
		'light'			=> 'Light',
		'blue'			=> 'Blue',
		'coffee'		=> 'Coffee',
		'ectoplasm'		=> 'Ectoplasm',
		'midnight'		=> 'Midnight',
		'ocean'		=> 'Ocean',
		'sunrise'		=> 'Sunrise',

	);

	echo '<select id="myplugin_option_'.$id.'" name="myplugin_option['. $id .']">';

	foreach ($selected_option as $value => $option) {

		$selected = selected( $selected_option === $value, true, false );

		echo '<option value="'.$value.'"'. $selected .'>'. $option .'</option>';
	}

	echo '</select> <label for="myplugin_option_'.$id.'">'.$label.'</label>';

}