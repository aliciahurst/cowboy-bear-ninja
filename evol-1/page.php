<?php get_header(); ?>

	<main id="main">
		<div class="inner">
			<div id="primary" role="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>
				<?php endwhile; endif; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</main>

<?php get_footer(); ?>