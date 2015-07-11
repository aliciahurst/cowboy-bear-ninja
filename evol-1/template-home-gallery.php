<?php
/*
Template Name: Home with Gallery
*/

get_header(); ?>
	
	<main id="main" role="main">
		<div id="recent-projects">
			<div class="inner"><?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile; ?>
				<div id="gallery" class="clearfix"><?php
					query_posts( array( 'post_type' => 'gallery', 'posts_per_page' => 6 ) );
					while ( have_posts() ) : the_post();
						get_template_part( 'content-gallery' );
					endwhile;
					wp_reset_query(); ?>
    			</div><?php
				$tr_btn_title = ot_get_option( 'tr_home_button_title' );
				$tr_btn_url = ot_get_option( 'tr_home_button_url' );
    			if ( ! empty( $tr_btn_title ) ) echo '<a class="button" href="' . $tr_btn_url . '">' . $tr_btn_title . '</a>'; ?>
			</div>
		</div>
		<div id="recent-posts">
			<div class="inner">
				<div class="recent-posts-left"><?php
					query_posts( array( 'post_type' => 'post', 'posts_per_page' => 1 ) );
					while ( have_posts() ) : the_post(); ?>
						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<div class="entry-meta"><?php the_time( 'M j, Y' ); ?> / <?php comments_popup_link(); ?></div>
						</header><?php
						the_excerpt();
					endwhile;
					wp_reset_query(); ?>
				</div>
				<div class="recent-posts-right"><?php
					query_posts( array( 'post_type' => 'post', 'offset' => 1, 'posts_per_page' => 3 ) );
					while ( have_posts() ) : the_post(); ?>
						<header class="entry-header">
							<h3 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
							<div class="entry-meta"><?php the_time( 'M j, Y' ); ?> / <?php comments_popup_link(); ?></div>
						</header><?php
					endwhile;
					wp_reset_query(); ?>
				</div>
			</div>
		</div>
	</main>

<?php get_footer(); ?>