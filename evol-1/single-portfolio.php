<?php get_header(); ?>

	<main id="main">
		<div class="inner">
			<div id="primary" role="main"><?php 
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content-portfolio' );
				endwhile; endif; ?>
				
				<ul class="portfolio-nav"><?php
					echo '<li>';
						if ( get_adjacent_post( false, '', false ) ) {
							next_post_link( '%link', '<i class="fa-chevron-left"></i>' );
						} else {
							echo '<i class="fa-chevron-left"></i>';
						};
					echo '</li>';
					
					$tr_portfolio_page = ot_get_option( 'tr_portfolio_page' );
					echo '<li><a href="' . get_permalink( $tr_portfolio_page ) . '"><i class="fa-th"></i></a></li>';
					
					echo '<li>';
						if ( get_adjacent_post( false, '', true ) ) {
							previous_post_link( '%link', '<i class="fa-chevron-right"></i>' );
						} else {
							echo '<i class="fa-chevron-right"></i>';
						};
					echo '</li>'; ?>
				</ul>
			</div>
		</div>
	</main>

<?php get_footer(); ?>