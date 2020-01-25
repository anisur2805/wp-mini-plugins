<?php
if(!function_exists('art_cbf')){
	function art_cbf( $atts ) {

		ob_start();

		$atts = shortcode_atts(array(
			'items'			=> -1,	// how much
			'posts_order'		=> 'DESC',
			'col'			=> '4',	// column number
			'artc_email'		=> '',
			'carousel'		=> '',	// 1 for carousel
			'artc_ratting'		=> ''

		), $atts,
		'artm'
	);

		$column = $atts['col'];
		$carousel = $atts['carousel']; 
		$posts_order = $atts['posts_order']; 

		$args = array(
			'post_type'			=> 'art',
			'order'			=> $posts_order,
		);

		$html = '';

		$ar_query 	= new WP_Query( $args );
		
		$option = get_option('choose_layout');

		if($option == '1'):

		$html .= '<div class="container">';
		$html .= '<div class="row">';
		

		
		if( $ar_query->have_posts() ):
			while( $ar_query->have_posts()): $ar_query->the_post();

				//global $post;


		$html .= '<div class="col-md-'. $column .'">';
				$html .= '<div class="ar-test-block">';

				$author_pic = get_the_post_thumbnail(get_the_ID(), 'ar-thumb');

				if( $author_pic ):
					$html .= '<div class="author_image">' . $author_pic . '</div>';
				else: 
					$pic_author = plugins_url( 'assets/images/layout-3.jpg', __FILE__ );
					
					$html .= '<div class="author_image"><img width="100" height="100" src="'.$pic_author.'" class="attachment-ar-thumb size-ar-thumb wp-post-image" alt="" /></div>';
				endif;

				$html .= '<div class="content"><p>'. get_the_content(). '</p></div>';

				$html .= '<div class="author_name">';
				$html .= '<h3>'. get_the_title().'</h3></div>';

				$html .= '<div class="author_info">';

				if(  ['_artc_company'] ):

					$html .= '<h4>'. get_post_meta( get_the_ID(), '_artc_company', true );

					$author_postion = get_post_meta( get_the_ID(), '_artc_designation', true );
					if( $author_postion ):
						$html .= '<small> ' . $author_postion . '</small>';
					endif;

					$html .= '</h4>';
				endif; 

				$ar_email = get_post_meta( get_the_ID(), '_artc_email', true );
				if(!empty( $ar_email )) :
					$html .= '<h3 class="art_email"><a href="mailto:'. $ar_email .'">Mail:<strong>' . $ar_email . '</strong></a></h3>';
				endif;

				$web_url = get_post_meta( get_the_ID(), '_artc_website', true );
				if( !empty( $web_url ) ):

					$html .= '<p class="site"><a target="_blank" href=" '. $web_url .' ">' . $web_url . '</a></p>';
				endif;


				$artc_ratting = get_post_meta( get_the_ID(), '_artc_ratting', true );
				if(isset($artc_ratting)){
					$html .= '<p>User Rating is: '.$artc_ratting.'</p>';
				}

				$html .= '</div></div></div>';
			endwhile;
			wp_reset_postdata(); 
		endif;
		$html .= '</div></div>'; 

	endif;



		return $html . ob_get_clean();
	}
	add_shortcode( 'artm', 'art_cbf' );
}