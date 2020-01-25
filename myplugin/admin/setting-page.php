<?php // Myplugin - Setting Page

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function myplugin_display_settings_page(){
	if(!current_user_can( 'manage_options' )) return;

	?>
	<div class="wrap">
		<?php //settings_errors(); ?>
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form method="post" action="options.php" id="arbtt">
			<?php
			settings_fields("myplugin_section_id");
			do_settings_sections("myplugin");
			submit_button(); ?>
		</form>
	</div>
	<?php
}