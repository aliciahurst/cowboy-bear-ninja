<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

		<div class="post-content"><?php the_content(); ?></div>

	<?php else : ?>

		<div class="project-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'project' ); ?>
				<h4><?php the_title(); ?></h4>
			</a>

		</div>

	<?php endif; ?>	

</article>