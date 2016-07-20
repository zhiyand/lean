<?php get_header(); ?>

<?php get_sidebar(); ?>

	<div id="content">

        <?php if(have_posts()): while(have_posts()): the_post();
            get_template_part('content', 'post');
        endwhile; else: ?>
            <p>No posts found</p>
        <?php endif;?>

		<div class="pagination"><?php LeanTheme::paginavi();?></div>

	</div><!-- #content -->


<?php get_footer(); ?>
