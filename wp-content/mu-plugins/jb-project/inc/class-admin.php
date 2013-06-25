<?php
//--------------------------------------------------------------------------
// Namespace
//--------------------------------------------------------------------------
Namespace JB\Project;
use JB\Framework\Admin as Framework_Admin;

if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {	// check for direct file access
	header( 'Location: /' );						// redirect to website root
	exit();											// kill the page if the redirection fails
}

//--------------------------------------------------------------------------
// Functions and definitions for: WordPress Administration
//--------------------------------------------------------------------------
abstract class Admin extends Framework_Admin {

    function __construct() {
        parent::__construct();

        //Tmce init
        //----------------------------
        add_filter('tiny_mce_before_init', array($this, 'add_style_format_tinymce'));

        //Custom tmce plugin 
        //----------------------------
        if (get_user_option('rich_editing') == 'true'){
            add_filter('mce_external_plugins',  array($this, 'register_tmce_plugin'));
            add_filter('mce_buttons',           array($this, 'register_tmce_button'));
            add_action('admin_footer',          array($this, 'tmce_chart'));
        }
    }


    public function add_style_format_tinymce($init) {
        $init['theme_advanced_buttons2_add_before'] = 'styleselect';
        //See http://www.tinymce.com/wiki.php/Configuration:formats
        $style_formats = array(  
            array(  
                'title' => 'Bouton lien',  
                'selector' => 'a',  
                'inline' => 'a', 
                'classes' => 'btn-link',  
            )
        );
        $init['style_formats'] = json_encode($style_formats); 

        $init['theme_advanced_blockformats'] = 'p,h2,h3,h4,h5,h6,address';

        return $init;
    }

    //--------------------------------------------------------------------------
    // Tmce Plugins
    //--------------------------------------------------------------------------
    //initialize tmce plugin
    public function register_tmce_button($buttons){
        // array_push($buttons, 'separator', 'jb_tmce_expand_collapse', 'jb_tmce_chart');
        $buttons['theme_advanced_disable'] = 'justify';
        return $buttons;
    }
    
    public function register_tmce_plugin($plugin_array){
        $plugin_array['jb_tmce_plugins'] = WPMU_PLUGIN_URL.'/jb-project/js/jb-tmce-plugins.js';
        return $plugin_array;
    }

    public function tmce_chart(){
        ?>
        <style type="text/css">
            #jb_tmce_chart {padding:20px;}
            #jb_tmce_chart fieldset{padding-bottom:10px;}
            #jb_tmce_chart .button-delete{color:#f00;border-bottom-color: #f00; float:right;}
            #jb_tmce_add_chart {border-bottom:1px solid #dfdfdf; margin-bottom: 10px; padding-bottom: 10px;}
        </style>
        <form id="jb_tmce_chart" class="ui-dialog-content ui-widget-content" style="display:none;">
            <div id="jb_tmce_add_chart">
                <p class="howto">N'oublié pas de présélectionné votre tableau de données dans l'éditeur.</p>
                <fieldset>
                    <label for="graphic_type">Type de Graphique :</label>
                    <select name="graphic_type">
                        <option value="pie">Pointes de tarte</option>
                        <option value="column">Diagramme à bandes</option>
                        <option value="line">Diagramme à lignes</option>
                    </select>
                </fieldset>
                <fieldset>
                    <label for="legend">Ajouter une légende au graphique ?</label>
                    <select name="legend">
                        <option value="non">Non</option>
                        <option value="oui">Oui</option>
                    </select>
                </fieldset>
                <input type="button" value="Ajouter le graphique" class="button-primary" name="jb_tmce_chart_submit" onclick="javascript:tinyMCE.activeEditor.plugins.jb_tmce_plugins.parseChart(this.form);">
            </div>
            <div>
                <input type="button" value="Mettre la cellule en valeur" class="button-secondary" name="jb_tmce_chart_submit" onclick="javascript:tinyMCE.activeEditor.plugins.jb_tmce_plugins.putCellFront();">
            </div>
            <div>
                <input type="button" value="Cacher la ligne au chargement" class="button-secondary" name="jb_tmce_chart_submit" onclick="javascript:tinyMCE.activeEditor.plugins.jb_tmce_plugins.hideColumnLoad();">
            </div>
        </form>
        <?php 
    }

}  