<?php
/**
 * Plugin Name: Tax Meta
 * Plugin URI: #
 * Description: Taxonomy Meta
 * Version: 1.0
 * Author: Anisur Rahman
 * Author URI: https://github.com/anisur2805
 * Text Domain: taxm
 * Domain Path: /languages/
 */

/**
 * load plugin text-domain
 */
function taxm_load_textdomain() {
	load_plugin_textdomain( 'taxm', false, dirname( __FILE__ ) . '/languages' );
}

add_action( 'plugin_loaded', 'taxm_load_textdomain' );

/**
 * register taxonomy category meta
 */
function taxm_tax_bootstrap() {
	$args = [
		'type'              => 'string',
		'sanitize_callback' => 'sanitize_text_field',
		'single'            => true,
		'description'       => 'Texonomy category metabox',
		'show_in_rest'      => true
	];
	register_meta( 'term', 'term_extra_info', $args );
}

add_action( 'init', 'taxm_tax_bootstrap' );

/**
 * Add Extra input field for add Category Page
 */
function taxm_category_add_form_fiels() {
	$label = __( 'Extra Info', 'taxm' );
	$desc  = __( 'The is extra info.', 'taxm' );

	$html = <<<ANIS
<div class="form-field form-required term-name-wrap">
	<label for="extra_info">{$label}</label>
	<input name="extra_info" id="extra_info" type="text" value="" size="40" aria-required="true">
	<p>{$desc}</p>
</div>
ANIS;
	echo $html;

}

add_action( 'category_add_form_fields', 'taxm_category_add_form_fiels' );
add_action( 'post_tag_add_form_fields', 'taxm_category_add_form_fiels' );
add_action( 'genra_add_form_fields', 'taxm_category_add_form_fiels' );

/**
 * Add Extra input field for edit Category Page
 */
function taxm_category_edit_form_fiels($term) {
	$extra_info = get_term_meta($term->term_id, 'term_extra_info', true);
	echo $extra_info;
	$label = __( 'Extra Info', 'taxm' );
	$desc  = __( 'The is extra info.', 'taxm' );
	$html  = <<<ANIS
<tr class="form-field form-required term-name-wrap">
			<th scope="row">
			<label for="extra_info">{$label}</label>
</th>
			<td>
			<input name="extra_info" id="extra_info" type="text" value="{$extra_info}" size="40" aria-required="true">
			<p class="description">{$desc}</p></td>
		</tr>
ANIS;
	echo $html;

}

add_action( 'category_edit_form_fields', 'taxm_category_edit_form_fiels' );
add_action( 'post_tag_edit_form_fields', 'taxm_category_edit_form_fiels' );
add_action( 'genra_edit_form_fields', 'taxm_category_edit_form_fiels' );

/**
 * @param $term_id
 * save category meta to db
 */
function taxm_save_category_meta($term_id){
	if(wp_verify_nonce($_POST['_wpnonce_add-tag'], 'add-tag')){
		$extra_info = sanitize_text_field($_POST['extra_info']);
		update_term_meta($term_id, 'term_extra_info', $extra_info);
	}
}
add_action('create_category', 'taxm_save_category_meta');
add_action('create_post_tag', 'taxm_save_category_meta');
add_action('create_genra', 'taxm_save_category_meta');

/**
 * @param $term_id
 * update category meta
 */
function taxm_update_category_meta($term_id){
	if(wp_verify_nonce($_POST['_wpnonce'], "update-tag_{$term_id}")){
		$extra_info = sanitize_text_field($_POST['extra_info']);
		update_term_meta($term_id, 'term_extra_info', $extra_info);
	}
}
add_action('edit_category', 'taxm_update_category_meta');
add_action('edit_post_tag', 'taxm_update_category_meta');
add_action('edit_genra', 'taxm_update_category_meta');