<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Post as Project_Post;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

class Post extends Project_Post {

	function __construct() {
		parent::__construct();

		//Theme specific actions
		//...

		//Theme specific filters
		//...
	}


	public function pre_get_posts( $query ) {
		if ( is_post_type_archive( 'kit_media' ) )
			$query->set( 'posts_per_page', -1 );
		
		parent::pre_get_posts( $query );
	}

	//--------------------------------------------------------------------------
	// We don't want any FAQ single page
	//--------------------------------------------------------------------------
	public function redirect_post_type_single() {
		// parent::redirect_post_type_single();
		// if(is_singular('post-type'))
		//	wp_redirect(get_post_type_archive_link(get_post_type()), 301) and exit;
	}

}