<?php /* Template Name: Portfolio */ ?>

<?php get_header(); ?>

<div class="page-content">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content-page' );
	endwhile;

	rainy_filter();

	$portfolio_query = new WP_Query( array( 'post_type' => 'project', 'posts_per_page' => -1 ) );
	if ( $portfolio_query->have_posts() ) :
		echo '<div id="portfolio" class="portfolio-area">';
			while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
				get_template_part( 'content-portfolio' );
			endwhile;
			wp_reset_postdata();
		echo '</div>';
	else :
		get_template_part( 'content-none' );
	endif;
	?>
</div>

<?php get_footer(); ?>