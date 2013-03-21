<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Theme;
use JB\Project\Settings as Project_Settings;

if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {	// check for direct file access
	header('Location: /');						// redirect to website root
	die();										// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Settings Class
//--------------------------------------------------------------------------
class Settings extends Project_Settings{

	function __construct(){
		parent::__construct();
	}

	//--------------------------------------------------------------------------
	// Settings API
	//--------------------------------------------------------------------------
	public function settings() {

		$settings_fields = array();

		parent::settings((array) $settings_fields);
	}


}