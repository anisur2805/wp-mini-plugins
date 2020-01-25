<?php // Myplugin - Admin Menu

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function myplugin_admin_menu() {
	add_submenu_page( 'options-general.php', 'Myplugin', 'Myplugin', 'manage_options', 'myplugin', 'myplugin_display_settings_page' );
}
add_action("admin_menu", "myplugin_admin_menu");