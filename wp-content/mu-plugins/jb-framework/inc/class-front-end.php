<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Framework;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {    // check for direct file access
    header( 'Location: /' );                        // redirect to website root
    exit();                                         // kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------
abstract class Front_End{

    function __construct(){
        //Framework specific actions
        //----------------------------
      	remove_action('wp_head', 'wp_generator'); // We usually do not want to show the WordPress version in the theme header...
      	
        //Framework specific filters 
        //----------------------------
      	add_filter('wp_nav_menu_items', 	array($this,'menu_items'), 10, 2);
      	add_filter('nav_menu_css_class', 	array($this,'menu_class_filter'));
      	add_filter('the_content', 			array($this,'strip_content_h1'));
      	add_filter('excerpt_length', 		array($this,'excerpt_length'));

      	// Set the featured thumbnail size to the values in /wp-admin/options-media.php
      	set_post_thumbnail_size(get_option('thumbnail_size_w'), get_option('thumbnail_size_h'), true);
    }

    //--------------------------------------------------------------------------
    // In some case, we need to manually apply the class current on links
    //--------------------------------------------------------------------------

    //Remove menu-item- class from li
    public function menu_class_filter($var) {
    	foreach ($var as $key => $value)
    		if(strpos($var[$key], '-item-') !== false || strpos($var[$key], '_item') !== false)
    			unset($var[$key]);
    
    	return $var;
    }


    // Manually apply the current class and strip other classes and IDs
    public function menu_items($items, $args) {

    	// strip id and class from li's because it's ugly...
    	$items = preg_replace('#<li id="([a-z0-9-_]+)"#i', '<li', $items); 
    	
    	// check the permalink sturcture	
    	$option = get_option('permalink_structure'); 
    	// if empty, permalink structure is disable which means there is no slug in the URL
    	if (empty($option)) 
    		return $items;
    	
    	// check if home, search or anything without a permalink
    	if (is_search() || $_SERVER['REQUEST_URI'] == '/') 
    		return $items;
    		
    	$url = $_SERVER['REQUEST_URI'];	
    	if(strpos($url, "?") !== false)
    		$url = substr($url, 0, strpos($url, "?"));	
    	// check first directory called in the url
    	$url = explode('/', $url); 	

    	global $blog_id;
    	
    	// if multisite and not main site and not subdomain install, check for what's after the second slash
    	if (!empty($url[2]) && is_multisite() && $blog_id != 1 && get_site_option('subdomain_install', 0) == false) 
    		$href = $url[2];
    	elseif (!empty($url[1]))
    		// otherwise check after the first slash
    		$href = $url[1]; 

    	if (!empty($href))
    		// apply class current if current url matches href
    		$items = preg_replace('#'.$href.'/"#', $href . '/" class="current"', $items); 

    	return $items;
    }
 
    //--------------------------------------------------------------------------
    // Set an exceprt length based on a setting in functions-wp-settings.php
    //--------------------------------------------------------------------------
    public function excerpt_length($length) {
    	return get_option('jb_limit_excerpt', 140);
    }

    //--------------------------------------------------------------------------
    // Strip <h1>'s from the_content(); because the <h1> should be the_title();
    //--------------------------------------------------------------------------
    public function strip_content_h1($content) {
    	$content = str_replace('<h1', '<h2', $content);
    	$content = str_replace('</h1>', '</h2>', $content);
    	return $content;
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


//--------------------------------------------------------------------------
// Custom walker for wp_list_categories 
//--------------------------------------------------------------------------
//
// Replace cat-item-ID with cat-SLUG
//
//
class JB_Walker_Categories extends \Walker_Category {

    public function start_el(&$output, $category, $depth, $args) {
        parent::start_el( $output, $category, $depth, $args );
        $find = 'cat-item-' . $category->term_id . '"';
        $replace = 'cat-' . $category->slug . '"';
        $output = str_replace( $find, $replace, $output );
    }

}