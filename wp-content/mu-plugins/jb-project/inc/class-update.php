<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Project;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Settings Class
//--------------------------------------------------------------------------
abstract class Update {

	// each time a new update function is added, increment this and comment out the previous functions in the loop
	const SITE_UPDATED_VERSION = 1;


	function __construct( $BLOG_VERSION = 0 ) {
		if ( self::SITE_UPDATED_VERSION > (int) get_site_option( 'JB_PROJECT_DB_VERSION', 0 ) ) {
			// Call the update functions. Previous, run functions must be commented out.
		}

		update_site_option( 'JB_PROJECT_DB_VERSION', self::SITE_UPDATED_VERSION );

		//--------------------------------------------------------------------------
		// Blog options
		//--------------------------------------------------------------------------
		if ( $BLOG_VERSION > (int) get_option( 'JB_THEME_DB_VERSION', 0 ) ) {
			//--------------------------------------------------------------------------
			// Call the update functions. Previous, run functions must be commented out.
			//--------------------------------------------------------------------------
			$function_name = 'update_'.$BLOG_VERSION;
			$this->$function_name();
		}

	}

	private function update_1() {
		//Do something
		//----------------------------
	}

}