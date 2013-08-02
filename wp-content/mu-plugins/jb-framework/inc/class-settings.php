<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Framework;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit();											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Settings Class
//--------------------------------------------------------------------------
//
// 
//
//

abstract class Settings {

	function __construct() {
		//Framwork specific actions
		//----------------------------
		add_action( 'admin_init', 								array($this,'settings') );
		add_action( 'admin_menu', 								array($this,'admin_add_page') );

		//Framework specific filters
		//----------------------------
		add_filter( 'pre_update_option_category_base',			array($this,'base_options_permalink'), 1 );
		add_filter( 'pre_update_option_tag_base',				array($this,'base_options_permalink'), 1 );
		add_filter( 'pre_update_option_permalink_structure',	array($this,'base_options_permalink'), 1 );
		add_filter( 'init', 									array($this,'rewrites') );
	}

	//--------------------------------------------------------------------------
	// Remove the /blog in the permalink structure
	//--------------------------------------------------------------------------
	public function base_options_permalink($permalink) {
		$permalink = preg_replace("/^\/blog\//","/",$permalink);
		return $permalink;
	}

	//--------------------------------------------------------------------------
	// Change the author rewrite rule | specify our own base for author archives
	//--------------------------------------------------------------------------
	public function rewrites() {
		global $wp_rewrite;
		$wp_rewrite->author_base = get_option( 'jb_base_author', 'author' );
	}

	//--------------------------------------------------------------------------
	// Settings API
	//--------------------------------------------------------------------------
	// We create a settings page where all those options are regroup
	public function settings( $settings_fields = array() ) {
		//--------------------------------------------------------------------------
		// Why Permalink rewrite here ? We cannot put them on the permalink page
		//--------------------------------------------------------------------------
		// see : http://core.trac.wordpress.org/ticket/9296
		add_settings_section( 'jb_general', __('General', 'jb'), '', 'jb_settings' );
		add_settings_section( 'jb_wp_permalinks', __('Advanced permalinks', 'jb'), '', 'jb_settings' );

		//See http://codex.wordpress.org/Function_Reference/add_settings_field
		$framework_settings_fields = array(
			array(
				'id' 								=> 'jb_limit_excerpt',
				'title'								=> __('Excerpt length', 'jb'), 
				'args'								=> array('default'=>'140'),
				'sanitize_reg_callback' 			=> 'intval',
				'section'							=> 'jb_general',
			),
			array(
				'id' 								=> 'jb_base_404',
				'title'								=> __('404 Error base', 'jb').$this->get_edit_link_by_slug('jb_base_404'), 
				'args'								=> array('default'=>'error-404'),
				'sanitize_reg_callback' 			=> array($this,'validate_permalink')
			),
			array(
				'id' 								=> 'jb_base_author',
				'title'								=> __('Author base', 'jb'), 
				'args'								=> array('default'=>'author'),
			)
		);
		
		//We simplify the settings section
		$this->construct_settings_fields( array_merge($framework_settings_fields, $settings_fields) );

	}

	private function construct_settings_fields( array $settings_fields ) {
		foreach ($settings_fields as $field):
			$defaults = array(
				'callback'				=> array($this,'option_form_render'),
				'page'					=> 'jb_settings',
				'section'				=> 'jb_wp_permalinks',
				'sanitize_reg_callback' => 'sanitize_text_field',
				'args'					=> array('default' => '')
			);

			$field = wp_parse_args( $field, $defaults );
			//Parsing arguments
			$field['title'] = '<label for="'.$field['id'].'">'.$field['title'].'</label>';
			$field['args']['id'] = $field['id'];

			add_settings_field(
				$field['id'],
				$field['title'],
				$field['callback'],
				$field['page'],
				$field['section'],
				$field['args']
			);
			register_setting($field['page'], $field['id'], $field['sanitize_reg_callback']);
		endforeach;
	}

	public function option_form_render( $args ) {
		echo '<input name="'.$args['id'].'" id="'.$args['id'].'" type="text" value="' . get_option($args['id'], $args['default']) . '" class="regular-text" />';
	}

	//--------------------------------------------------------------------------
	// Validate archive base slug
	//--------------------------------------------------------------------------
	public function validate_permalink($input){
    $input = sanitize_text_field($input);
    $option_key = array_search($input, $_POST);
    $option_value = get_option($option_key);

    if($input === $option_value || $option_value === false)
      return $input;

    if($option_key !== false && $input !== ''){
        $page = get_page_by_path($option_value, OBJECT, 'page');
        $post_name = basename($input);
        $title = sanitize_title($input);
        if($page && isset($page->post_status) && $page->post_status != 'auto-draft'){
            $page = array(
              'ID' => $page->ID,
              'post_name' => $post_name
            );

            $page_id = @wp_update_post($page, false);
        }else{
          $page = array(
            'post_title'            => $title,
            'post_status'           => 'publish', 
            'post_type'             => 'page',
            'post_name'             => $post_name,
            'post_parent'           => 0,
          );

          $page_id = @wp_insert_post($page, false);
        }

        if(isset($page_id) && $page_id !== false){
          $page = get_post($page_id, OBJECT);
          return str_replace($post_name, $page->post_name, $input);
        }
    }

    return $input;
  }


  protected function get_edit_link_by_slug($slug=''){
    $option = get_option($slug);
    if($slug === '' || $option === '')
      return;

    $page_id = Post::get_page_id_by_slug($option);
    if($page_id)
      return '<br><a href="'.get_edit_post_link($page_id).'" style="font-size:smaller;margin-top:0px;">'.__('Edit page').'</a>';
    else
      return '<br><p style="color:#bc0b0b;font-size:smaller;margin-top:0px;">'.__("No page found by slug", "jb").'</p>';
  }

	//--------------------------------------------------------------------------
	// Add Theme Settings page
	//--------------------------------------------------------------------------
	public function admin_add_page() {
		add_options_page( __( 'Theme Settings', 'jb' ), __( 'Theme Settings', 'jb' ), 'manage_options', 'jb_settings', array($this,'options_page') );
	}

	public function options_page() {
		if( isset($_GET['settings-updated'] ) && $_GET['settings-updated'] && isset( $_GET['page'] ) && $_GET['page'] == 'jb_settings' )
				flush_rewrite_rules();
		?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br></div>
			<h2><?php _e('Theme Settings', 'jb'); ?></h2>
			<form class="clear" action="options.php" method="post">
				<?php settings_fields('jb_settings'); ?>
				<?php do_settings_sections('jb_settings'); ?>
			 
				<p class="submit">
					<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
				</p>
			</form>
		</div>
		<?php
	}


}