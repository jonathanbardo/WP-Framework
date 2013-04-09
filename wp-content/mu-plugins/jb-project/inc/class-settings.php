<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Settings as Framework_Settings;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Settings Class
//--------------------------------------------------------------------------
abstract class Settings extends Framework_Settings {

	function __construct() {
		parent::__construct();
	}

	//--------------------------------------------------------------------------
	// Settings API
	//--------------------------------------------------------------------------
	public function settings($settings_fields = array()) {

		$project_settings_fields = array();

		parent::settings( $project_settings_fields + (array) $settings_fields );
	}


}