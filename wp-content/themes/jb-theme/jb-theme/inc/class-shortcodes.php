<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Shortcodes as Project_Shortcodes;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Shortcodes
//--------------------------------------------------------------------------
// Introduced in WordPress 2.5 is the Shortcode API, a simple set of functions
// for creating macro codes for use in post content.
// See: http://codex.wordpress.org/Shortcode_API
class Shortcodes extends Project_Shortcodes {

	function __construct(){
		parent::__construct();

		//Shortcode to create a column of the specified width
		add_shortcode( 'test', 	array( $this, 'test_shortcode' ) );
		Shortcodes::$shortcode_help[] = array(
			'title' 	=> '[column style="1"]',
			'content' 	=> 'Create a block of the specify number of column',
		);
	}

	//--------------------------------------------------------------------------
	// Actual shortcode functions
	//--------------------------------------------------------------------------
	public function test_shortcode( $atts, $content = null ) {
		extract(
			shortcode_atts(
				array(
					'style' => '1',
				),
				$atts 
			)
		);

		return 'Test';
	}

}
