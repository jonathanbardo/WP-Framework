<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Metabox as Framework_Metabox;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {    // check for direct file access
    header( 'Location: /' );                        // redirect to website root
    exit();                                         // kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Custom Metaboxes
//--------------------------------------------------------------------------
abstract class Metabox extends Framework_Metabox {

    function __construct() {
        parent::__construct();
    }

    //--------------------------------------------------------------------------
    // Create specific function for meta
    //--------------------------------------------------------------------------
    public function metaboxes( array $meta_boxes = array() ){
        $meta_boxes = parent::metaboxes();

        // $meta_boxes[] = array(
        //     'title' => 'test2',
        //     'pages' => array('post'), // post type
        //     'context'    => 'normal', //  'normal', 'advanced', or 'side'
        //     'show_on' => array( 'key' => 'id', 'value' => array( 50, 24 ) ),
        //     'priority'   => 'high', //  'high', 'core', 'default' or 'low'
        //     'show_names' => true, // Show field names on the left
        //     'fields' => array(
        //         array( 
        //             'id' => 'inpasdasdut', 
        //             'name' => 'A Normal text input', 
        //             'type' => 'datetime_unix', 
        //             'cols' => 12 
        //         )
        //     )
        // );

        return $meta_boxes;
    }

}  