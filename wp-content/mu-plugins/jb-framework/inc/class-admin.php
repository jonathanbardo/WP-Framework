<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Framework;

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
abstract class Admin {

	function __construct(){
		
		// Framework specific actions
		//----------------------------
		add_action( 'wp_dashboard_setup', 			 array( $this, 'dashboard_widgets' ) );
		add_action( 'wp_before_admin_bar_render', 	 array( $this, 'admin_bar' ) ); 
		add_action( 'admin_bar_menu',                array( $this, 'admin_bar_menu' ), 80 );

		// Framework specific filters
		//----------------------------

	}

	//--------------------------------------------------------------------------
	// Remove annoying dashboard widgets
	//--------------------------------------------------------------------------
	public function dashboard_widgets(){
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	}

	//--------------------------------------------------------------------------
	// Remove annoying admin bar button
	//--------------------------------------------------------------------------
	public function admin_bar(){
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'about' );
		$wp_admin_bar->remove_menu( 'wporg' );
		$wp_admin_bar->remove_menu( 'documentation' );
		$wp_admin_bar->remove_menu( 'support-forums' );
		$wp_admin_bar->remove_menu( 'feedback' );
		$wp_admin_bar->remove_menu( 'comments' );
		$wp_admin_bar->remove_menu( 'updates' );
	}

	//--------------------------------------------------------------------------
	// Add button to admin bar 
	//--------------------------------------------------------------------------
	public function admin_bar_menu() {
		global $wp_admin_bar;

		//Add archive edit page link
		//----------------------------
		if ( is_archive() ) {
			if ( $page = get_page_by_path( get_option( 'tp1_base_' . get_post_type() ) ) ) 
				$wp_admin_bar->add_menu(
					array( 
						'id'    => 'tp1_edit_archive',
						'title' => __( 'Edit Page' ),
						'href'  => get_edit_post_link( $page->ID ),
					)
				);
		}

		if ( is_super_admin() && !is_admin() )
			$wp_admin_bar->add_menu(
				array(
					'parent' => 'site-name', // use 'false' for a root menu, or pass the ID of the parent menu
					'id'     => 'theme_settings', // link ID, defaults to a sanitized title value
					'title'  => __( 'Theme Settings', 'jb-project' ), // link title
					'href'   => admin_url( 'options-general.php?page=jb_settings' ), // name of file
					'meta'   => false, // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target   => '', title => '' );
				) 
			);

	}

}  