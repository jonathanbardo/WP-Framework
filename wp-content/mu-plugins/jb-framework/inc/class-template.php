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
//
// 
//
//

abstract class Template{

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
        $items = preg_replace('#<li id="([a-z0-9-_]+)"#i', '<li', $items); // strip id and class from li's because it's ugly...
                
        $option = get_option('permalink_structure'); // check the permalink sturcture
        if (empty($option)) // if empty, permalink structure is disable which means there is no slug in the URL
            return $items;
    
        if (is_search() || $_SERVER['REQUEST_URI'] == '/') // check if home, search or anything without a permalink
            return $items;
            
        $url = $_SERVER['REQUEST_URI']; 
        if(strpos($url, "?") !== false)
            $url = substr($url, 0, strpos($url, "?"));  

        $url = explode('/', trim($url, '/')); // check first directory called in the url

        global $blog_id;
        
        if(!empty($url[0]) && is_multisite() && $blog_id != 1 && get_site_option('subdomain_install', 0) == false)
            unset($url[0]);

        if (!empty($url)){
            $url = array_reverse($url);
            foreach ($url as $key => $href){
                $class = ($key==0) ? 'current':'current current-ancestor';
                $items = preg_replace('#'.$href.'/"#', $href . '/" class="'.$class.'"', $items); // apply class current if current url matches href
            }
        }

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
    // Trims text to a space then adds ellipses if desired
    //--------------------------------------------------------------------------
    //
    // @param string $input text to trim
    // @param int $length in characters to trim to
    // @param bool $ellipses if ellipses (...) are to be added
    // @param bool $strip_html if html tags are to be stripped
    // @return string
    //
    public static function trim_text($input, $length, $ellipses = true, $strip_html = true) {
     
        //strip tags, if desired
        if ($strip_html)
            $input = strip_tags($input);
     
        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length)
            return $input;
     
        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);
     
        //add ellipses (...)
        if ($ellipses)
            $trimmed_text .= '...';
     
        return $trimmed_text;
     
    }

    //--------------------------------------------------------------------------
    // Isset helper (echo the var only if isset)
    //--------------------------------------------------------------------------
    public static function e_isset(&$check, $alternate = false){
        echo ( ! empty($check) ) ? $check : $alternate; 
    }
    public static function r_isset(&$check, $alternate = false){
        return ( ! empty($check) ) ? $check : $alternate; 
    }
    public static function wrap_isset(&$check, $opentag = '<p>', $closingtag = '</p>') {
        if( ! empty($check) )
            echo $opentag.$check.$closingtag;
        else
            return; 
    }
    public static function link_wrap_isset(&$check, $insidetext = "", $opentag = '', $closingtag = '', $classes='', $id='') {
        if( ! empty($check) )
            echo $opentag.'<a href="'.$check.'" id="'.$id.'" class="'.$classes.'">'.$insidetext.'</a>'.$closingtag;
        else
            return; 
    }
    //--------------------------------------------------------------------------
    // Template content helper
    //--------------------------------------------------------------------------
    public static function e_content(&$content, $opentag = '', $closingtag = '') {
        if(!empty($content))
            echo $opentag.apply_filters('the_content', $content).$closingtag;
        else
            return;
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