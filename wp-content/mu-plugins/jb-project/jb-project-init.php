<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Project;
use JB\Framework\Init as Framework_Init;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// JB WordPress project
//--------------------------------------------------------------------------
// This is were we include project specific function
abstract class Init extends Framework_Init {

	function __construct() {
		parent::__construct();

		//Instanciate every class needed
		//----------------------------
		$jb_post_type    = new \JB\Theme\Post_Types;
		$jb_multilingual = new \JB\Theme\Multilingual;
		$jb_admin        = new \JB\Theme\Admin;
		$jb_template     = new \JB\Theme\Template;
		$jb_metabox      = new \JB\Theme\Metabox;
		$jb_settings     = new \JB\Theme\Settings;
		$jb_widgets      = new \JB\Theme\Widgets;
		$jb_users        = new \JB\Theme\Users;
		$jb_update       = new \JB\Theme\Update;
		$jb_social       = new \JB\Theme\Social;
		$jb_shortcodes   = new \JB\Theme\Shortcodes;
		$jb_post         = new \JB\Theme\Post;

		// Framework specific actions
		//----------------------------
		add_action( 'wp_enqueue_script', array( $this, 'scripts' ) );

		if ( is_admin() ) add_editor_style( 'style-editor.css' );

		// Framework specific filters
		//----------------------------
		//...
	}

	//--------------------------------------------------------------------------
	// Scripts : We load the latest version of jQuery via Google
	//--------------------------------------------------------------------------
	public function scripts() {
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', false, '1.9.1', false );
	}

}