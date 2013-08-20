<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Metabox as Project_Metabox;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Custom Metaboxes
//--------------------------------------------------------------------------
class Metabox extends Project_Metabox {

	function __construct() {
		parent::__construct();
	}

	//--------------------------------------------------------------------------
	// Create specific function for meta
	//--------------------------------------------------------------------------
	public function metaboxes( $meta_boxes = array() ) {
		$meta_boxes = parent::metaboxes();

		/* $meta_boxes[] = array(
			'title' => 'test 3',
			'pages' => 'post',
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array( 
					'id' => 'sdsdff', 
					'name' => 'A Normal text input', 
					'type' => 'datetime_unix', 
					'cols' => 12 
				)
			)
		);*/

		return $meta_boxes;
	}

}  