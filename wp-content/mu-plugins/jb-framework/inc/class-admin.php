<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Framework;

if ($_SERVER['SCRIPT_FILENAME'] == __FILE__) {	// check for direct file access
	header('Location: /');						// redirect to website root
	die();										// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------

abstract class Admin {

    function __construct(){
        
    	// Framework specific actions
    	//----------------------------
    	add_action('wp_dashboard_setup', 			array($this, 'dashboard_widgets'));
    	add_action('wp_before_admin_bar_render', 	array($this, 'admin_bar')); 

    }

    //--------------------------------------------------------------------------
    // Remove annoying dashboard widgets
    //--------------------------------------------------------------------------
    public function dashboard_widgets(){
    	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
 		remove_meta_box('dashboard_primary', 'dashboard', 'side');
 		remove_meta_box('dashboard_secondary', 'dashboard', 'side');
 		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
 		remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    }

    //--------------------------------------------------------------------------
    // Remove annoying admin bar button
    //--------------------------------------------------------------------------
    public function admin_bar(){
    	global $wp_admin_bar;
    	$wp_admin_bar->remove_menu('about');
    	$wp_admin_bar->remove_menu('wporg');
    	$wp_admin_bar->remove_menu('documentation');
    	$wp_admin_bar->remove_menu('support-forums');
    	$wp_admin_bar->remove_menu('feedback');
    	$wp_admin_bar->remove_menu('comments');
    	$wp_admin_bar->remove_menu('updates');
    }

}  