<?php
/*
Template Name: Blog_Child
*/

get_header(); ?>

	<main id="main">
		<div class="inner">
			<div id="primary" role="main"><?php
				$tr_posts_per_page = ot_get_option( 'tr_posts_per_page', '5' );
				$tr_blog_nav = ot_get_option( 'tr_blog_nav', 'yes' );
				
				if ( get_query_var( 'paged' ) ) $paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) $paged = get_query_var( 'page' );
				else $paged = 1;
				
				query_posts( array( 'post_type' => 'post', 'paged' => $paged, 'posts_per_page' => $tr_posts_per_page ) );
				if ( have_posts() ) : while ( have_posts() ) : the_post();
					get_template_part( 'content' );
				endwhile; endif;
				
				if ( $tr_blog_nav != 'no' ) tr_pagination(); ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>