<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Admin as Project_Admin;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------
class Admin extends Project_Admin{

    function __construct() {
        parent::__construct();
    }

}  