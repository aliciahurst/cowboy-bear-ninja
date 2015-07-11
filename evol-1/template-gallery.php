<?php
/*
Template Name: Gallery
*/

get_header(); ?>
	
	<main id="main">
		<div class="inner">
			<div id="primary" role="main"><?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile; ?>
				<?php $tr_gallery_filter = ot_get_option( 'tr_gallery_filter', 'yes' ); if ( $tr_gallery_filter != 'no' ) { ?>
					<div id="filter">
						<ul>
							<li><a class="active" href="#" value="*"><?php _e( 'All', 'themerain' ); ?></a></li>
							<?php
							$terms = get_terms( 'gallery-category', array( 'include' => $categories ) );
							foreach ( $terms as $term ) {
								echo '<li><a href="#" value=".' . $term->slug . '">' . $term->name . '</a></li>';
							}
							?>
						</ul>
					</div>
				<?php } ?>
				<div id="gallery"><div class="gallery-inner clearfix"><?php
					$tr_gallery_per_page = ot_get_option( 'tr_gallery_per_page', '-1' );
					$tr_gallery_nav = ot_get_option( 'tr_gallery_nav', 'no' );
					
					if ( get_query_var( 'paged' ) ) $paged = get_query_var( 'paged' );
					elseif ( get_query_var( 'page' ) ) $paged = get_query_var( 'page' );
					else $paged = 1;
					
					query_posts( array( 'post_type' => 'gallery', 'posts_per_page' => $tr_gallery_per_page, 'paged' => $paged ) );
					while ( have_posts() ) : the_post();
						get_template_part( 'content-gallery' );
					endwhile; ?>
    			</div></div>
    			<?php if ( $tr_gallery_nav != 'no' ) tr_pagination(); ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>