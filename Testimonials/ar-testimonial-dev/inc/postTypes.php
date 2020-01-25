<?php
defined('ABSPATH') || die('Nice Try!');

// include PLUGIN_PATH.'trait/AppSetting.php';
// use MyApp\AppSetting;

class Testimonial {

	// use AppSetting;
    /**
     * @var string
     *
     * Set post type params
     */
    // const TYPE 		= AppSetting::appType();

    // const TYPE 		= 'testimonial';
    private $type;
    private $slug;
    private $name;
    private $singular_name;


     // ucwords( str_replace( '_', ' ', $string ) );

    private $txs_name = 'Category';
    private $txs_slug = 'categories';
    private $txp_name = 'Categories';

    /**
     * Register post type
     */
    public function register() {
    	$labels = array(
    		'name'                  => $this->name,
    		'singular_name'         => $this->singular_name,
    		'add_new'               => 'Add New',
    		'add_new_item'          => 'Add New '   . $this->singular_name,
    		'edit_item'             => 'Edit '      . $this->singular_name,
    		'new_item'              => 'New '       . $this->singular_name,
    		'all_items'             => 'All '       . $this->name,
    		'view_item'             => 'View '      . $this->name,
    		'search_items'          => 'Search '    . $this->name,
    		'not_found'             => 'No '        . strtolower($this->name) . ' found',
    		'not_found_in_trash'    => 'No '        . strtolower($this->name) . ' found in Trash',
    		'parent_item_colon'     => '',
    		'menu_name'             => $this->name
    	);
    	$args = array(
    		'labels'                => $labels,
    		'public'                => true,
    		'publicly_queryable'    => true,
    		'show_ui'               => true,
    		'show_in_menu'          => true,
    		'query_var'             => true,
    		'rewrite'               => array( 'slug' => $this->slug ),
    		'capability_type'       => 'post',
    		'has_archive'           => true,
    		'hierarchical'          => true,
    		'menu_position'         => 8,
    		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes', 'post-formats')
    	);
    	register_post_type( $this->type, $args );
    }
    /**
     * @param $columns
     * @return mixed
     *
     * Choose the columns you want in
     * the admin table for this post
     */
    public function set_columns($columns) {
        // Set/unset post type table columns here

    	unset( $columns['author'] );
    	unset( $columns['title'] );
    	unset( $columns['comments'] );
    	unset( $columns['taxonomy-categories'] );
    	unset( $columns['date'] );

    	$columns['testimonial_thumb'] = 'Image';
    	$columns['title'] = 'Title';
    	$columns['_tmAuthor'] = 'Author';
    	$columns['_tmRating'] = 'Rating';
    	$columns['taxonomy-categories'] = 'Categories';
    	$columns['date'] = 'Date';

    	return $columns;
    }
    /**
     * @param $column
     * @param $post_id
     *
     * Edit the contents of each column in
     * the admin table for this post
     */
    public function edit_columns($column, $post_id) {
    	
    	if( 'testimonial_thumb' == $column ) {
    		echo get_the_post_thumbnail( $post_id, array(50, 50) );
    	} elseif ( '_tmAuthor' == $column ) { 
    		$tmAuthor =  get_post_meta( get_the_ID(), '_tmAuthor', true ) ;
    		echo $tmAuthor;
    	} elseif( '_tmRating' == $column ){
    		$test_rating = esc_html( get_post_meta( get_the_ID(), '_tmRating', true ) );
    		if( !empty( $test_rating ) ) {
    			echo $test_rating . ' Star';
    		}
    	} elseif( 'taxonomy-categories' == $column ){
    		$tmCat =  get_post_meta( get_the_ID(), 'taxonomy-categories', true ) ;
    		echo $tmCat;
    	} else {
    		echo 'None Assigned';
    	}
    }

    /**
     * @param $columns
     * @return mixed
     *
     * Column Sortable
     * 
     */

    public function column_sortable( $columns ) {
    	$columns['testimonial_thumb'] = 'testimonial_thumb';
    	$columns['_tmAuthor'] = '_tmAuthor';
    	$columns['_tmRating'] = '_tmRating';
    	$columns['taxonomy-categories'] = 'taxonomy-categories';

    	return $columns;
    }

    /**
     * Testimonial Taxonomy
     *
     */
    public function testimonial_taxonomies() {

    	$labels = array(
    		'name'              => $this->txp_name,
    		'singular_name'     => $this->txs_name,
    		'search_items'      => 'Search '.$this->txp_name,
    		'all_items'         => 'All '.$this->txp_name,
    		'parent_item'       => 'Parent '.$this->txs_name,
    		'parent_item_colon' => 'Parent '.$this->txs_name,
    		'edit_item'         => 'Edit '.$this->txs_name,
    		'update_item'       => 'Update '.$this->txs_name,
    		'add_new_item'      => 'Add New '.$this->txs_name,
    		'new_item_name'     => 'New '.$this->txs_name.' Name',
    		'menu_name'         => $this->txp_name
    	);

    	$args = array(
    		'hierarchical'      => true,
    		'labels'            => $labels,
    		'show_ui'           => true,
    		'show_admin_column' => true,
    		'query_var'         => true,
    		'rewrite'           => array( 'slug' => $this->txs_name ),
    	);
    	register_taxonomy( $this->txs_slug, array( $this->type ), $args );	
    }

    /**
     * Testimonial constructor.
     *
     * When class is instantiated
     */
    public function __construct() {

    	$data = AppSetting::appType();
    	$this->type = $data['type'];
    	$this->slug = $data['slug'];
    	$this->name = $data['name'];
    	$this->singular_name = $data['singular_name'];

    	add_action('init', array($this, 'register'));
    	add_filter( 'manage_edit-'.$this->type.'_columns', array($this, 'set_columns'), 10, 1);
    	add_action( 'manage_'.$this->type.'_posts_custom_column', array($this, 'edit_columns'), 10, 2 );
    	add_action( 'init', array( $this, 'testimonial_taxonomies'), 0 );
    	add_filter( 'manage_edit-'.$this->type.'_sortable_columns', array( $this, 'column_sortable' ) );
    }
}
/**
 * Instantiate class, creating post type
 */
new Testimonial();