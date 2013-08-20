<?php
//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Trigger the framwork
//--------------------------------------------------------------------------
// This is were it begins ...
if(!isset($JB_Theme_Init)){
	require_once('jb-theme/jb-theme-init.php');
	$JB_Theme_Init = new Jb\Theme\Init();
}
