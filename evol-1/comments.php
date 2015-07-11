<?php if ( comments_open() ) : ?>
	<section id="comments">
		<?php if ( have_comments() ) : ?>
			<h3><?php comments_number(); ?></h3>
			<ol class="comment-list">
				<?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true, 'avatar_size' => 45 ) ); ?>
			</ol>
			
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<div id="pagination"><?php paginate_comments_links(); ?></div>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php comment_form(); ?>
	</section>
<?php endif; ?>