<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

		<div class="post-content"><?php the_content(); ?></div>

	<?php else : ?>

		<div class="project-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'project' ); ?>
				<div class="project-title"><?php the_title(); ?></div>
				<div class="overlay"></div>
			</a>
		</div>

	<?php endif; ?>	

</article>