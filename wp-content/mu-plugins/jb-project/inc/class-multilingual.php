<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Multilingual as Framework_Multilingual;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
//  Functions and definitions for: Handling multilingual / multisite in WordPress
//--------------------------------------------------------------------------
class Multilingual extends Framework_Multilingual{

    function __construct() {
        parent::__construct();

        // Project specific action
		//----------------------------
		// add_action('admin_head',    array($this,'change_msls_flag'));

        //Theme specific filters
        //----------------------------
    }

    //--------------------------------------------------------------------------
	// Load project text-domain
	//--------------------------------------------------------------------------
	public function textdomain() {
		parent::textdomain();
		load_theme_textdomain('jb-project', dirname(__FILE__) . '/languages');
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

}  