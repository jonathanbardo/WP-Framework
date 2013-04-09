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
abstract class Admin {

    function __construct(){
        
    	// Framework specific actions
    	//----------------------------
    	add_action('wp_dashboard_setup', 			array($this, 'dashboard_widgets'));
    	add_action('wp_before_admin_bar_render', 	array($this, 'admin_bar')); 
        add_action('admin_bar_menu',                array($this, 'add_archive_edit'), 80);

        // Framework specific filters
        //----------------------------

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

    //--------------------------------------------------------------------------
    // Add button to modify archive page
    //--------------------------------------------------------------------------
    public function add_archive_edit() {
        global $wp_admin_bar;

        if(is_archive())
            $page = get_page_by_path(get_option('jb_base_' . get_post_type()));
        else
            return;
        
        if($page) 
            $wp_admin_bar->add_menu(
                array( 
                    'id' => 'jb_edit_archive',
                    'title' => __('Edit Page'),
                    'href' => get_edit_post_link($page->ID)
                )
            );
    }

}  