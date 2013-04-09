<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Users as Project_Users;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}


//--------------------------------------------------------------------------
// Users class
//--------------------------------------------------------------------------
class Users extends Project_Users {

	function __construct() {
		parent::__construct();
	}

}