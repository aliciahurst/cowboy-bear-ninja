<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<div class="page-content">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content-page' );
	endwhile;
	?>

	<div class="recent-projects">
		<div class="inner">
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

	<div class="recent-posts">
		<div class="inner">
			<div class="recent-posts-left">
				<?php
				$left_post_query = new WP_Query( array( 'post_type' => 'post', 'ignore_sticky_posts' => 1, 'posts_per_page' => 1 ) );
				while ( $left_post_query->have_posts() ) : $left_post_query->the_post();
					get_template_part( 'content' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>

			<div class="recent-posts-right">
				<?php
				$right_post_query = new WP_Query( array( 'post_type' => 'post', 'ignore_sticky_posts' => 1, 'offset' => 1, 'posts_per_page' => 3 ) );
				while ( $right_post_query->have_posts() ) : $right_post_query->the_post();
					get_template_part( 'content' );
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>