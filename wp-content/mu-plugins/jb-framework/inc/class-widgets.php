<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Framework;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit();											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Settings Class
//--------------------------------------------------------------------------
abstract class Widgets {

	function __construct() {
		//Framework specific actions
		//----------------------------
		//...

		//Framework specific filters
		//----------------------------
		//...
	}

}