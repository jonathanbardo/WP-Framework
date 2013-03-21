<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Front_End as Framework_Front_End;

if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {	// check for direct file access
	header('Location: /');						// redirect to website root
	die();										// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------

abstract class Front_End extends Framework_Front_End {

	function __construct(){
		parent::__construct();
	}

}