<div class="post-content">
	<div class="intro-divs columns">
		<!-- INTRO -->
		<div class="column-item columns-2 intro-text">
			<p><?php the_field('intro_text'); ?> <strong> &mdash; <?php echo get_the_author_meta( 'first_name' ); ?></strong></p>
		</div>

		<!-- WHAT WE DID -->
		<?php if( have_rows('what_we_did') ): ?> 
			<div class="column-item columns-4">
				<h4>What We Did</h4>
				<ul class="whatwedid">
					<?php while( have_rows('what_we_did') ): the_row(); 
					$service = get_sub_field('wwd_service');
					?>
					<li>
						<?php echo $service; ?>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	<?php endif; ?>

	<!-- CREDITS -->
	<?php if( have_rows('credits') ): ?> 
		<div class="column-item columns-4">
			<h4>Credits</h4>
			<ul class="credits">
				<?php while( have_rows('credits') ): the_row(); 
				$role = get_sub_field('credits_role');
				$name = get_sub_field('credits_name');
				$link = get_sub_field('credits_link');
				?>
				<li>
					<span class="credits-role"><?php echo $role; ?></span>
					<?php if( $link ): ?>
						<a href="<?php echo $link; ?>"><?php echo $name; ?></a>
					<?php else: ?>
						<?php echo $name; ?>
					<?php endif; ?>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php endif; ?>

</div>
<?php the_content(); ?>

</div>
<?php rainy_project_nav(); ?>
</div>
