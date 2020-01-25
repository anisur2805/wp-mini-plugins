<?php
/*
Plugin Name: Our Metabox
Plugin URI: https://github.com/anisur2805/our-metabox
Description: Metabox API
Version: 0.1.0
Author: Anisur Rahman
Author URI: https://github.com/anisur2805
Text Domain: our-metabox
Domain Path: /languages
*/

class OurMetaBox
{
    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'omb_load_textdomain'));
        add_action('admin_menu', array($this, 'omb_add_metabox'));
        add_action('save_post', array($this, 'omb_save_metabox'));
        add_action('save_post', array($this, 'omb_save_image'));
        add_action('save_post', array($this, 'omb_save_gallery'));

        add_action('admin_enqueue_scripts', [$this, 'omb_admin_scripts']);

        add_filter('user_contactmethods', array($this, 'omb_user_contact_methods'));
    }

    /**
     * get author post meta
     * get user socials profile
     */
    public function omb_user_contact_methods($methods)
    {
        $methods['facebook'] = __('Facebook', 'our-metabox');
        $methods['linkedin'] = __('Linked In', 'our-metabox');
        $methods['twitter'] = __('Twitter', 'our-metabox');

        return $methods;
    }


    function omb_admin_scripts()
    {
        wp_enqueue_style('admin-style', plugin_dir_url(__FILE__) . 'assets/admin/css/admin.css', null, time());
        wp_enqueue_script('admin-main', plugin_dir_url(__FILE__) . 'assets/admin/js/admin-main.js', 'jquery', time(), true);

        $obj_name = array(
            "ajaxurl" => admin_url("admin-ajax.php")
        );

        wp_localize_script('admin-main', 'omb_obj', $obj_name);
    }

    function omb_save_image($post_id)
    {
        if (!$this->is_secure('omb_image_nonce', 'omb_image', $post_id)) {
            return $post_id;
        }

        $image_id = isset($_POST['upload_image_id']) ? $_POST['upload_image_id'] : '';
        $image_url = isset($_POST['upload_image_url']) ? $_POST['upload_image_url'] : '';

        update_post_meta($post_id, 'upload_image_id', $image_id);
        update_post_meta($post_id, 'upload_image_url', $image_url);
    }

    function omb_save_gallery($post_id)
    {
        if (!$this->is_secure('omb_gallery_nonce', 'omb_gallery', $post_id)) {
            return $post_id;
        }

        $image_id = isset($_POST['upload_images_id']) ? $_POST['upload_images_id'] : '';
        $image_url = isset($_POST['upload_images_url']) ? $_POST['upload_images_url'] : '';

        update_post_meta($post_id, 'upload_images_id', $image_id);
        update_post_meta($post_id, 'upload_images_url', $image_url);
    }

    /**
     * @param $post_id
     *
     * @return mixed
     */
    function omb_save_metabox($post_id)
    {
        if (!$this->is_secure('omb_location_field', 'omb_location', $post_id)) {
            return $post_id;
        }

        $location = isset($_POST['omb_location']) ? $_POST['omb_location'] : '';
        $country = isset($_POST['omb_country']) ? $_POST['omb_country'] : '';
        $is_favorate = isset($_POST['omb_is_favorate']) ? $_POST['omb_is_favorate'] : 0;
        $colors = isset($_POST['omb_clr']) ? $_POST['omb_clr'] : array();
        $colors2 = isset($_POST['omb_color']) ? $_POST['omb_color'] : '';
        $desc = !empty($_POST['omb_desc']) ? $_POST['omb_desc'] : "";
        $fav_color = isset($_POST['omb_fav_color']) ? $_POST['omb_fav_color'] : '';

//		if ( $location == '' || $country == '' ) {
//			return $post_id;
//		}

        $location = sanitize_text_field($location);
        $country = sanitize_text_field($country);
        $desc = sanitize_text_field($desc);

        update_post_meta($post_id, 'omb_location', $location);
        update_post_meta($post_id, 'omb_country', $country);
        update_post_meta($post_id, 'omb_is_favorate', $is_favorate);
        update_post_meta($post_id, 'omb_clr', $colors);
        update_post_meta($post_id, 'omb_color', $colors2);
        update_post_meta($post_id, 'omb_desc', $desc);
        update_post_meta($post_id, 'omb_fav_color', $fav_color);
    }

    private function is_secure($nonce_field, $active, $post_id)
    {
        $nonce = isset($_POST[$nonce_field]) ? $_POST[$nonce_field] : '';

        if ($nonce == '') {
            return false;
        }
        if (!wp_verify_nonce($nonce, $active)) {
            return false;
        }
        if (!current_user_can('edit_post', $post_id)) {
            return false;
        }
        if (wp_is_post_autosave($post_id)) {
            return false;
        }
        if (wp_is_post_revision($post_id)) {
            return false;
        }

        return true;

    }

    function omb_add_metabox()
    {
        add_meta_box('omb_post_location', __('Location Info', 'our-metabox'), array(
            $this,
            'omb_display_metabox'
        ), 'post');

        add_meta_box('omb_image', __('Image Info', 'our-metabox'), array(
            $this,
            'omb_image_metabox'
        ), 'post');

        add_meta_box('omb_gallery', __('Gallery Info', 'our-metabox'), array(
            $this,
            'omb_gallery_metabox'
        ), 'post');
    }

    function omb_image_metabox($post)
    {
        wp_nonce_field('omb_image', 'omb_image_nonce');
        $image_id = esc_attr(get_post_meta($post->ID, 'upload_image_id', true));
        $image_url = esc_attr(get_post_meta($post->ID, 'upload_image_url', true));

        $metabox_html = <<<ANIS
<div class="files">
	<div class="fields_c">
		<label>Image</label>
	</div>
	<div class="input_c">
		<button id="upload_image" class="button">Upload Image</button>
		<input type="hidden" name="upload_image_id" id="upload_image_id" value="{$image_id}">
		<input type="hidden" name="upload_image_url" id="upload_image_url" value="{$image_url}">
		<div id="upload_image_container"></div>
	</div>
	<div class="float_c"></div>
</div>
ANIS;

        echo $metabox_html;
    }


    public function omb_gallery_metabox($post)
    {
        wp_nonce_field('omb_gallery', 'omb_gallery_nonce');
        $image_id = esc_attr(get_post_meta($post->ID, 'upload_images_id', true));
        $image_url = esc_attr(get_post_meta($post->ID, 'upload_images_url', true));

        $label = __('Gallery', 'our-metabox');
        $button_label = __('Upload Images', 'our-metabox');
        $metabox_html = <<<ANIS
<div class="files">
	<div class="fields_c">
		<label>{$label}</label>
	</div>
	<div class="input_c">
		<button id="upload_gallery" class="button">{$button_label}</button>
		<input type="hidden" name="upload_images_id" id="upload_images_id" value="{$image_id}">
		<input type="hidden" name="upload_images_url" id="upload_images_url" value="{$image_url}">
		<div id="upload_images_container"></div>
	</div>
	<div class="float_c"></div>
</div>
ANIS;

        echo $metabox_html;
    }

    public function omb_display_metabox($post)
    {
        $location = get_post_meta($post->ID, 'omb_location', true);

        $country = get_post_meta($post->ID, 'omb_country', true);

        $is_favorate = get_post_meta($post->ID, 'omb_is_favorate', true);
        $checked = $is_favorate == 1 ? 'checked' : '';

        $saved_color = get_post_meta($post->ID, 'omb_clr', true);
        $colors = array('red', 'green', 'blue', 'yellow', 'black');
        $saved_color2 = get_post_meta($post->ID, 'omb_color', true);
        $desc = get_post_meta($post->ID, 'omb_desc', true);
        $fav_color = get_post_meta($post->ID, 'omb_fav_color', true);

        $label1 = __('Location', 'our-metabox');
        $label2 = __('Country', 'our-metabox');
        $label3 = __('Is Favorate', 'our-metabox');
        $label4 = __('Colors', 'our-metabox');
        $label5 = __('Description', 'our-metabox');

        wp_nonce_field('omb_location', 'omb_location_field');
        $metabox_html = <<<EOD
<p>
<label for="omb_location">{$label1}: </label>
<input type="text" name="omb_location" id="omb_location" value="{$location}">
<br>
<label for="omb_country">{$label2}: </label>
<input type="text" name="omb_country" id="omb_country" value="{$country}">
</p>
<p>
<label for="omb_is_favorate">{$label3}: </label>
<input type="checkbox" name="omb_is_favorate" id="omb_is_favorate" value="1" {$checked}>
</p>
<p>
<label>{$label4}: </label>

EOD;

        $saved_color = is_array($saved_color) ? $saved_color : array();
        foreach ($colors as $color) {
            $_color = ucwords($color);
            $checked = in_array($color, $saved_color) ? "checked='checked'" : '';
            $metabox_html .= <<<ANIS
<label for="omb_clr_{$color}">{$_color}</label>
<input type="checkbox" name="omb_clr[]" id="omb_clr_{$color}" value="{$color}" {$checked}>
ANIS;
        }
        $metabox_html .= '</p>';


        $metabox_html .= <<<ANIS
<p>
<label>{$label4}: </label>
ANIS;
        foreach ($colors as $color) {
            $_color = ucwords($color);
            $checked = ($color == $saved_color2) ? "checked='checked'" : '';
            $metabox_html .= <<<ANIS
<label for="omb_color_{$color}">{$_color}</label>
<input type="radio" name="omb_color" id="omb_color_{$color}" value="{$color}" {$checked} />
ANIS;
        }

        $metabox_html .= "</p>";

        $metabox_html .= <<<ANIS
<p><label for="omb_desc">{$label5}: </label></p>
<textarea name="omb_desc" id="omb_desc" rows="5" placeholder="Write Description" style="width: 100%">{$desc}</textarea>

ANIS;

        $dropdown_html = "<option value='0'>" . __('Select a Color', 'our-metabox') . "</option>";
        foreach ($colors as $color) {
            $selected = '';
            if ($color == $fav_color) {
                $selected = 'selected';
            }
            $dropdown_html .= sprintf("<option value='%s' %s>%s</option>", $color, $selected, ucwords($color));
        }

        $metabox_html .= <<<ANIS
<p>
	<label for="omb_fav_color">{$label3}: </label>
	<select name="omb_fav_color" id="omb_fav_color" value="0">
	{$dropdown_html}
	</select>
</p>


ANIS;


        echo $metabox_html;
    }

    public function omb_load_textdomain()
    {
        load_plugin_textdomain('our-metabox', false, dirname(__FILE__) . "/languages");
    }
}

new OurMetaBox();
