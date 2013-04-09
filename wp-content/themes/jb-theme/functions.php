<?php
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Trigger the framwork
//--------------------------------------------------------------------------
// This is were it begins ...
// 
//
//


if(!isset($JB_Theme_Init)){
	require_once('jb-theme/jb-theme-init.php');
	$JB_Theme_Init = new Jb\Theme\Init();
}
