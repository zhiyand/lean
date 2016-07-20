<?php $nail = get_the_post_thumbnail( get_the_ID(), '-lean-full');?>

<div id="post-<?php the_ID();?>" <?php echo post_class();?>>
	<?php if($nail): ?>
        <div id="thumbnail-<?php the_ID();?>" class="featured-image">
            <?php if(is_page()): ?>
                <?php echo $nail; ?>
            <?php else: ?>
            <a href="<?php the_permalink();?>">
                <?php echo $nail; ?>
            </a>
            <?php endif;?>
        </div>
	<?php endif;?>
	<div class="heading" style="padding-bottom:0;">
		<div class="icon"></div>
		<h1 style="padding:10px 0"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
	</div><!-- .heading -->
	<div class="entry">
		<?php the_content();?>
	</div>
	<?php wp_link_pages( array(
		'before' => '<div class="pagination"><span>' . __( 'Pages:', 'slim' ) . '</span>',
		'after' => '</div>' ) ); ?>
</div>

<?php comments_template();?>
