<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Social as Project_Social;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Social Class
//--------------------------------------------------------------------------
class Social extends Project_Social{

	function __construct(){
		parent::__construct();
	}

}
