<?php $gallery_img = get_post_meta( $post->ID, 'gallery_img', true ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

		<img src="<?php echo $gallery_img; ?>" />

	<?php else : ?>

		<div class="entry-thumb">
			<a href="<?php echo $gallery_img; ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'portfolio' ); ?>
				<h6><?php the_title(); ?></h6>
			</a>
		</div>

	<?php endif; ?>	

</article>