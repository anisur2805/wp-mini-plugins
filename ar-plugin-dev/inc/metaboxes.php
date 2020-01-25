<?php
defined('ABSPATH') || die('Nice Try!');
/*
 * Custom Metaboxes
 */

add_action( 'admin_init', function() {
	add_meta_box( '_ardev_custommb', 'Custom MetaBox', 'ardev_custom_metabox', ['post'] );	// ['post', 'page']
});
function ardev_custom_metabox($post){
	$_mymetabox = get_post_meta($post->ID, '_mymetabox', true) ? get_post_meta($post->ID, '_mymetabox', true) : '';
	$_myselectbox = get_post_meta($post->ID, '_myselectbox', true) ? get_post_meta($post->ID, '_myselectbox', true) : '';?>
	
	<label for="_mymetabox">Enter Name:<input type="text" name="_mymetabox" value="<?php echo $_mymetabox; ?>"> </label><br>
	<label for="_mymetabox">Fav Option: <select name="_selectbox" id="">
		<option value="0" selected>Choose Option</option>
		<option value="1" <?php echo $_myselectbox == 1 ? 'selected' : ''; ?>>One</option>
		<option value="2" <?php echo $_myselectbox == 2 ? 'selected' : ''; ?>>Two</option>
		<option value="3" <?php echo $_myselectbox == 3 ? 'selected' : ''; ?>>Three</option>
	</select></label>

	<?php 
}

add_action('save_post', 'ardev_save_post');
function ardev_save_post($post_id){
	if(array_key_exists('_mymetabox', $_POST) && array_key_exists('_selectbox', $_POST)) {
		update_post_meta($post_id, '_mymetabox', $_POST['_mymetabox']);
		update_post_meta($post_id, '_myselectbox', $_POST['_selectbox']);
	}
}