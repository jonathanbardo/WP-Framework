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
// Functions and definitions for: WordPress Custom Metaboxes
//--------------------------------------------------------------------------
abstract class Metabox{

	const PREFIX = 'JB_';

    function __construct(){
    	// Trigger metabox creation
    	//----------------------------
	    add_filter( 'cmb_meta_boxes', array($this, 'metaboxes') );
    }

    //--------------------------------------------------------------------------
    // Create specific function for meta
    //--------------------------------------------------------------------------
    public function metaboxes ( array $meta_boxes = array() ) {
		$meta_boxes[] = array(
			'title' => 'Test Meta Box',
			'pages' => 'post',
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array( 
					'id' => 'input', 
					'name' => 'A Normal text input', 
					'type' => 'datetime_unix', 
					'cols' => 12 
				),
				array( 
					'id' => 'input32', 
					'name' => 'Color', 
					'type' => 'wysiwyg', 
					// 'repeatable' => true
				),
				array( 
					'id' => 'input2', 
					'name' => 'Test Repeatable Field', 
					'type' => 'post_select', 
					'cols' => 4, 
					'repeatable' => true, 
					'disabled' => false 
				),
				array( 
					'id' => 'input3', 
					'name' => 'URL Text Field', 
					'type' => 'url', 'cols' => 8 
					),
				array( 
					'id' => 'group-1', 
					'name' => 'Group of Fields (repeatable)', 
					'type' => 'group', 
					'desc'	=> 'test',
					'style' => 'background: #f1f1f1; border-radius: 4px; border: 1px solid #e2e2e2; margin-bottom: 10px; padding: 10px', 
					'repeatable' => true, 
					'fields' => array(
						array( 
							'id' => 'input3-1', 
							'name' => 'Image', 
							'type' => 'file', 
							'cols' => 4, 
							'size' => 'width=200&height=120' 
						),
						array( 
							'id' => 'input33', 
							'name' => 'Color', 
							'type' => 'colorpicker'
						),
					) 
				)

			)
		);

    	return $meta_boxes;
    }

}  