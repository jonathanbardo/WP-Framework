<?php
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Intelligent replacement for var_dump & print_r
//--------------------------------------------------------------------------
function jb_dump( $code ) {
	?>

	<style>
		.jb_debug { word-wrap: break-word; white-space: pre; text-align: left; position: relative; background-color: rgba(0, 0, 0, 0.8); font-size: 11px; color: #ffffff; margin: 10px; padding: 10px; margin: 0 auto; width: 80%; overflow: auto;  -moz-border-radius: 5px; -webkit-border-radius: 5px; text-shadow: none; }
	</style>

	<br />

	<pre class="jb_debug">

	<?php

	// var_dump everything except arrays and objects
	if ( ! is_array( $code ) && ! is_object( $code ) ) 
		var_dump( $code );
	else 
		print_r( $code );

	echo '</pre><br>';

	return $code;

}

function jb_backtrace( $limit = 0 ) {

	$new = array();
	$backtrace = debug_backtrace();

	array_shift( $backtrace );

	foreach( $backtrace as $num => $val ) {

		if ( $val['function'] == 'do_action' )
			$new[$num] = reset( $val['args'] ) . ' (via do_action)';

		else
			$new[$num] = array( 'function' => $val['function'] );

		if ( ! empty( $val['line'] ) )
			$new[$num]['line'] = $val['line'];

		if ( ! empty( $val['file'] ) )
			$new[$num]['file'] = $val['file'];

		if ( !empty( $val['class'] ) )
			$new[$num]['class'] = $val['class'];

	}

	jb_dump( $new );

}

function jb_log( $code ) {
	// var_dump everything except arrays and objects
	if ( ! is_array( $code ) && ! is_object( $code ) )
		error_log( var_export( $code, true ) );
	else
		error_log( print_r( $code, true ) );

	return $code;
}