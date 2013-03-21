<?php

//--------------------------------------------------------------------------
// Loader MU-Plugins
//--------------------------------------------------------------------------
if (!defined('WP_DEBUG'))
	define('WP_DEBUG', false);


define('MU_PLUGIN_DIR', dirname(__FILE__));

//--------------------------------------------------------------------------
// Debug
//--------------------------------------------------------------------------
if (WP_DEBUG):
	require_once('debug-bar/debug-bar.php'); // Debug Bar - http://wordpress.org/extend/plugins/debug-bar/
	require_once('debug-bar-extender/debug-bar-extender.php');
endif;

//--------------------------------------------------------------------------
// WordPress Plugins
//--------------------------------------------------------------------------
require_once('custom-metaboxes/custom-meta-boxes.php'); // Custom Metadata Plugin - https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress

//--------------------------------------------------------------------------
// Composer Required Libraries (See http://getcomposer.org/) | This is pure magic
//--------------------------------------------------------------------------
// require 'vendor/autoload.php';

//--------------------------------------------------------------------------
// JB Framework files
//--------------------------------------------------------------------------
require_once('jb-framework/jb-framework-init.php'); // JB Framework
require_once('jb-project/jb-project-init.php'); // JB Project
