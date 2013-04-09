<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Framework;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit();											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// JB WordPress Framework
//--------------------------------------------------------------------------
//
// 
//
//

abstract class Init {

	function __construct() {
		//--------------------------------------------------------------------------
		// Autoloading register
		//--------------------------------------------------------------------------
		spl_autoload_register( array($this,'autoload') );

		// Framework specific actions
		//----------------------------
		//...

		// Framework specific filters
		//----------------------------
		add_filter( 'the_generator', array($this,'remove_wp_version') );
	}


	//--------------------------------------------------------------------------
	// Autoloading function for framework classes
	//--------------------------------------------------------------------------
	public function autoload( $classes ) {
		$classes = explode( '\\', $classes );
		$class = str_replace( '_', '-',strtolower( end( $classes ) ) );

		if( isset($classes[0]) && $classes[0] == 'JB' )
			switch ( $classes[1] ) {
				case 'Framework' :
					require_once 'inc/class-' . $class . '.php';
				break;
				
				case 'Project' :
					require_once MU_PLUGIN_DIR.'/jb-project/inc/class-' . $class . '.php';
				break;

				case 'Theme' :
					require_once get_template_directory().'/jb-theme/inc/class-' . $class . '.php';
				break;

				case 'ChildTheme' :
					require_once get_stylesheet_directory().'/jb-theme/inc/class-' . $class . '.php';
				break;
			}
	}

	//--------------------------------------------------------------------------
	// We don't want to show wordpress version number in the rss feed
	//--------------------------------------------------------------------------
    public function remove_wp_version() {
        return '';
    }

}

