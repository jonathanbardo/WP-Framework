<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Init as Framework_Init;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// JB WordPress project
//--------------------------------------------------------------------------
// This is were we include project specific function
// 
//
abstract class Init extends Framework_Init{

	function __construct() {
		parent::__construct();

		// Framework specific actions
		//----------------------------
		add_action( 'wp_enqueue_script', array( $this, 'scripts' ) );

		if ( is_admin() ) add_editor_style('style-editor.css');

		// Framework specific filters
		//----------------------------
		//...
	}

	//--------------------------------------------------------------------------
	// Scripts : We load the latest version of jQuery via Google
	//--------------------------------------------------------------------------
	public function scripts() {
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', false, '1.9.1', false);

	}

}