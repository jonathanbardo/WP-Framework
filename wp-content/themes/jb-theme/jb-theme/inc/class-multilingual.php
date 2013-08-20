<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Multilingual as Project_Multilingual;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
//  Functions and definitions for: Handling multilingual / multisite in WordPress
//--------------------------------------------------------------------------
class Multilingual extends Project_Multilingual{

	function __construct() {
		parent::__construct();

		//Theme specific filters
		//----------------------------
		// For use with the excellent plugin multisite language switcher https://github.com/lloc/Multisite-Language-Switcher
		// add_filter('msls_blog_collection_construct',	array($this,'msls_blog_collection'));
		// add_filter('msls_options_get_permalink', 		array($this,'msls_options_get_permalink'), 10, 2);
	}

	//--------------------------------------------------------------------------
	// Override default plugin behavior on blog collection 
	//--------------------------------------------------------------------------
	//	Plugin filter : multisite language switcher
	//  The enable grouping of site inside a big multisite organization
	//
	public function msls_blog_collection( $arr ) {
		$arr = array();

		foreach ( array( 1, 2 ) as $id )
			$arr[$id] = get_blog_details( $id );

		return $arr;
	}


	//--------------------------------------------------------------------------
	// see : https://github.com/lloc/Multisite-Language-Switcher/wiki/Change-the-generated-URLs
	//--------------------------------------------------------------------------
	public function msls_options_get_permalink( $url, $language ){
		switch ($language):
			case 'us':
				$url = str_replace( '/blogue/', '/blog/', $url );
				break;
			
			case 'fr_FR':
				$url = str_replace( '/blog/', '/blogue/', $url );
				break;
		endswitch;

		if ( $url == '' )
			$url = home_url();

		return $url;
	}


}  