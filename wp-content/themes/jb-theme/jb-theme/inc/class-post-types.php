<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Post_Types as Project_Post_Types;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Post Types
//--------------------------------------------------------------------------
class Post_Types extends Project_Post_Types{

	function __construct() {
		parent::__construct();

		//Theme specific filters
		//See https://github.com/billerickson/cms-page-order
		add_action('cmspo_page_label', 	array($this,'cms_page_order_label'), 10, 2);
		add_filter('cmspo_post_types', 	array($this,'cms_page_order_post_types'));
	}

}