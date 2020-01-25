<?php
/**
 * Plugin Name: Posts To QR Code
 * Plugin URI: #
 * Description: Posts To QR Code
 * Version: 1.0
 * Author: Anisur Rahman
 * Author URI: https://github.com/anisur2805
 * Text Domain: posts-to-qr
 * Domain Path: /languages/
 */

defined( 'ABSPATH' ) or die();

/**
 * Load Text Domain
 */
function pqr_load_textdomain() {
	load_plugin_textdomain( 'posts-to-qr', false, dirname( __FILE__ ) . '/languages' );
}

function qrc_init() {
	global $qrc_countries;
	$qrc_countries = apply_filters( 'qrc_countries', $qrc_countries );
}

add_action( 'init', 'qrc_init' );

/**
 * Make Countries Global
 */
$qrc_countries = array(
	__( 'Afganistan', 'posts-to-qr' ),
	__( 'Bangladesh', 'posts-to-qr' ),
	__( 'Bhutan', 'posts-to-qr' ),
	__( 'India', 'posts-to-qr' ),
	__( 'Muldives', 'posts-to-qr' ),
	__( 'Nepal', 'posts-to-qr' ),
	__( 'Pakistan', 'posts-to-qr' ),
	__( 'Srilanka', 'posts-to-qr' )
);

/**
 *
 */
function pqrc_display_qr_code( $content ) {
	$current_post_id    = get_the_ID();
	$current_post_title = get_the_title( $current_post_id );
	$current_post_url   = urlencode( get_the_permalink( $current_post_id ) );
	$current_post_type  = get_post_type( $current_post_id );

	// check post type
	$exclude_post_types = apply_filters( 'qrc_exclude_post_type', array() );
	if ( in_array( $current_post_type, $exclude_post_types ) ) {
		return $content;
	}

	// pass image alt attribute
	$image_attr = apply_filters( 'qrc_image_attr', 'hello' );

	// Set qrc dimenson
	$height = get_option( 'qrc_height' );
	$width  = get_option( 'qrc_width' );
	$height = $height ? $height : 180;
	$width  = $width ? $width : 180;

	$dimension = apply_filters( 'qrc_dimension', "{$width}x{$height}" );

	$image_src = sprintf( 'https://api.qrserver.com/v1/create-qr-code/?size=%s&ecc=L&qzone=1&data=%s', $dimension, $current_post_url );
	$content   .= sprintf( "<div class='qrc-wrapper'><img %s src='%s' alt=''/></div>", $image_attr, $image_src, $current_post_title );

	return $content;
}

add_filter( 'the_content', 'pqrc_display_qr_code' );

function qrc_setting_init() {
	add_settings_section( 'qrc_section', __( 'Posts to QR COde', 'posts-to-qr' ), 'qrc_section_callback', 'general' );

	add_settings_field( 'qrc_height', __( 'QRC Height', 'posts-to-qr ' ), 'qrc_field_callback', 'general', 'qrc_section', array(
		'qrc_height',
		'label_for' => 'qrc_height'
	) );
	add_settings_field( 'qrc_width', __( 'QRC Width', 'posts-to-qr' ), 'qrc_field_callback', 'general', 'qrc_section', array(
		'qrc_width',
		'label_for' => 'qrc_width'
	) );
	//add_settings_field( 'qrc_extra', __( 'QRC Extra', 'posts-to-qr ' ), 'qrc_field_callback', 'general', 'qrc_section', array('qrc_extra') );
	add_settings_field( 'qrc_select', __( 'Dropdown', 'posts-to-qr' ), 'qrc_select_callback', 'general', 'qrc_section', array( 'label_for' => 'qrc_select' ) );
	add_settings_field( 'qrc_checkbox', __( 'Multiple Checkbox', 'posts-to-qr' ), 'qrc_checkbox_callback', 'general', 'qrc_section', array( 'label_for' => 'qrc_checkbox' ) );
	add_settings_field( 'qrc_toggle', __( 'Minitoggle', 'posts-to-qr' ), 'qrc_toggle_callback', 'general', 'qrc_section' );

	register_setting( 'general', 'qrc_height', array( 'sanitize_callback' => 'esc_attr' ) );
	register_setting( 'general', 'qrc_width', array( 'sanitize_callback' => 'esc_attr' ) );
	register_setting( 'general', 'qrc_select', array( 'sanitize_callback' => 'esc_attr' ) );
	register_setting( 'general', 'qrc_checkbox' );
	register_setting( 'general', 'qrc_toggle' );
	//register_setting( 'general', 'qrc_extra', array( 'sanitize_callback' => 'esc_attr' ) );
}

function qrc_toggle_callback() {
	$option = get_option('qrc_toggle');
	echo '<div id="toggle1"></div>';
	echo '<input type="hidden" value="'.$option.'" name="qrc_toggle" id="qrc_toggle"/>';
}

function qrc_checkbox_callback() {
	global $qrc_countries;
	$option = get_option( 'qrc_checkbox' );
	foreach ( $qrc_countries as $country ) {
		$selected = '';
		if ( is_array( $option ) && in_array( $country, $option ) ) {
			$selected = 'checked';
		}
		printf( '<input type="checkbox" name="qrc_checkbox[]" value="%s" %s /> %s </br>', $country, $selected, $country );
	}
}


function qrc_select_callback() {
	global $qrc_countries;
	$option = get_option( 'qrc_select' );
	printf( '<select id="%s" name="%s">', 'qrc_select', 'qrc_select' );
	foreach ( $qrc_countries as $country ) {
		$selected = '';
		if ( $option == $country ) {
			$selected = 'selected';
		}
		printf( '<option value="%s" %s>%s</option>', $country, $selected, $country );
	}
	echo "</select>";

}

add_action( 'admin_init', 'qrc_setting_init' );

function qrc_section_callback() {
	echo "<p>" . __( 'Settings for QR Code', 'posts-to-qr' ) . "</p>";
}

function qrc_field_callback( $args ) {
	$common_option = get_option( $args[0] );
	printf( "<input type='text' id='%s' name='%s' value='%s' />", $args[0], $args[0], $common_option );
}

function qrc_height_callback() {
	$height = get_option( 'qrc_height' );
	printf( "<input type='text' id='%s' name='%s' value='%s' />", 'qrc_height', 'qrc_height', $height );
}

function qrc_width_callback() {
	$width = get_option( 'qrc_width' );
	printf( '<input type="text" id="%s" name="%s" value="%s" />', "qrc_width", "qrc_width", $width );
}

/**
 * @param $screen
 */
function qrc_admin__enqueue_scripts( $screen ) {
	if ( 'options-general.php' == $screen ) {
		wp_enqueue_script( 'main-js', 'https://code.jquery.com/jquery-1.12.4.min.js' );
		wp_enqueue_script( 'qrc-minitoggle', plugin_dir_url( __FILE__ ) . 'assets/js/minitoggle.js', array( 'jquery' ), time(), true );
		wp_enqueue_script( 'qrc-main', plugin_dir_url( __FILE__ ) . 'assets/js/qrc-main.js', array( 'jquery' ), time(), true );
		wp_enqueue_style( 'minitoggle-css', plugin_dir_url( __FILE__ ) . 'assets/css/minitoggle.css' );
	}
}

add_action( 'admin_enqueue_scripts', 'qrc_admin__enqueue_scripts' );