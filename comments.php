	<?php if ( post_password_required() ) : ?>
	<div id="comments">
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'firetuts' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
	<div id="comments">
		<h3>
			<?php
				printf( _n( 'One comment on: %2$s', '%1$s comments on: %2$s', get_comments_number(), 'lean' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comments-nav">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lean' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lean' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use firetuts_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define firetuts_comment() and that will be used instead.
				 * See firetuts_comment() in firetuts/functions.php for more.
				 */
				global $_lean_theme;
				wp_list_comments( array( 'callback' => 'LeanTheme::comment') );
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comments-nav">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lean' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lean' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

	</div><!-- #comments -->
	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<div id="comments">
		<p class="nocomments"><?php _e( 'Comments are closed.', 'lean' ); ?></p>
	</div><!-- #comments -->
	<?php elseif ( ! is_page() ):?>
	<div id="comments">
		<p class="nocomments"><?php _e( 'This post has no comments. Be the first to leave one!', 'lean' ); ?></p>
	</div><!-- #comments -->
	<?php endif; ?>

<div id="comment-form">
	<?php comment_form(array(
		'title_reply' => '<i class="fa fa-comments"></i> Join the discussion',
		'comment_notes_after' => '<div class="field"><div class="notes-after"><p><small>NOTE - You can use these HTML tags and attributes:</small></p>
		<code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></div></div>',
		'comment_notes_after' => '',
	)); ?>
</div> <!-- #comment-form -->
