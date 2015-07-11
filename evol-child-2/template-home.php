<?php
/*
Template Name: Home
*/

get_header(); ?>
	
	<main id="main" role="main">
		<div id="home">
			<div class="inner">
			<div id="primary" role="main">
			<?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile; ?>
			
			</div>
		</div>
		</div>
	</main>

<?php get_footer(); ?>