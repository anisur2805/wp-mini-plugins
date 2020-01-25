<?php	 
// global $post;
// create shortcode to list all clothes which come in blue
add_shortcode( 'arnewssc', 'news_sc_fc' );
function news_sc_fc( $atts ) {

	$atts = shortcode_atts( array(
		//'fimg'		=> '1',
		'rmtext'	=> 'Read More',
		'htag'		=> 'h3',
		//'body_width'	=> $newsSelect,
        'items'     => '4',
        'order'     => 'ASC',

	), 
	$atts, 
	'arnewssc'
);

	//$body_width = $atts['body_width'];
    $items = $atts['items'];
    $order = $atts['order'];


    $newsSelect = get_option('newsbodyw');
    $ndatef = get_option('ndatef'); 
    $newstitletrns = get_option('newstitletrns');
    // var_dump($newsSelect);

        $html = '';
        $html .= '<div class="news">';
       // $html .= '<div class="'.  $newsSelect .'">';
        $html .= '<div class="container">';
        $html .= '<div class="row">';


    $query = new WP_Query( array(
        'post_type' => 'arnews',
        'posts_per_page' => $items,
        'order' => $order,
        'orderby' => 'title',
    ) );
    if ( $query->have_posts() ) { 
    
        while ( $query->have_posts() ) : $query->the_post();
        $html .= '<div id="post" class=" '. $newsSelect .' ">';
        $html .= '<div class="news-block">';
        
		$fimg = get_the_post_thumbnail(get_the_ID(), 'newsthumb' );
        var_dump($fimg);
        if($fimg ) {
            $html .= '<a href="' . get_the_permalink() . ' "> '.$fimg.' </a>';
        }else {
            $html .= '<a href="' . get_the_permalink() . ' "><img src="'. plugins_url( 'assets/images/news-thumb.png', __FILE__ ) .'" alt=""/></a>';
        }
		$html .= '<p class="newsdate">' .get_the_date($ndatef). ', <span>By <i>' . get_the_author() . '</i></span></p>';
        $html .= '<h3 class="news-title ' . $newstitletrns . '"><a href="'. get_the_permalink() .'">' .get_the_title() . '</a></h3>';
       	$html .= '<p class="news-excerpt">' .get_the_excerpt(). '</p>';
        $html .= '</div></div>';
        endwhile;  
        wp_reset_postdata(); 

    } 

$html .= '</div></div></div>';
        return $html;
}

