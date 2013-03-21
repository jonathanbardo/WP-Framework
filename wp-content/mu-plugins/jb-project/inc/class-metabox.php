<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Metabox as Framework_Metabox;

if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {	// check for direct file access
	header('Location: /');						// redirect to website root
	die();										// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Custom Metaboxes
//--------------------------------------------------------------------------

abstract class Metabox extends Framework_Metabox{

    function __construct(){
        parent::__construct();
    }

    //--------------------------------------------------------------------------
    // Create specific function for meta
    //--------------------------------------------------------------------------
    public function metaboxes(array $meta_boxes = array()){
    	parent::metaboxes($meta_boxes);
    }

}  