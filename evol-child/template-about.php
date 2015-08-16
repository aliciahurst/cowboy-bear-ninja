<?php /* Template Name: About */ ?>

<?php get_header(); ?>

<div class="page-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="post-content">
				<?php the_content(); ?>

				<div id="portfolio" class="portfolio-area">

					<?php $args = array( 'numberposts' => 99, 'post_type' => 'team', 'orderby' => 'menu_order', 'order' => 'ASC' ); $lastposts = get_posts( $args ); foreach($lastposts as $post) : setup_postdata($post); ?> 
					
					<?php get_template_part( 'content-team' ); ?>

				<?php endforeach; ?>
				<?php wp_reset_query(); ?>
			</div>
		</div>

	</article>

<?php endwhile; ?>
</div>

<?php get_footer(); ?>



