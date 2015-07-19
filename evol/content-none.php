<article id="post-0">

	<?php
	if ( is_home() ) :

		echo 'Ready to publish your first post? <a href="' . esc_url( admin_url( 'post-new.php' ) ) . '">Get started here</a>.';

	elseif ( is_page_template( 'template-portfolio.php' ) ) :

		echo 'Ready to publish your first project? <a href="' . esc_url( admin_url( 'post-new.php?post_type=project' ) ) . '">Get started here</a>.';

	elseif ( is_search() ) :

		_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'themerain' );
		get_search_form();

	elseif ( is_404() ) :

		_e( 'It looks like nothing was found at this location. Maybe try a search?', 'themerain' );
		get_search_form();

	else :

		_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'themerain' );
		get_search_form();

	endif;
	?>

</article>