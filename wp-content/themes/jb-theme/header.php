<?php
//--------------------------------------------------------------------------
// Kill Script if direct file access
//--------------------------------------------------------------------------
if ( $_SERVER['SCRIPT_FILENAME'] == __FILE__ ) {
	header( 'Location: /' );
	exit;
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>	<html <?php language_attributes(); ?> class="no-js ie lte8 lte7 lte6 ie6"><![endif]-->
<!--[if IE 7]>		<html <?php language_attributes(); ?> class="no-js ie lte8 lte7 ie7"><![endif]-->
<!--[if IE 8]>		<html <?php language_attributes(); ?> class="no-js ie lte8 ie8"><![endif]-->
<!--[if IE 9]>		<html <?php language_attributes(); ?> class="no-js ie ie9"><![endif]-->
<!--[if gt IE 9]>	<html <?php language_attributes(); ?> class="no-js ie"><![endif]-->
<!--[if !(IE)]><!--><html <?php language_attributes(); ?> class="no-js no-ie"><!--<![endif]-->

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no" >

<title><?php wp_title(''); ?></title>

<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png">
<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/touch-favicon.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?php bloginfo('stylesheet_directory'); ?>/images/w8-metro-icon.png">


<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="wrapper" id="wrapper">