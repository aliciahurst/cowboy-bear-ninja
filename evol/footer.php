		</main>

		<footer class="site-footer" role="contentinfo">
			<div class="inner">
				<?php get_sidebar( 'footer' ); ?>

				<div class="footer-column">
					<?php echo wpautop( get_theme_mod( 'rainy_footer_first_column', '&copy; Copyright ' . date( 'Y ' ) . get_bloginfo( 'name' ) ) ); ?>
				</div>

				<div class="footer-column-last">
					<?php echo wpautop( get_theme_mod( 'rainy_footer_second_column' ) ); ?>
				</div>
			</div>
		</footer>
	</div>

	<?php wp_footer(); ?>
</body>
</html>