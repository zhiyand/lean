<?php get_header(); ?>

	<div id="content">
<?php if(have_posts()): while(have_posts()): the_post(); 
	$nail = get_the_post_thumbnail( get_the_ID(), '-lean-full');?>
	<?php if($nail): ?>
<div id="thumbnail-<?php the_ID();?>" class="featured-image"><a href="<?php the_permalink();?>"><?php echo $nail; ?></a></div>
	<?php endif;?>

<div id="post-<?php the_ID();?>" <?php echo post_class();?>>
	<div class="icon"></div>
	<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
	<div class="entry">
		<?php the_content();?>
	</div>
	<?php wp_link_pages( array( 
		'before' => '<div class="pagination"><span>' . __( 'Pages:', 'slim' ) . '</span>',
		'after' => '</div>' ) ); ?>
</div>

<?php comments_template();?>

<?php endwhile; else: ?>
	<p>No posts found</p>
<?php endif;?>
		<div class="pagination"><?php _lean_paginavi();?></div>

	</div><!-- #content -->
	
	<div id="sidebar">
		<a id="logo" href="<?php bloginfo('url');?>" title="<?php bloginfo('name');?>"><img src="<?php bloginfo('template_url');?>/static/img/logo.png" /></a>
		<?php

		$defaults = array(
			'theme_location'  => 'Main',
			'container'       => false,
			'menu_class'      => 'menu nav',
			'menu_id'         => 'menu-main',
			'walker'          => new MainNavWalker(),
			'fallback_cb'     => '',
		);

		wp_nav_menu( $defaults );

		?>
		<div class="box">
			<?php dynamic_sidebar('sidebar-home')?>
		</div><!-- .box -->
	</div><!-- #sidebar -->
	

<?php get_footer(); ?>
