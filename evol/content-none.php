<article id="post-0">
	<p>
		<?php
		if ( is_search() ) {
			_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'themerain' );
		} elseif ( is_404() ) {
			_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'themerain' );
		} else {
			_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'themerain' );
		}
		?>
	</p>
	<?php get_search_form(); ?>
</article>