<?php get_header(); ?>

<?php
$lean_logo = get_header_image();
    $lean_logo = $lean_logo
    ? ('<img src="'. esc_url($lean_logo). '" />' )
    : get_bloginfo('name');
?>

<div id="sidebar">
	<a id="logo" href="<?php echo esc_url(home_url());?>" title="<?php bloginfo('name');?>"><?php echo $lean_logo; ?></a>
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

	<div id="content">
<?php if(have_posts()): while(have_posts()): the_post(); 
	$nail = get_the_post_thumbnail( get_the_ID(), '-lean-full');?>
	

<div id="post-<?php the_ID();?>" <?php echo post_class();?>>
	<?php if($nail): ?>
<div id="thumbnail-<?php the_ID();?>" class="featured-image"><a href="<?php the_permalink();?>"><?php echo $nail; ?></a></div>
	<?php endif;?>
	<div class="heading">
		<div class="icon"></div>
		<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
		<div class="meta">
        <p class="byline"><?php the_author();?> published <a href="<?php the_permalink();?>"><?php echo _lean_time_ago();?></a> in <?php the_category(', ') ?>. 

<?php the_tags() ?>
	</p>
			<div class="comments-bubble"><?php
				if (empty($post->post_password)) {
					comments_popup_link(
					__('<i class="fa fa-comment-o"></i> 0'), 
					__('<i class="fa fa-comment-o"></i> 1'), 
					__('<i class="fa fa-comment-o"></i> %'), 
					'comments-link', 
					__(' ', 'lean') );
				}else{
					echo '<i class="fa fa-lock"></i>';
				}
				?>
				</div>
		</div>
	</div><!-- .heading -->
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
		<div class="pagination"><?php LeanTheme::paginavi();?></div>

	</div><!-- #content -->
	

<?php get_footer(); ?>
