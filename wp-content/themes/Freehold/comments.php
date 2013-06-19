	<br>

	<div id="comments" class="content-boxed">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'progressionstudios' ); ?></p>
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



		<h2 id="comments-title" class="title-bg">
			<?php
				printf( _n( 'One comment', '%1$s comments', get_comments_number(), 'progressionstudios' ),
					number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
			?>
		</h2>

	<?php if ( have_comments() ) : ?>
		
	
		
		

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'progressionstudios' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'progressionstudios' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'progressionstudios' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use progressionstudios_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define progressionstudios_comment() and that will be used instead.
				 * See progressionstudios_comment()
				 */
				wp_list_comments( array( 'callback' => 'progressionstudios_comment' ) );
			?>
		</ol>
		<div class="clearfix"></div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'progressionstudios' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'progressionstudios' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'progressionstudios' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>
		



	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'progressionstudios' ); ?></p>
	<?php endif; ?>



<?php if ( comments_open() ) : ?>

<div id="respond" class="section">
	<div>
	<div class="title"><h2><?php comment_form_title(__('Leave A Comment', 'progressionstudios'), __('Leave A Comment', 'progressionstudios')); ?></h2></div>
	<div>

	<div><p class="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></p></div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="reply">

		<?php if ( is_user_logged_in() ) : ?>

		<p><?php _e('Logged in as', 'progressionstudios'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out &raquo;', 'progressionstudios'); ?></a></p>

		<div id="comment-textarea">
			
			<textarea name="comment" id="comment" placeholder="Enter Comment" cols="50" rows="10" tabindex="4" class="textarea-comment"></textarea>
		
		</div>
		
		<div id="comment-submit">
		
			<p><div class=""><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Post Comment', 'progressionstudios'); ?>" class="submit" /></div></p>
			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID); ?>
			
		</div>
		
		<?php else : ?>

		<div id="comment-input">

			<input type="text" name="author" id="author" value="" placeholder="<?php _e('Name','progressionstudios'); ?>*" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> class="input-name" />

		</div>

		<div>

			<input type="text" name="email" id="email" value="" placeholder="<?php _e('Email','progressionstudios'); ?>*" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> class="input-email"  />

		</div>

		<div>

			<input type="text" name="url" id="url" value="" placeholder="<?php _e('Website','progressionstudios'); ?>" size="22" tabindex="3" class="input-website" />
			
		</div>
		
		<div id="comment-textarea">
			
			<textarea name="comment" id="comment" placeholder="<?php _e('Enter Comment','progressionstudios'); ?>" cols="50" rows="10" tabindex="4" class="textarea-comment"></textarea>
		
		</div>
		
		<div id="comment-submit">
		
			<p><div><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Post Comment', 'progressionstudios'); ?>" class="submit" /></div></p>
			<?php comment_id_fields(); ?>
			<?php do_action('comment_form', $post->ID); ?>
			
		</div>

		<?php endif; ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	</div>
	</div>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>



</div><!-- #comments -->