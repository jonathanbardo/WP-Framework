<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Framework;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}


//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Shortcodes
//--------------------------------------------------------------------------
// Introduced in WordPress 2.5 is the Shortcode API, a simple set of functions for creating macro codes for use in post content.
// See: http://codex.wordpress.org/Shortcode_API
//
//
abstract class Shortcodes {

	public static $shortcode_help = array();

	function __construct(){
		//Don't forget to add help text above if you add a shortcode to the framework
		add_shortcode( 'email', array( $this, 'shortcode_email' ) );
		Shortcodes::$shortcode_help[] = array(
			'title' 	=> '[email to="me@me.com"]',
			'content' 	=> 'Send email to someone and protect from spambot',
		);

		add_shortcode( 'search_query', array( $this, 'shortcode_search_query' ) );
		Shortcodes::$shortcode_help[] = array(
			'title' 	=> '[search_query]',
			'content' 	=> 'Display search query made by the user',
		);

		//We add a screen help tab for shortcode
		add_action( "load-{$GLOBALS['pagenow']}", array( $this, 'add_shortcode_help_tabs' ), 20 );

	}

	//Actual shortcode functions
	//----------------------------
	public function shortcode_email( $args ) {
		if ( empty( $args['to'] ) )
			$args['to'] = get_bloginfo( 'admin_email' );
		return '<a href="mailto:'.antispambot( $args['to'], 1 ).'">'.antispambot( $args['to'] ).'</a>';
	}

	public function shortcode_search_query( $atts ) {
		return get_search_query();
	}

	//Add help tab to display shortcode help
	//----------------------------
	public function add_shortcode_help_tabs(){
		get_current_screen()->add_help_tab(
			array(
				'id'       => 'jb_shortcode_help_tab',
				'title'    => __( 'Shortcodes', 'tp1' ),
				'content'  => __( '<p>Description of every shortcodes accessible in the current theme</p>', 'tp1' ),
				'callback' => array( $this, 'prepare_tab_help_content' ),
			)
		);
	}

	public function prepare_tab_help_content( $screen, $tab ){
		foreach ( self::$shortcode_help as $help ) {
			printf( '<p><strong>%s</strong> - %s</p>', $help['title'], __( $help['content'], 'tp1' ) );
		}
	}


}