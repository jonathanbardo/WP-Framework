<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Settings as Framework_Settings;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit;											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Settings Class
//--------------------------------------------------------------------------
abstract class Settings extends Framework_Settings {

	function __construct() {
		parent::__construct();
	}

	//--------------------------------------------------------------------------
	// Settings API
	//--------------------------------------------------------------------------
	public function settings( array $settings_fields = array() ) {

		$project_settings_fields = array(
			array(
				'id' 					=> 'jb_multilingual_link',
				'title'					=> __('Multilingual Association', 'jb'), 
				'section'				=> 'jb_multilingual',
				'callback'				=> array($this,'select_multilingual_render'),
				'args'					=> array('id'=>'jb_multilingual_link'),
				'sanitize_reg_callback' => array($this,'sanitize_select_multilingual'),
			),
		);

		parent::settings( array_merge($project_settings_fields,$settings_fields) );

		add_settings_section('jb_multilingual', __('Multilingual settings', 'jb-project'), '', 'jb_settings');
	}


	public function select_multilingual_render($args) {
		global $wpdb;
		$current_blog = get_current_blog_id();

		echo '<select name="'.$args['id'].'">';

		$blogs = $wpdb->get_results("
		    SELECT blog_id
		    FROM {$wpdb->blogs}
		    WHERE site_id = '{$wpdb->siteid}'
		    AND spam = '0'
		    AND deleted = '0'
		    AND archived = '0'
		    AND blog_id != {$current_blog}
		");

		$sites = array();
		foreach ($blogs as $blog) {
		    $sites[$blog->blog_id] = get_blog_option($blog->blog_id, 'blogname');
		}

		$sites = array('none'=>'None') + $sites;
		foreach ($sites as $blog_id => $blog_title) {
			$selected = (get_option($args['id']) == $blog_id) ? 'selected':'';
		    echo '<option value="'.$blog_id.'" '.$selected.'>'.$blog_title.'</option>';
		}
		echo '</select>';
	}

	public function sanitize_select_multilingual($input){
		if($input != 'none' && !isset($GLOBALS['jb_multilingual_link'])){
			$current_blog = get_current_blog_id();
			$linked_blog = intval($input);
			//Prevent recursion while update cross site option
			$GLOBALS['jb_multilingual_link'] = true;
			if($current_blog != $linked_blog)
				if(get_blog_option($linked_blog, 'jb_multilingual_link') == 'none')
					update_blog_option($linked_blog, 'jb_multilingual_link', $current_blog);
		}

		return $input;
	}

}