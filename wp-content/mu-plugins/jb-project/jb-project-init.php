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

		//Instanciate every class needed
		//----------------------------
		new \JB\Theme\Post_Types();
		new \JB\Theme\Multilingual();
		new \JB\Theme\Admin();
		new \JB\Theme\Template();
		new \JB\Theme\Metabox();
		new \JB\Theme\Settings();
		new \JB\Theme\Widgets();
		new \JB\Theme\Users();
		new \JB\Theme\Update();
		new \JB\Theme\Social();
		new \JB\Theme\Shortcodes();
		new \JB\Theme\Post();

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