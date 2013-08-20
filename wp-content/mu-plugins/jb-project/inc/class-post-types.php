<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Project;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Custom Post-Types
//--------------------------------------------------------------------------
abstract class Post_Types {

	function __construct() {
		//Add project specific actions here
		add_action( 'init',        array( $this, 'post_types' ) );
		add_action( 'parse_query', array( $this, 'parse_query' ) );


		//Add project specific filters here 
		add_filter( 'request',     array( $this, 'custom_feed' ) );

		// We usually want these...
		add_post_type_support( 'page', 'excerpt' );

		// We usually do not want these...
		remove_post_type_support( 'page', 'comments' );
		remove_post_type_support( 'page', 'custom-fields' );
		remove_post_type_support( 'post', 'custom-fields' );
		remove_post_type_support( 'post', 'trackbacks' );
	}

	//--------------------------------------------------------------------------
	// Post Types (Don't forget to register a new settings field for the slug rewrite)
	//--------------------------------------------------------------------------
	public function post_types() {
		//--------------------------------------------------------------------------
		// Post Type registration (project wide)
		//--------------------------------------------------------------------------

		// register_taxonomy('post_tag', array());
	}

	//--------------------------------------------------------------------------
	// This function is a work aroung a wordpress bug when calling post_type_archive_title
	//--------------------------------------------------------------------------
	// see : http://core.trac.wordpress.org/ticket/21821
	public function parse_query( $wp_query ) {
		if ( $wp_query->is_post_type_archive && $wp_query->is_tax )
			$wp_query->is_post_type_archive = false;
	}

	//--------------------------------------------------------------------------
	// Add custom post type into main feed
	//--------------------------------------------------------------------------
	public function custom_feed( $qv ) {
		if ( isset( $qv['feed'] ) )
			$qv['post_type'] = array( 'post' );

		return $qv;
	}

}  