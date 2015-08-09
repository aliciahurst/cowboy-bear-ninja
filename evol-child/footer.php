		</main>
		<section class="mailing-list">
			<div class="inner">
			<p><?php the_field('footer_mailing_list_text', 'options'); ?></p> 
			<form action="http://cowboybearninja.us5.list-manage.com/subscribe/post?u=ef6850663dc422328e11a6dcc&amp;id=c47b7b1036" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>	
				<input type="email" value="" name="EMAIL" class="mc-email email" id="mce-EMAIL" placeholder="enter your email address" required>
			    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
			    <div style="position: absolute; left: -5000px;"><input type="text" name="b_ef6850663dc422328e11a6dcc_c47b7b1036" value=""></div>
				<input type="submit" value="subscribe" name="subscribe" id="mc-embedded-subscribe" class="mc-submit">
			</form>
			</div>
		</section>

		<footer id="contact" class="site-footer" role="contentinfo">
			<div class="inner">
				<?php get_sidebar( 'footer' ); ?>

				<div class="footer-column">
					<?php echo wpautop( get_theme_mod( 'rainy_footer_first_column', '&copy; Copyright ' . date( 'Y ' ) . get_bloginfo( 'name' ) . ', All Rights Reserved' ) ); ?>
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