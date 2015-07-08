<article id="post-0">
	<div class="one-half">
	<h6>Not Found</h6>
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
	</div>
	<div class="one-half last">
	<h6> Search </h6>
	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
        <input type="text" value="" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="Search" />
</form>
</div>

</article>