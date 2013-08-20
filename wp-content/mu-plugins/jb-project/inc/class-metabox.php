<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Project;
use JB\Framework\Metabox as Framework_Metabox;

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
abstract class Metabox extends Framework_Metabox {

	function __construct() {
		parent::__construct();

		//Project Specific filter
		//----------------------------
		add_filter( 'cmb_show_on',      array( $this, 'add_for_id' ), 10, 2 );
		add_filter( 'cmb_show_on',      array( $this, 'add_for_page_template' ), 10, 2 );
	}

	//--------------------------------------------------------------------------
	// Create specific function for meta
	//--------------------------------------------------------------------------
	public function metaboxes( $meta_boxes = array() ){
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

	//--------------------------------------------------------------------------
	// Override core plugin filters by our own behavior
	//--------------------------------------------------------------------------
	// Add for ID
	public function add_for_id( $display, $meta_box ) {

		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : null;

		if ( ! $post_id ) 
			$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : null;

		if ( ! isset( $meta_box['show_on']['id'] ) )
			return $display;

		

		// If value isn't an array, turn it into one
		$meta_box['show_on']['id'] = ! is_array( $meta_box['show_on']['id'] ) ? array( $meta_box['show_on']['id'] ) : $meta_box['show_on']['id'];
		
		return in_array( $post_id, $meta_box['show_on']['id'] );

	}

	// Add for Page Template
	public function add_for_page_template( $display, $meta_box ) {
		
		$post_id = isset( $_GET['post'] ) ? $_GET['post'] : null;

		if ( ! $post_id ) 
			$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : null;

		if ( ! isset( $meta_box['show_on']['page-template'] ) )
			return $display;

		// Get current template
		$current_template = get_post_meta( $post_id, '_wp_page_template', true );

		// If value isn't an array, turn it into one
		$meta_box['show_on']['page-template'] = !is_array( $meta_box['show_on']['page-template'] ) ? array( $meta_box['show_on']['page-template'] ) : $meta_box['show_on']['page-template'];
		
		return in_array( $current_template, $meta_box['show_on']['page-template'] );

	}

}  