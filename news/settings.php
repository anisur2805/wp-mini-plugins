<?php


// create custom plugin settings menu
add_action('admin_menu', 'news_plugin_create_menu');

function news_plugin_create_menu() {

	//create new top-level menu
	add_submenu_page('edit.php?post_type=arnews', 'News Settings', 'News Settings', 'administrator', 'news-slug', 'news_cbf' );
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )

	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'news-plugin-settings-group', 'new_option_name' );
	register_setting( 'news-plugin-settings-group', 'some_other_option' );
	register_setting( 'news-plugin-settings-group', 'option_etc' );
	register_setting( 'news-plugin-settings-group', 'newsbodyw' );
	register_setting( 'news-plugin-settings-group', 'another_text' );
	register_setting( 'news-plugin-settings-group', 'gender' );
	register_setting( 'news-plugin-settings-group', 'uemail' );
	register_setting( 'news-plugin-settings-group', 'selectdate' );
	register_setting( 'news-plugin-settings-group', 'ucomments' );
    register_setting( 'news-plugin-settings-group', 'ugame' );
    register_setting( 'news-plugin-settings-group', 'ndatef' );
	register_setting( 'news-plugin-settings-group', 'newstitletrns' );
}

function news_cbf() {
    global $options;
?>
<div class="wrap">
<h1>Your Plugin Name</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'news-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'news-plugin-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><label for="new_option_name">New Option Name</label></th>
        <td><input type="text" name="new_option_name" id="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row"><label for="some_other_option">Some Other Option</label></th>
        <td><input type="text" name="some_other_option" id="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><label for="option_etc">Options, Etc.</label></th>
        <td><input type="text" name="option_etc" id="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>

        <tr>
        	<th><label for="newsbodyw">News Width</label></th>
        	<td>
        		<?php $newsSelect = get_option('newsbodyw'); ?>
        		<select name="newsbodyw" id="newsbodyw">
	        		<option value="col-md-12" <?php selected( $newsSelect, 'col-md-12' ); ?>>Full Width</option>
	        		<option value="col-md-6" <?php selected( $newsSelect, 'col-md-6' ); ?>>Half Width</option>
                    <option value="col-md-4" <?php selected( $newsSelect, 'col-md-4' ); ?>>One Third</option>
	        		<option value="col-md-3" <?php selected( $newsSelect, 'col-md-3' ); ?>>One Fourth</option>
        	    </select>
        </td>
        </tr> 

        <tr>
            <th><label for="newsbodyw">News Title Transform</label></th>
            <td>
                <?php $newstitletrns = get_option('newstitletrns'); ?>
                <select name="newstitletrns" id="newstitletrns">
                    <option value="none" <?php selected( $newstitletrns, 'none' ); ?>>None</option>
                    <option value="inherit" <?php selected( $newstitletrns, 'inherit' ); ?>>Inherit</option>
                    <option value="text-capitalize" <?php selected( $newstitletrns, 'text-capitalize' ); ?>>Capitalize</option>
                    <option value="text-uppercase" <?php selected( $newstitletrns, 'text-uppercase' ); ?>>Uppercase</option>
                    <option value="text-lowercase" <?php selected( $newstitletrns, 'text-lowercase' ); ?>>Lowercase</option>
                    <option value="initial" <?php selected( $newstitletrns, 'initial' ); ?>>Initial</option>
                </select>
        </td>
        </tr> 

        <tr>
            <th><label for="ndatef">News Date Format</label></th>
            <td>
                <?php $ndatef = get_option('ndatef'); ?>
                <select name="ndatef" id="ndatef">
                    <option value="d-m-Y" <?php selected( $ndatef, 'd-m-Y' ); ?>>DD-MM-YY</option>
                    <option value="m-d-Y" <?php selected( $ndatef, 'm-d-Y' ); ?>>MM-DD-YY</option>
                    <option value="Y-m-d" <?php selected( $ndatef, 'Y-m-d' ); ?>>YY-MM-DD</option>
                    <option value="Y-d-m" <?php selected( $ndatef, 'Y-d-m' ); ?>>YY-DD-MM</option>

                    <option value="d/m/Y" <?php selected( $ndatef, 'd/m/Y' ); ?>>DD/MM/YY</option>
                    <option value="m/d/Y" <?php selected( $ndatef, 'm/d/Y' ); ?>>MM/DD/YY</option>
                    <option value="Y/m/d" <?php selected( $ndatef, 'Y/m/d' ); ?>>YY/MM/DD</option>
                    <option value="Y/d/m" <?php selected( $ndatef, 'Y/d/m' ); ?>>YY/DD/MM</option>
                </select>
        </td>
        </tr> 

        <tr>
        	<th scope="row"><label for="another_text">Another Test</label></th>
        	<td><input type="text" name="another_text" id="another_text" value="<?php echo esc_attr(get_option('another_text')); ?>" /></td>
        </tr>

        <tr>
        	<?php $gender = get_option('gender'); ?>
        	<th><label for="gender">Gender:</label></th>
        	<td>
        		<input type="radio" name="gender" value="1" <?php checked( $gender, 1 ); ?>>Male&nbsp; &nbsp;
        		<input type="radio" name="gender" value="2" <?php checked( $gender, 2 ); ?>>Female &nbsp; &nbsp;
        		<input type="radio" name="gender" value="3" <?php checked( $gender, 3 ); ?>>Others

        	</td>
        </tr>

        <tr>
        	<th><label for="uemail">Your Email:</label> </th>
        	<td><input type="email" name="uemail" id="uemail" value="<?php echo get_option('uemail'); ?>" placeholder="example@mail.com"></td>
        </tr>

        <tr>
        	<th><label for="selectdate">Select Date: </label> </th>
        	<td><input type="date" name="selectdate" id="selectdate" value="<?php echo get_option('selectdate'); ?>" placeholder="DD/MM/YY"></td>
        </tr>

        <tr>
        	<th><label for="ucomments">Comments: </label> </th>
        	<td>
        		<textarea name="ucomments" id="ucomments" cols="100" rows="5"><?php echo get_option('ucomments'); ?></textarea>
        		<!-- <input type="date" name="selectdate" id="selectdate" value="<?php echo get_option('selectdate'); ?>" placeholder="DD/MM/YY"></td> -->
        </tr>

        <tr>
            <?php $ugame = get_option('ugame'); ?>
        	<th><label for="ugame">Select Game: </label> </th>

        	<td>
               <?php  $options = get_option( 'ugame' ); ?>
                <input type="radio" id="radio_example_one" name="ugame" value="1"<?php checked( $options, 1); ?> />Football&nbsp; 
                <input type="radio" id="radio_example_two" name="ugame" value="2"<?php checked( $options, 2); ?>/>Cricket
            </tr>


    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } 
