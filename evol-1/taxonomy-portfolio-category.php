<?php get_header(); ?>

	<main id="main">
		<div class="inner">
			<div id="primary" role="main">
				<div id="portfolio"><div class="portfolio-inner clearfix"><?php
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					query_posts( array( 'post_type' => 'portfolio', 'posts_per_page' => -1, 'portfolio-category' => $term->slug ) );
					if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'content-portfolio' );
					endwhile; endif; ?>
				</div></div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>