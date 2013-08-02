<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Metabox as Project_Metabox;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {    // check for direct file access
    header( 'Location: /' );                        // redirect to website root
    exit;                                         // kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Custom Metaboxes
//--------------------------------------------------------------------------
class Metabox extends Project_Metabox{

    function __construct() {
        parent::__construct();
    }

    //--------------------------------------------------------------------------
    // Create specific function for meta
    //--------------------------------------------------------------------------
    public function metaboxes( $meta_boxes = array() ) {
    	$meta_boxes = parent::metaboxes();

     //    $meta_boxes[] = array(
     //        'title' => 'test 3',
     //        'pages' => 'post',
     //        'context'    => 'normal',
     //        'priority'   => 'high',
     //        'show_names' => true, // Show field names on the left
     //        'fields' => array(
     //            array( 
     //                'id' => 'sdsdff', 
     //                'name' => 'A Normal text input', 
     //                'type' => 'datetime_unix', 
     //                'cols' => 12 
     //            )
     //        )
     //    );

        return $meta_boxes;
    }

}  