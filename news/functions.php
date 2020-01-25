<?php
/**
 *Testimonial functions file
 *
**/

if(!function_exists('ar_after_theme_setup')){
	function ar_after_theme_setup(){
		add_image_size( 'ar-thumb', 100, 100, true );
		add_image_size( 'newsthumb', 50, 50, true );
	}
	add_action( 'after_setup_theme', 'ar_after_theme_setup' );
}

// CREATE OWN GLOBAL DIRECTORY
if (!defined('MYPLUGIN_THEME_DIR')){
    define('MYPLUGIN_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());}

if (!defined('MYPLUGIN_PLUGIN_NAME')){
    define('MYPLUGIN_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));}

if (!defined('MYPLUGIN_PLUGIN_DIR')){
    define('MYPLUGIN_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . MYPLUGIN_PLUGIN_NAME);}

if (!defined('MYPLUGIN_PLUGIN_URL')){
    define('MYPLUGIN_PLUGIN_URL', WP_PLUGIN_URL . '/' . MYPLUGIN_PLUGIN_NAME);}


if(!function_exists('ar_testimonials_assets')){
	function ar_testimonials_assets(){
		// wp_register_style('ar-bootstrap', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ));
		// wp_enqueue_style( 'ar-bootstrap');
		// wp_register_style( 'ar-owl', plugins_url( 'assets/css/owl.carousel.min.css', __FILE__ ));
		// wp_enqueue_style( 'ar-owl' );
		 
		// wp_register_style( 'ar-admin-style', plugins_url( 'assets/css/admin-style.css', __FILE__ ));
		// wp_enqueue_style( 'ar-admin-style' );
		// wp_register_style( ' ar-fontAwesome ', plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ));
		// wp_enqueue_style( ' ar-fontAwesome ' );
		// wp_enqueue_script( 'ar-jquery', plugins_url( 'assets/js/jquery-3.3.1.slim.min.js', __FILE__ ));
		// wp_enqueue_script( 'ar-bootstrap-js', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ));
		// wp_enqueue_script( 'ar-owl-carousel-js', plugins_url( 'assets/js/owl.carousel.min.js', __FILE__ ));
		// wp_enqueue_script( 'ar-main', plugins_url( 'assets/js/main.js', __FILE__ ));



		$handle = 'ar-bootstrap';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/css/bootstrap.min.css';
		wp_register_style($handle, $src);
		wp_enqueue_style($handle);

		$handle = 'ar-owl';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/css/owl.carousel.min.css';
		wp_register_style($handle, $src);
		wp_enqueue_style($handle);
		
		$handle = 'arnews-style';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/css/style.css';
		wp_register_style($handle, $src);
		wp_enqueue_style($handle);
		
		// $handle = 'ar-style';
		// $src = MYPLUGIN_PLUGIN_URL . '/assets/css/style.css';
		// wp_register_style($handle, $src);
		// wp_enqueue_style($handle);
		
		$handle = 'ar-fontAwesome';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/css/font-awesome.min.css';
		wp_register_style($handle, $src);
		wp_enqueue_style($handle);	
			
		$handle = 'ar-jquery';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/js/jquery-3.3.1.slim.min.js';
		wp_register_script($handle, $src);
		wp_enqueue_script($handle);
			
		$handle = 'ar-bootstrap';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/js/bootstrap.min.js';
		wp_register_script($handle, $src);
		wp_enqueue_script($handle);
					
		$handle = 'ar-owl-carousel';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/js/owl.carousel.min.js';
		wp_register_script($handle, $src);
		wp_enqueue_script($handle);

		$handle = 'ar-main';
		$src = MYPLUGIN_PLUGIN_URL . '/assets/js/main.js';
		wp_register_script($handle, $src);
		wp_enqueue_script($handle);

add_action('wp_enqueue_scripts', 'ar_testimonials_assets');
	}

}

add_action( 'wp_enqueue_scripts', 'arnews_assets');
function arnews_assets(){
	wp_enqueue_style( 'arnews-style', plugins_url('assets/css/style.css',__FILE__ ) );
}


//add_action('admin_print_styles', 'ar_test_admin_enqueue_scripts');
//
//function ar_test_admin_enqueue_scripts( ) { 
//	global $pagenow, $typenow;
	// $pn 	= 'post-new.php';
	// $p 		= 'post.php';
	// if($hook != ($pn || $p) ) {
	//     return;
	// }
 //   wp_enqueue_style('admin-style-css', plugins_url('assets/css/admin-style.css',__FILE__ ));
 //   wp_enqueue_style('ar-test-style', plugins_url('assets/css/style.css',__FILE__ ));


//	if($pagenow == array('post-new.php' || 'post.php') || $typenow == 'testimonial'){
//	
//		$handle = 'admin-style-css';
//	    $src = MYPLUGIN_PLUGIN_URL . '/assets/css/admin-style.css';
//	    wp_register_style($handle, $src);
//	    wp_enqueue_style($handle);
//	}
//}

 

// custom excerpt length
function news_custom_excerpt_length( $length ) {
   return 20;
}
add_filter( 'excerpt_length', 'news_custom_excerpt_length', 999 );

// add more link to excerpt
function news_custom_excerpt_more($more) {
   global $post;
   return '<a class="more-link news" href="'. get_permalink($post->ID) . '">'. __('Read More...', 'news') .'</a>';
}
add_filter('excerpt_more', 'news_custom_excerpt_more');