<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	global $wp_embed;
	$slides = get_post_meta( $post->ID, 'post_slides', true, array() );
	$videos = get_post_meta( $post->ID, 'post_videos', true, array() );
	
	if ( is_single() ) :
		
		if ( has_post_thumbnail() ) {
			echo '<div class="entry-media">';
				the_post_thumbnail();
			echo '</div>';
		}
		
		if ( ! empty( $slides ) ) {
			echo '<div class="entry-media"><div class="flexslider"><ul class="slides">';
				foreach ( $slides as $slide ) {
					echo '<li><img src="' . $slide['post_slide'] . '" /></li>';
				};
			echo '</ul></div></div>';
		};
		
		if ( ! empty( $videos ) ) {
			foreach ( $videos as $video ) {
				$embed = $wp_embed->run_shortcode( '[embed]' . $video['post_video'] . '[/embed]' );
				echo '<div class="entry-media">';
					echo '<div class="embed">' . $embed . '</div>';
				echo '</div>';
			}
		};
		?>
		
		<header class="entry-header">
			<div class="entry-meta"><strong><?php the_time( 'F j, Y' ); ?></strong> BY <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a> </div>
		</header>
		
		<div class="clearfix">
			<?php the_content(); ?>
			<div class="clearfix"></div>
			 <div class="entry-meta-bottom">
				<!-- <div><?php _e( 'Share on', 'themerain' ); ?> <a href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" target="_blank">Twitter</a>, <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="_blank">Facebook</a> <?php _e( 'or', 'themerain' ); ?> <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">Google+</a></div>
				<div class="entry-meta-tags"><?php the_tags( __( 'Tags: ', 'themerain' ), ' ' ); ?></div>
			</div>-->
			<ul class="post-nav">
				<li class="post-nav-left"><?php if ( get_adjacent_post( false, '', false ) ) { next_post_link( '%link', '<i class="fa-chevron-left"></i> ' . __( 'Previous Post', 'themerain' ) . '' ); } else { echo '<i class="fa-chevron-left"></i> ' . __( 'Previous Post', 'themerain' ) . ''; }; ?></li>
				<li class="post-nav-right"><?php if ( get_adjacent_post( false, '', true ) ) { previous_post_link( '%link', '' . __( 'Next Post', 'themerain' ) . ' <i class="fa-chevron-right"></i>' ); } else { echo '' . __( 'Next Post', 'themerain' ) . ' <i class="fa-chevron-right"></i>'; }; ?></li>
			</ul> 
		</div>
	

	<?php else :
		
		if ( has_post_thumbnail() ) { ?>

			<div class="entry-media entry-thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div> <?php
		}
		
		if ( ! empty( $slides ) ) {
			echo '<div class="entry-media"><div class="flexslider"><ul class="slides">';
				foreach ( $slides as $slide ) {
					echo '<li><img src="' . $slide['post_slide'] . '" /></li>';
				};
			echo '</ul></div></div>';
		};
		
		if ( ! empty( $videos ) ) {
			foreach ( $videos as $video ) {
				$embed = $wp_embed->run_shortcode( '[embed]' . $video['post_video'] . '[/embed]' );
				echo '<div class="entry-media">';
					echo '<div class="embed">' . $embed . '</div>';
				echo '</div>';
			}
		};
		?>
		
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="entry-meta"><strong><?php the_time( 'F j, Y' ); ?></strong> by <?php the_author_posts_link(); ?> </div>
			</header>
		
		<div class="clearfix"><?php the_content(''); ?></div>
		
	<?php endif; ?>
	
</article>