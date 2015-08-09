<?php /* Template Name: Team */ ?>

<?php get_header(); ?>

<div class="page-content">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="post-content">
				<?php the_content(); ?>

				<div id="portfolio" class="portfolio-area">

					<?php $args = array( 'numberposts' => 99, 'post_type' => 'directors', 'orderby' => 'menu_order', 'order' => 'ASC' ); $lastposts = get_posts( $args ); foreach($lastposts as $post) : setup_postdata($post); ?> 
					<article class="type-project">
						<div class="project-thumbnail">
							<?php if( get_field('bio_photo') ): ?>

								<img src="<?php the_field('bio_photo'); ?>" />

							<?php endif; ?>

							<h4><?php the_title(); ?></h4>
							<p><strong><?php the_field('subtitle'); ?></strong></p>
							<ul class="bio-contact">
								<?php if( get_field('sm_email') ): ?>
									<?php $email = get_field('sm_email'); ?>

									<li> 
										<a href="mailto:<?php echo $email; ?>"><i class="fa fa-fw fa-envelope"></i> <span class="sm-name nav-meta"></span></a> </li>
									<?php endif; ?>
									<?php if( have_rows('social_media') ): ?>
										<?php while( have_rows('social_media') ): the_row(); 

										$sm_name = get_sub_field('sm_name');
										$link = get_sub_field('sm_link');

										?>

										<li>
											<a href="<?php echo $link; ?>"><i class="fa fa-fw fa-<?php echo $sm_name; ?>"></i> <span class="sm-name nav-meta"></span></a>
										</li>

									<?php endwhile; ?>
								<?php endif; ?>
							</ul>

							<?php the_field('bio_excerpt'); ?>


							<p class="more-button"><a href="<?php the_permalink() ?>">Read More</a></p>

						</div>
					</article>

				<?php endforeach; ?>
				<?php wp_reset_query(); ?>
			</div>
		</div>

	</article>

<?php endwhile; ?>
</div>

<?php get_footer(); ?>



