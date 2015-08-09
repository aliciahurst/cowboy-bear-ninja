<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

		<?php get_template_part( 'content-portfolio-single' ); ?>

<?php else : ?>

	<div class="project-thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'project' ); ?>
			<h4><?php the_title(); ?></h4>
			<p><?php the_field('subtitle'); ?></p>
		</a>

	</div>

<?php endif; ?>	

</article>
