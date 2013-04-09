<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Post as Framework_Post;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}


class Post extends Framework_Post{

	function __construct(){
		parent::__construct();

		//Project specific actions
		// add_action('template_redirect', 				array($this, 'redirect_post_type_single'));

		// Ajax actions
		//----------------------------
		add_action( 'wp_ajax_nopriv_get_product_infos', array($this, 'get_product_infos') );
		add_action( 'wp_ajax_get_product_infos', 		array($this, 'get_product_infos') );

		//Project specific filters
		add_filter('pre_get_posts', 					array($this, 'pre_get_posts'));
		
	}

	//--------------------------------------------------------------------------
	// Pre-Get Posts
	//--------------------------------------------------------------------------
	// Manipulate queries before they return loops.
	// For example, removing from search the page we use for 404 errors.
	public function pre_get_posts($query) {
		if ($query->is_search):
			$item = get_page_by_path(get_option('tp1_base_404', 'error-404'));
			if (!empty($item))
	        	$query->set('post__not_in', array($item->ID));
	    endif;

    	if(is_post_type_archive(array('faq', 'product')) && !is_admin()){
        	$query->set('posts_per_page', -1);
        	$query->set('post_parent', 0);
        	$query->set('order', 'ASC');
        	$query->set('orderby', 'menu_order');
        	remove_filter('pre_get_posts', array($this, 'pre_get_posts'));
    	}

		return $query;
    
	}

}