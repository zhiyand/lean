<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<?php $theme_url = get_template_directory_uri();?>

	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>


<div id="mobile-nav">
	<?php

	$defaults = array(
		'theme_location'  => 'Main',
		'container'       => false,
		'menu_class'      => 'menu nav menu-main',
		'menu_id'         => 'menu-main',
		'walker'          => new LeanMainNavWalker(),
		'fallback_cb'     => '',
	);

	wp_nav_menu( $defaults );

	?>
</div>

<div id="wrap">
	<div id="main">
        <div id="branding">
            <button id="btn-mobile-menu-toggle"></button>
            <a href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('name');?>"><img src="<?php echo esc_url(get_header_image()); ?>" style="height:45px;"></a>
        </div>
