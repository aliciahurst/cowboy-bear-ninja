	<footer id="footer" role="contentinfo">
		<?php $tr_footer_sidebar = ot_get_option( 'tr_footer_sidebar', 'yes' ); if ( $tr_footer_sidebar != 'no' ) { ?>
			<div id="footer-sidebar">
				<div class="inner">
					<?php dynamic_sidebar( 'footer-sidebar' ); ?>
				</div>
			</div>
		<?php } ?>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>