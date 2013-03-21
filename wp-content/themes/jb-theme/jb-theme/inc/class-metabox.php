<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Metabox as Project_Metabox;

if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {	// check for direct file access
	header('Location: /');						// redirect to website root
	die();										// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Custom Metaboxes
//--------------------------------------------------------------------------

class Metabox extends Project_Metabox{

    function __construct(){
        parent::__construct();
    }

    //--------------------------------------------------------------------------
    // Create specific function for meta
    //--------------------------------------------------------------------------
    public function metaboxes(){
    	parent::metaboxes();
    }

}  