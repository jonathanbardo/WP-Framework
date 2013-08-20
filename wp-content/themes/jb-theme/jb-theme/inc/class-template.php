<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Template as Project_Template;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
//  Functions and definitions for: WordPress Front-End section
//--------------------------------------------------------------------------
class Template extends Project_Template{

	function __construct() {
		parent::__construct();
	}

}  