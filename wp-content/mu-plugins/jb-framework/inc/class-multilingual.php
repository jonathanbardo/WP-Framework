<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Framework;

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
abstract class Multilingual {

	public static $lang = 'en_US';

	function __construct() {
		// Project specific action
		//----------------------------
		add_action( 'init',              array( $this, 'language' ) );
		add_action( 'after_setup_theme', array( $this, 'textdomain' ) );

		//Theme specific filters
		//----------------------------
	}

	public function language() {
		Multilingual::$lang = str_replace( '-', '_', strtolower( get_bloginfo( 'language' ) ) );
	}

	//--------------------------------------------------------------------------
	// Load project text-domain
	//--------------------------------------------------------------------------
	public function textdomain() {
		load_theme_textdomain( 'jb', get_stylesheet_directory() . '/languages' );
	}

}  