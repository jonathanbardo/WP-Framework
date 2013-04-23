<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Template as Project_Template;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
//  Functions and definitions for: WordPress Front-End section
//--------------------------------------------------------------------------
class Template extends Project_Template{

    function __construct() {
        parent::__construct();
    }

}  