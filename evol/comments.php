<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title"><?php _e( 'Join the conversation!', 'themerain' ); ?></h3>

		<ul class="comment-list">
			<?php wp_list_comments( array( 'avatar_size' => 45 ) ); ?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<span class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'themerain' ) ); ?></span>
				<span class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'themerain' ) ); ?></span>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'themerain' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>