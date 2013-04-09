<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Front_End as Framework_Front_End;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit();											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------
abstract class Front_End extends Framework_Front_End {

	function __construct() {
		parent::__construct();
	}


	 //--------------------------------------------------------------------------
    // Because using a plugin is completely overkill and non-flexible…
    //--------------------------------------------------------------------------
    public static function pagination($pages = '', $range = 4) {
    	$showitems = ($range * 2)+1;  
    	global $paged;
    	if (empty($paged)) $paged = 1;
    	
    	if ($pages == '') {
    		global $wp_query;
    		$pages = $wp_query->max_num_pages;
    		if (!$pages) $pages = 1;
    	}   
    	
    	if ($pages != 1) {
    		echo '<ol class="pagination"><li class="page">'.sprintf(__('Page %1$s of %2$s','jb'), $paged, $pages).'</li>';
    		
    		if ($paged > 2 && $paged > $range+1 && $showitems < $pages)
    			echo '<li><a href="'.get_pagenum_link(1).'">&laquo; '.__('First','jb').'</a></li>';
    			
    		if ($paged > 1 && $showitems < $pages)
    			echo '<li><a href="'.get_pagenum_link($paged - 1).'">&lsaquo; '.__('Previous','jb').'</a></li>';
    		
    		for ($i=1; $i <= $pages; $i++) {
    			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
    				echo ($paged == $i)? '<li class="current">'.$i.'</li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
    		}
    		
    		if ($paged < $pages && $showitems < $pages)
    			echo '<li><a href="'.get_pagenum_link($paged + 1).'">'.__('Next','jb').' &rsaquo;</a></li>';
    			
    		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages)
    			echo '<li><a href="'.get_pagenum_link($pages).'">'.__('Last','jb').' &raquo;</a></li>';
    			
    		echo '</ol>';
    	}
    }

}