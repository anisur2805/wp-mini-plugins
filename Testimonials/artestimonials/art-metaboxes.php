<?php
/* Add Custom Meta box */
function art_metabox_init() {
	add_meta_box(
		'artcDetails',
		'Client Information',
		'artcDetails_callback',
		'art',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'art_metabox_init' );

function artcDetails_callback( $post ){
	wp_nonce_field('art_save_metabox', 'art_metabox_nonce'); ?>

	<div class="clientInfo row">
		<div class="left_half half col-md-6">
			<?php $artc_designation = (get_post_meta( $post->ID, '_artc_designation', true) ) ? get_post_meta( $post->ID, '_artc_designation', true): ''; ?>
			<label for="artc_designation"><?php echo __('Client Postion'); ?></label>
			<input type="text" name="_artc_designation" id="artc_designation" class="widefat" value="<?php echo $artc_designation; ?>" />
			
		</div>

		<div class="right_half half">
			<?php $artc_company = (get_post_meta( $post->ID, '_artc_company', true) ) ? get_post_meta( $post->ID, '_artc_company', true): ''; ?>
			<label for="artc_company"><?php echo __('Client Company') ?></label>
			<input type="text" name="_artc_company" id="artc_company" class="widefat" value="<?php echo $artc_company; ?>" />
		</div>

		<div class="left_half half">
			<?php $artc_email = (get_post_meta( $post->ID, '_artc_email', true) ) ? get_post_meta( $post->ID, '_artc_email', true): ''; ?>
			<label for="artc_email"><?php echo __('Client Email') ?></label>
			<input type="text" name="_artc_email" id="artc_email" class="widefat" value="<?php echo $artc_email; ?>" />
		</div>

		<div class="left_half half">
			<?php $artc_website = (get_post_meta( $post->ID, '_artc_website', true) ) ? get_post_meta( $post->ID, '_artc_website', true): ''; ?>
			<label for="artc_website"><?php echo __('Client Website') ?></label>
			<input type="text" name="_artc_website" id="artc_website" class="widefat" value="<?php echo $artc_website; ?>" />
		</div>
		<div class="right_half half">
			<?php $artc_ratting = (get_post_meta( $post->ID, '_artc_ratting', true) ) ? get_post_meta( $post->ID, '_artc_ratting', true): ''; ?>
			<label for="artc_ratting"><?php echo __('Client Rating') ?></label>	 
			<select name="_artc_ratting"> 
				<option value="1" <?php selected( $artc_ratting, 1 ); ?>>1</option>
				<option value="2" <?php selected( $artc_ratting, 2 ); ?>>2</option>
				<option value="3" <?php selected( $artc_ratting, 3 ); ?>>3</option>
				<option value="4" <?php selected( $artc_ratting, 4 ); ?>>4</option>
				<option value="5" <?php selected( $artc_ratting, 5 ); ?>>5</option>
			</select>
		</div>

	</div>

	<?php
} 

function art_metabox_init_update( $post_ID ){

	if( !isset($_POST['art_metabox_nonce']) ){ return; }
	if( ! wp_verify_nonce(  $_POST['art_metabox_nonce'], 'art_save_metabox' )){ return;	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

	if(isset( $_POST['post_type']) && 'page' == $_POST['post_type']){
		if( ! current_user_can( 'edit_page', $post_id )){ return; }
	}else{
		if( ! current_user_can( 'edit_post', $post_id )){ return; }
	}

	$artc_designation = sanitize_text_field( $_POST['_artc_designation'] );
	update_post_meta( $post_ID, '_artc_designation', $artc_designation );

	$artc_company = sanitize_text_field( $_POST['_artc_company'] );
	update_post_meta( $post_ID, '_artc_company', $artc_company );

	$artc_ratting = sanitize_text_field( $_POST['_artc_ratting'] );
	update_post_meta( $post_ID, '_artc_ratting', $artc_ratting );

	$artc_email = sanitize_text_field( $_POST['_artc_email'] );
	update_post_meta( $post_ID, '_artc_email', $artc_email );

	$artc_website = sanitize_text_field( $_POST['_artc_website'] );
	update_post_meta( $post_ID, '_artc_website', $artc_website );
}
add_action('save_post', 'art_metabox_init_update');


function get_custom_field( $field_name ){
	return get_post_meta( get_the_ID(), $field_name, true );
}