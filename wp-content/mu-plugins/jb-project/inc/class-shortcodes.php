<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Project;
use JB\Framework\Shortcodes as Framework_Shortcodes;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Social Class
//--------------------------------------------------------------------------
abstract class Shortcodes extends Framework_Shortcodes {

	function __construct() {
		parent::__construct();

		//We usually don't want those shortcodes
		//----------------------------
		remove_shortcode( 'wp_caption' );
		remove_shortcode( 'caption' );
		remove_shortcode( 'embed' );
	}

}