<?php
//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

wp_redirect( get_bloginfo( 'url' ) . '/404/', 302 );
exit;