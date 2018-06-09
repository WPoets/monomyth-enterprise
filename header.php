<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<?php // Google Chrome Frame for IE ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png">
	<?php
	if(aw2_library::get('site_settings.opt-favicon.exists')){?>
	<link rel="icon" href="<?php
		echo aw2_library::get('site_settings.opt-favicon');
	 ?>"> 
	<?php
	}
	if(aw2_library::get('site_settings.opt-favicon.exists')){
		?>
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php
		echo aw2_library::get('site_settings.opt-favicon');
	 ?>">	
	<?php 	
	}
	?>
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
	<meta name="msapplication-TileColor" content="#f01d4f">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php 
	
	wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="background_ovelay"></div>
<?php
/* if(isset($GLOBALS['aw2_header']))
	$local_header=$GLOBALS['aw2_header'];
else
	$local_header='header';

aw2_library::get_post_from_slug($local_header,'aw2_core',$module_post);	
echo aw2_library::parse_shortcode($module_post->post_content); */

/* $awesome_core=&aw2_library::get_array_ref('awesome_core');

$app=&aw2_library::get_array_ref('app');
if(isset($app['configs']['header'])){
	$header = $app['configs']['header'];
	echo aw2_library::parse_shortcode($header['code']);
}
else if(isset($awesome_core['header'])){
	echo aw2_library::parse_shortcode($awesome_core['header']['code']);
	if(isset($slug)){
		unset($awesome_core[$slug]); // now we don't need this data
	}
}
 */
$app=&aw2_library::get_array_ref('app');

if(isset($app['collection']['config']) && aw2_library::get_module($app['collection']['config'],'header',true)){
	echo aw2_library::module_run($app['collection']['config'],'header');
}	
else if(aw2_library::get_module(['service'=>'core'],'header',true)){
	echo aw2_library::module_run(['service'=>'core'],'header');
}