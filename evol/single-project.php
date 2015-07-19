<?php get_header(); ?>

<div class="page-content">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content-portfolio' );

		rainy_project_nav();
	endwhile;
	?>
</div>

<?php get_footer(); ?>