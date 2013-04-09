<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Shortcodes as Framework_Shortcodes;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Social Class
//--------------------------------------------------------------------------
abstract class Shortcodes extends Framework_Shortcodes {

	function __construct() {
		parent::__construct();

		//We usually don't want those shortcodes
		//----------------------------
		remove_shortcode('wp_caption');
		remove_shortcode('caption');
		remove_shortcode('embed');
	}

}