<?php
/**
 *Testimonial functions file
 *
**/

if(!function_exists('art_after_theme_setup')){
	function art_after_theme_setup(){
		add_image_size( 'ar-thumb', 100, 100, true );
		add_image_size( 'ar-admin-thumb', 80, 80, true );
	}
	add_action( 'after_setup_theme', 'art_after_theme_setup' );
}

if(!function_exists('art_enqueue_assets')){
	function art_enqueue_assets(){
		wp_enqueue_style('ar-bootstrap', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ));
		wp_enqueue_style( 'ar-owl', plugins_url( 'assets/css/owl.carousel.min.css', __FILE__ ));
		wp_enqueue_style( 'ar-style', plugins_url( 'assets/css/style.css', __FILE__ ));
		wp_enqueue_style( 'ar-admin-style', plugins_url( 'assets/css/admin-style.css', __FILE__ ));
		wp_enqueue_style( ' ar-fontAwesome ', plugins_url( 'assets/css/font-awesome.min.css', __FILE__ ));

		wp_enqueue_script( 'ar-js', plugins_url( 'assets/js/jquery.js', __FILE__ ));
		wp_enqueue_script( 'ar-bootstrap-js', plugins_url( 'assets/js/bootstrap.min.js', __FILE__ ));
		wp_enqueue_script( 'ar-owl-carousel-js', plugins_url( 'assets/js/owl.carousel.min.js', __FILE__ ));
		wp_enqueue_script( 'ar-main', plugins_url( 'assets/js/main.js', __FILE__ ));

		wp_localize_script( 'ar-main', 'myHandeler', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )) );
	}
add_action('wp_enqueue_scripts', 'art_enqueue_assets');

}


add_action('admin_enqueue_scripts', 'art_admin_scripts');

function art_admin_scripts( $hook ) { 
	global $pagenow, $typenow;

	if(($pagenow == 'post-new.php' || $pagenow == 'post.php') && $typenow == 'art'){
		
	   wp_enqueue_style('admin-style-css', plugins_url('assets/css/admin-style.css',__FILE__ ));
	   wp_enqueue_style('ar-test-style', plugins_url('assets/css/style.css',__FILE__ ));
	}

}


function site_home_shortcode( $atts ){
    return home_url('');
}
add_shortcode( 'home_url', 'site_home_shortcode' );