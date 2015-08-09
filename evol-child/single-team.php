<?php get_header(); ?>

<div class="page-sidebar" role="complementary">
	<aside class="widget">	
		<?php if( get_field('bio_photo') ): ?>

			<img src="<?php the_field('bio_photo'); ?>" />

		<?php endif; ?>
		<nav class="post-navigation" role="navigation">
			<ul class="bio-contact">
				<?php if( get_field('sm_email') ): ?>
					<?php $email = get_field('sm_email'); ?>

					<li> <a href="mailto:<?php echo $email; ?>"><i class="fa fa-fw fa-envelope"></i> <span class="sm-name nav-meta">email</span></a> </li>
				<?php endif; ?>
				<?php if( have_rows('social_media') ): ?>
					<?php while( have_rows('social_media') ): the_row(); 

					$sm_name = get_sub_field('sm_name');
					$link = get_sub_field('sm_link');

					?>

					<li>
						<a href="<?php echo $link; ?>"><i class="fa fa-fw fa-<?php echo $sm_name; ?>"></i> <span class="sm-name nav-meta"><span><?php echo $sm_name; ?></span></span></a>
					</li>

				<?php endwhile; ?>

			<?php endif; ?>
		</ul>

	</nav>
</aside>	
</div>

<div class="page-content">
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="post-content">

				<?php if( get_field('bio_text') ): ?>

					<?php the_field('bio_text'); ?>

				<?php endif; ?>
				<?php if( have_rows('bio_videos') ): ?>
					<h4 class="video-header"><?php the_field('video_section_header'); ?></h4>
					<div id="portfolio" class="portfolio-area">

						<?php while( have_rows('bio_videos') ): the_row(); 

						$vid_name = get_sub_field('video_name');
						$vid_link = get_sub_field('video_url');
						$vid_thumb = get_sub_field('video_thumbnail');
						?>

						<article class="type-project">


							<div class="project-thumbnail">
								<a href="<?php echo $vid_link ?>" class="various fancybox.iframe">
									<img src="<?php echo $vid_thumb ?>" />
									<h6><?php echo $vid_name ?></h6>
								</a>

							</div>
						</article>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<?php the_content(); ?>
		</div>

	</article>


</div>

<?php rainy_team_nav(); endwhile; ?>

<?php get_footer(); ?>



