<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Project;
use JB\Framework\Template as Framework_Template;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------
abstract class Template extends Framework_Template {

	function __construct() {
		parent::__construct();
	}


	//--------------------------------------------------------------------------
	// Because using a plugin is completely overkill and non-flexible…
	//--------------------------------------------------------------------------
	public static function pagination( $pages = '', $range = 4 ) {
		global $paged;

		$showitems = ( $range * 2 ) + 1;  
		if ( empty( $paged ) ) $paged = 1;
		
		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( !$pages ) $pages = 1;
		}   
		
		if ( $pages != 1 ) {
			echo '<ol class="pagination"><li class="page">'.sprintf( __( 'Page %1$s of %2$s','jb' ), $paged, $pages ).'</li>';
			
			if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages )
				echo '<li><a href="'.get_pagenum_link( 1 ).'">&laquo; '.__( 'First','jb' ).'</a></li>';
				
			if ( $paged > 1 && $showitems < $pages )
				echo '<li><a href="'.get_pagenum_link( $paged - 1 ).'">&lsaquo; '.__( 'Previous','jb' ).'</a></li>';
			
			for ( $i = 1; $i <= $pages; $i++ ) {
				if (1 != $pages &&( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) )
					if ( $paged == $i )
						echo '<li class="current">'.$i.'</li>';
					else
						echo '<li><a href="'.get_pagenum_link( $i ).'">'.$i.'</a></li>';
			}
			
			if ( $paged < $pages && $showitems < $pages )
				echo '<li><a href="'.get_pagenum_link( $paged + 1 ).'">'.__( 'Next','jb' ).' &rsaquo;</a></li>';
				
			if ( $paged < $pages - 1 &&  $paged + $range - 1 < $pages && $showitems < $pages )
				echo '<li><a href="'.get_pagenum_link( $pages ).'">'.__( 'Last','jb' ).' &raquo;</a></li>';
				
			echo '</ol>';
		}
	}

}