<?php
global $wp_embed;
$images = get_post_meta( $post->ID, 'portfolio_images', true, array() );
$slides = get_post_meta( $post->ID, 'portfolio_slides', true, array() );
$videos = get_post_meta( $post->ID, 'portfolio_videos', true, array() );
$tr_portfolio_content = get_post_meta( $post->ID, 'tr_portfolio_content', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) :
		
		the_content();
		
		if ( ! empty( $slides ) ) {
			echo '<div class="entry-media"><div class="flexslider"><ul class="slides">';
				foreach ( $slides as $slide ) {
					echo '<li><img src="' . $slide['portfolio_slide'] . '" /></li>';
				};
			echo '</ul></div></div>';
		};
		
		if ( ! empty( $images ) ) {
			foreach ( $images as $image ) {
				echo '<div class="entry-media">';
					echo '<img src="' . $image['portfolio_image'] . '" />';
				echo '</div>';
			};
		};
		
		if ( ! empty( $videos ) ) {
			foreach ( $videos as $video ) {
				$embed = $wp_embed->run_shortcode( '[embed]' . $video['portfolio_video'] . '[/embed]' );
				echo '<div class="entry-media">';
					echo '<div class="embed">' . $embed . '</div>';
				echo '</div>';
			}
		};
		
		echo '<div class="entry-content">' . wpautop( do_shortcode( $tr_portfolio_content ) ) . '</div>'; ?>

	<?php else : ?>

		<div class="entry-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( 'portfolio' ); ?>
				<h6><?php the_title(); ?></h6>
			</a>
		</div>

	<?php endif; ?>	

</article>