<?php
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}
//--------------------------------------------------------------------------
// We call the archive page for the standard post content type
//--------------------------------------------------------------------------
get_template_part('archive');