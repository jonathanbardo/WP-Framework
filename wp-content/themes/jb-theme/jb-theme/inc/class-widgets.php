<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Widgets as Project_Widgets;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}


//--------------------------------------------------------------------------
// Widgets class
//--------------------------------------------------------------------------
class Widgets extends Project_Widgets {

	function __construct() {
		parent::__construct();
	}

}