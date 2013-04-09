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