<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Init as Project_Init;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Theme Init
//--------------------------------------------------------------------------
class Init extends Project_Init{

	function __construct(){
		parent::__construct();

		//Theme specific actions
		//----------------------------
		//...

		//Theme specific filters
		//----------------------------
		//...
	}

	//--------------------------------------------------------------------------
	// Scripts & styles
	//--------------------------------------------------------------------------
	// Scripts should be located in the child's folder, accessible using get_bloginfo('stylesheet_directory').
	// If the script is a library, include it 
	public function scripts() {
		parent::scripts();

		wp_enqueue_style( 'style', get_bloginfo( 'stylesheet_directory' ).'/style.css' );
		// wp_enqueue_style( 'print-css', get_bloginfo( 'stylesheet_directory' ).'/style-print.css', '', '1', 'print' );
		// wp_enqueue_script( 'project_script', get_bloginfo( 'stylesheet_directory' ).'/js/script.js', array('jquery'), '1', true );
	}

}