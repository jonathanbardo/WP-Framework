<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Admin as Framework_Admin;

if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {	// check for direct file access
	header('Location: /');						// redirect to website root
	die();										// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------

abstract class Admin extends Framework_Admin{

    function __construct(){
        parent::__construct();
    }

}  