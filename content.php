<?php $nail = get_the_post_thumbnail( get_the_ID(), '-lean-full');?>

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
