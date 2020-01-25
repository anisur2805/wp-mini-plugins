<?php
defined('ABSPATH') || die('Nice Try!');
/*
 * Custom Metaboxes
 */
include PLUGIN_PATH.'trait/AppSetting.php';

abstract class add_Meta_Box {
	public static function add() {
		$screens = [AppSetting::appType()];
		foreach ($screens as $screen) {
			add_meta_box(
                'artm_amb', // Unique ID
                __('Testimonies Information'), // Box title
                [self::class, 'html'], // Content callback, must be of type callable
                $screen // Post type
            );
		}
	}


	public static function update_post_meta_my($post_id,$filed_name,$post){
		$index = str_replace('_','',$filed_name);
		update_post_meta($post_id,$filed_name,$post[$index]);
	}

	public static function save( $post_id ) {
		/*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */
 
        // Check if our nonce is set.
        if( !isset($_POST['artm_custom_field_nonce']) ) {
        	return $post_id; 
        }
        $artm_nonce = $_POST['artm_custom_field_nonce'];

        // Verify that the nonce is valid.
        if( ! wp_verify_nonce( $artm_nonce, 'artm_custom_filed') ) {
        	return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) {
        	return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST['testimonial'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        /* OK, it's safe for us to save the data now. */
 
        // Sanitize the user input.
        $mydata = sanitize_text_field( $_POST['tmPosition'] );

		if (array_key_exists('post_ID', $_POST)) {
			self::update_post_meta_my($post_id,'_tmPosition',$_POST);
			self::update_post_meta_my($post_id,'_tmAuthor',$_POST);
			self::update_post_meta_my($post_id,'_tmRating',$_POST);
			self::update_post_meta_my($post_id,'_tmEmail',$_POST);
			self::update_post_meta_my($post_id,'_tmWebsite',$_POST);
			self::update_post_meta_my($post_id,'_tmWebUrl',$_POST);
		}

	}

	public static function html($post) { ?>
		
		<div class="testimonial-info">
			<div class="row">
				<div class="oneHalf first">
					<?php 
					// Add an nonce field so we can check for it later.
        			wp_nonce_field( 'artm_custom_filed', 'artm_custom_field_nonce' );
        			
					$tmPosition = get_post_meta($post->ID, '_tmPosition', true); ?>
					<label for="tmPosition"><?php echo esc_html( 'Testimonies Position', 'artm' ); ?></label>
					<input type="text" name="tmPosition" id="tmPosition" value="<?php echo $tmPosition; ?>" class="wide fat" placeholder="Ex. CEO">
				</div>

				<div class="oneHalf last">
					<?php $tmAuthor = get_post_meta($post->ID, '_tmAuthor', true); ?>
					<label for="tmAuthor"><?php echo esc_html( 'Testimonies Name', 'artm' ); ?></label>
					<input type="text" name="tmAuthor" id="tmAuthor" value="<?php echo $tmAuthor; ?>" class="wide fat" placeholder="Ex. John Doe">
				</div>
			</div>

			<div class="row">
				<div class="oneHalf">
					<?php $tmEmail = get_post_meta($post->ID, '_tmEmail', true); ?>
					<label for="tmEmail"><?php echo esc_html( 'Testimonies Email', 'artm' ); ?></label>
					<input type="text" name="tmEmail" id="tmEmail" value="<?php echo $tmEmail; ?>" class="wide fat" placeholder="Ex. example@email.com">
				</div>

				<div class="oneHalf">
					<?php $tmRating = get_post_meta($post->ID, '_tmRating', true); ?>
					<label for="tmRating">Testimonies Rating</label>
					<select name="tmRating" id="tmRating" class="postbox">
						<option value="">Select Rating</option>
						<option value="one" <?php selected($tmRating, 'one'); ?>>1 Star</option>
						<option value="two" <?php selected($tmRating, 'two'); ?>>2 Star</option>
						<option value="three" <?php selected($tmRating, 'three'); ?>>3 Star</option>
						<option value="four" <?php selected($tmRating, 'four'); ?>>4 Star</option>
						<option value="five" <?php selected($tmRating, 'five'); ?>>5 Star</option>
					</select>		
				</div>
			</div>

			<div class="row">
				<div class="oneHalf">
					<?php $tmWebsite = get_post_meta($post->ID, '_tmWebsite', true); ?>
					<label for="tmWebsite"><?php echo esc_html( 'Testimonies Website', 'artm' ); ?></label>
					<input type="text" name="tmWebsite" id="tmWebsite" value="<?php echo $tmWebsite; ?>" class="wide fat" placeholder="Ex. Google">
				</div>

				<div class="oneHalf">
					<?php $tmWebUrl = get_post_meta($post->ID, '_tmWebUrl', true); ?>
					<label for="tmWebUrl"><?php echo esc_html( 'Testimonies Website Url', 'artm' ); ?></label>
					<input type="text" name="tmWebUrl" id="tmWebUrl" value="<?php echo esc_url($tmWebUrl); ?>" class="wide fat" placeholder="Ex. https:://google.com/">
				</div>
			</div>			
		</div>
		<?php
	}
}
/**
 * Hook into the appropriate actions when the class is constructed.
 */
add_action('add_meta_boxes', ['add_Meta_Box', 'add']);
add_action('save_post', ['add_Meta_Box', 'save']);
