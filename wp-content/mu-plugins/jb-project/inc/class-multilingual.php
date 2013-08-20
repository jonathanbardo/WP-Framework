<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
namespace JB\Project;
use JB\Framework\Multilingual as Framework_Multilingual;

//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}

//--------------------------------------------------------------------------
//  Functions and definitions for: Handling multilingual / multisite in WordPress
//--------------------------------------------------------------------------
abstract class Multilingual extends Framework_Multilingual{

	function __construct() {
		parent::__construct();

		// Project specific action
		//----------------------------
		add_action( 'admin_head', array( $this, 'change_msls_flag' ) );

		//Theme specific filters
		//----------------------------
		add_filter( 'msls_blog_collection_construct',    array( $this, 'msls_blog_collection' ) );
		add_filter( 'msls_options_get_permalink',        array( $this, 'msls_options_get_permalink' ), 10, 2 );
	}

	//--------------------------------------------------------------------------
	// Override default plugin behavior on blog collection 
	//--------------------------------------------------------------------------
	// Plugin filter : multisite language switcher
	// The enable grouping of site inside a big multisite organization
	private function get_blog_collection() {
		$option = get_option( 'jb_multilingual_link', 'none' );

		if ( $option != 'none' )
			return array( get_option( 'jb_multilingual_link', 1 ), get_current_blog_id() );
		else
			return false;
	}

	public function msls_blog_collection( $arr ) {
		$arr = array();

		if ( $this->get_blog_collection() )
			foreach ( $this->get_blog_collection() as $id )
				$arr[$id] = get_blog_details( $id );

		return $arr;
	}

	//--------------------------------------------------------------------------
	// Override custom post type archive translation page
	//--------------------------------------------------------------------------
	public function msls_options_get_permalink( $url, $language ) {
		$post_type = get_post_type();

		$blogs = $this->get_blog_collection();

		if ( $blogs !== false )
			$url = str_replace( '/' . get_blog_option( $blogs[0], 'jb_base_'.$post_type ) . '/', '/' . get_blog_option( $blogs[1], 'jb_base_'.$post_type ).'/',  $url );

		if ( $url == '' )
			$url = home_url();

		return $url;
	}

	//--------------------------------------------------------------------------
	// Function that change the flags for language short tag
	//--------------------------------------------------------------------------
	public function change_msls_flag(){
		?>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$flag = $("th.column-mslscol img, #msls img");
					lang = ($flag.attr('alt') == "us") ? "EN":"FR";
					$flag.replaceWith("<span>"+lang+"</span>");
				});
			</script>
		<?php
	}

	//--------------------------------------------------------------------------
	// Load project text-domain
	//--------------------------------------------------------------------------
	public function textdomain() {
		parent::textdomain();
		load_theme_textdomain( 'jb-project', dirname( __FILE__ ) . '/languages' );
	}

}  