<?php
/*
Template Name: Home with Gallery
*/

get_header(); ?>
	
	<main id="main" role="main">
		<div id="recent-projects">
			<div class="inner"> <div id="primary" role="main"><?php
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
		</div>
		
	</main>

<?php get_footer(); ?>