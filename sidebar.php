<?php
$lean_logo = get_header_image();
$lean_logo_style = $lean_logo ? '' : 'style="line-height:80px;"';
$lean_logo = $lean_logo
? ('<img src="'. esc_url($lean_logo). '" />' )
: get_bloginfo('name');
?>

<div id="sidebar">
    <a id="logo" href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('name');?>" <?php echo $lean_logo_style ?>><?php echo $lean_logo; ?></a>
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
	<div class="box">
		<?php dynamic_sidebar('sidebar-home')?>
	</div><!-- .box -->
</div><!-- #sidebar -->

