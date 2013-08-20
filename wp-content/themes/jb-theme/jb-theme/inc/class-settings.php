<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Settings as Project_Settings;

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
class Settings extends Project_Settings{

	function __construct() {
		parent::__construct();
	}

	//--------------------------------------------------------------------------
	// Settings API
	//--------------------------------------------------------------------------
	public function settings( $settings_fields = array() ) {

		$settings_fields = array();

		parent::settings( $settings_fields );
	}


}