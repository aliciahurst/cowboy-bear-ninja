<div class="post-content">
<div class="intro-divs">
<div class="intro">
<p>Getting desktop and mobile toggles styled and workingGetting desktop and mobile toggles styled and working Getting desktop and mobile toggles styled and working Getting desktop and mobile toggles styled and working Getting desktop and mobile toggles styled and working Getting desktop and mobile toggles styled and working Getting desktop and mobile toggles styled and working
</p>
</div>

<!-- WHAT WE DID -->
	<?php if( have_rows('what_we_did') ): ?> 
		<div class="one-third">
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
		<div class="one-third">
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
