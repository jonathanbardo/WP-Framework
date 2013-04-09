<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Framework;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
//  Functions and definitions for: Handling multilingual / multisite in WordPress
//--------------------------------------------------------------------------
class Multilingual {

    public static $lang = 'en_US';

    function __construct() {
        // Project specific action
		//----------------------------
		add_action('init', array($this, 'language'));
        add_action('after_setup_theme', array($this, 'textdomain'));

        //Theme specific filters
        //----------------------------
    }

    public function language() {
        Multilingual::$lang = str_replace('-', '_', strtolower(get_bloginfo('language')));
    }

    //--------------------------------------------------------------------------
	// Load project text-domain
	//--------------------------------------------------------------------------
	public function textdomain() {
		load_theme_textdomain('jb', get_stylesheet_directory() . '/languages');
	}

}  