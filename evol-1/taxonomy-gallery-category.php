<?php get_header(); ?>

	<main id="main">
		<div class="inner">
			<div id="primary" role="main">
				<div id="gallery"><div class="gallery-inner clearfix"><?php
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					query_posts( array( 'post_type' => 'gallery', 'posts_per_page' => -1, 'gallery-category' => $term->slug ) );
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'content-gallery' );
					endwhile; endif; ?>
				</div></div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>