<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Post_Types as Project_Post_Types;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Post Types
//--------------------------------------------------------------------------
class Post_Types extends Project_Post_Types {

	function __construct() {
		parent::__construct();

		//Theme specific filters
		//See https://github.com/billerickson/cms-page-order
		add_action( 'cmspo_page_label', 	array( $this, 'cms_page_order_label' ), 10, 2 );
		add_filter( 'cmspo_post_types', 	array( $this, 'cms_page_order_post_types' ) );
	}

	//--------------------------------------------------------------------------
	// Post Types (Don't forget to register a new settings field for the slug rewrite)
	//--------------------------------------------------------------------------
	public function post_types() {
		parent::post_types();

		//--------------------------------------------------------------------------
		// Post Type registration
		//--------------------------------------------------------------------------
		$args = array(
			'labels' => array(
				'name' 				=> __( 'test', 'jb' ), 
				'singular_name' 	=> __( 'test', 'jb' ), 
				'menu_name' 		=> __( 'test', 'jb' ), 
				'add_new_item' 		=> __( 'test', 'jb' ),
				'edit_item'			=> __( 'test', 'jb' ),
			),
			'menu_position' => 3,
			'capability_type' => 'post',
			'exclude_from_search' => true,
			'has_archive' => false,
			'hierarchical' => true,
			'public' => false,
			'show_ui' => true,
			'publicly_queryable' => false,
			'rewrite' => array( 'slug' => get_option( 'jb_base_test' ), 'with_front' => false, 'feeds' => true ),
			'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
		);
		// register_post_type('test', $args);	


		//--------------------------------------------------------------------------
		// Taxonomy registration
		//--------------------------------------------------------------------------
		$args = array(
			'labels' => array(
				'name' => __( 'blog_categories_slug', 'jb' )
			),
			'capabilities' => array( 'assign_terms' ),
			'public' => true,
			'show_tagcloud' => false,
			'show_ui' => true,
			'hierarchical' => true,
			'show_admin_column' => true,
			'rewrite' => array( 'slug' => get_option( 'jb_base_blog_category' ), 'with_front' => false, 'hierarchical' => true ),
		);
		// register_taxonomy('blog_category', array('blog'), $args);
	}

	//--------------------------------------------------------------------------
	// See http://www.billerickson.net/code/change-post-types-cms-page-order/
	//--------------------------------------------------------------------------
	// Plugin reference : https://github.com/billerickson/cms-page-order
	//
	public function cms_page_order_post_types( $post_types ){
		$post_types[] = 'home_banner';
		$post_types[] = 'faq';
		$post_types[] = 'kit_media';
		return $post_types;
	}

	public function cms_page_order_label( $label, $post_type ) {

		switch ( $post_type ) {
			case 'home_banner':
				$label = __( 'Banners Order', 'tp1' );
			break;
			case 'kit_media':
				$label = __( 'Kit Media Order', 'tp1' );
			break;
		}
	
		return $label;
	}

}