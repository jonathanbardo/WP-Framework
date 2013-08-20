<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Theme;
use JB\Project\Update as Project_Update;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

class Update extends Project_Update {


	//--------------------------------------------------------------------------
	// Each time a new update function is added, 
	// increment this and comment out the previous functions in the loop
	//--------------------------------------------------------------------------
	const UPDATED_VERSION = 0;

	function __construct() {
		parent::__construct( self::UPDATED_VERSION );
		update_option( 'JB_THEME_DB_VERSION', self::UPDATED_VERSION );
	}

	public function update_1(){
		//Example function
		//----------------------------
	}

}