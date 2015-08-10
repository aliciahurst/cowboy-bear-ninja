<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<div class="page-content">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content-page' );
	endwhile;
	?>

	<div class="recent-projects-container">
	<div class="recent-projects">
		<div class="inner">
		<h2>Our Recent Work</h2>
			<?php
			$portfolio_query = new WP_Query( array( 'post_type' => 'project', 'posts_per_page' => 6 ) );
			if ( $portfolio_query->have_posts() ) :
				while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
					get_template_part( 'content-portfolio' );
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</div>
</div>

<?php get_footer(); ?>