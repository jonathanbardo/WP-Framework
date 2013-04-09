<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Front_End as Project_Front_End;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
//  Functions and definitions for: WordPress Front-End section
//--------------------------------------------------------------------------
class Front_End extends Project_Front_End{

    function __construct() {
        parent::__construct();
    }

}  