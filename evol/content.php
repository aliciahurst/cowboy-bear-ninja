<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

		<div class="post-content"><?php the_content(); ?></div>

		<?php the_tags( '<div class="post-tags">', '', '</div>' ); ?>

	<?php else : ?>

		<?php if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) { ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
		<?php } ?>

		<?php the_title( '<h1 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' ); ?>

		<?php rainy_post_meta(); ?>

		<div class="post-content">
			<?php the_excerpt(); ?>
			<a class="post-more" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'themerain' ); ?></a>
		</div>

	<?php endif; ?>

</article>