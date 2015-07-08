<?php get_header(); ?>

	<main id="main">
		<div class="inner">
			<div id="primary" role="main"><?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content-gallery' );
				endwhile; endif; ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>