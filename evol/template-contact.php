<?php /* Template Name: Contact */

if ( isset( $_POST['submit'] ) ) {
	if ( trim( $_POST['author'] ) === '' ) {
		$hasError = true;
	} else {
		$author = trim( $_POST['author'] );
	}

	if ( trim( $_POST['email'] ) === '' ) {
		$hasError = true;
	} else if ( !eregi( "^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim( $_POST['email'] ) ) ) {
		$hasError = true;
	} else {
		$email = trim( $_POST['email'] );
	}

	if ( trim( $_POST['subject'] ) === '' ) {
		$hasError = true;
	} else {
		$subject = trim( $_POST['subject'] );
	}

	if ( trim( $_POST['message'] ) === '' ) {
		$hasError = true;
	} else {
		if ( function_exists( 'stripslashes' ) ) {
			$message = stripslashes( trim($_POST['message'] ) );
		} else {
			$message = trim( $_POST['message'] );
		}
	}

	if ( ! isset( $hasError ) ) {
		$site_name = get_bloginfo( 'name' );
		$to = get_option( 'admin_email' );

		$subject = '[' . $site_name . '] ' . $subject;
		$message = "$message";
		$headers = 'From: ' . $author . ' <' . $email . '>' . "\r\n" . 'Reply-To: ' . $email;

		mail( $to, $subject, $message, $headers );
		$emailSent = true;
	}
}

get_header(); ?>

<div class="page-content">
	<?php
	while ( have_posts() ) : the_post();
		get_template_part( 'content-page' );
	endwhile;
	?>

	<div id="contact" class="contact-area">
		<?php if ( isset( $emailSent ) && $emailSent == true ) { ?>
			<p class="contact-form-success"><?php _e( 'Thanks, your email was sent successfully.', 'themerain' ); ?></p>
		<?php } else { ?>

			<?php if ( isset( $hasError ) ) { ?>
				<p class="contact-form-error"><?php _e( 'Sorry, an error occurred.', 'themerain' ); ?></p>
			<?php } ?>

			<form action="<?php the_permalink(); ?>" method="post" id="contact-form" class="contact-form">
				<p class="contact-form-author">
					<input type="text" name="author" id="author" class="required" value="" placeholder="<?php _e( 'Name *', 'themerain' ); ?>" />
				</p>

				<p class="contact-form-email">
					<input type="text" name="email" id="email" class="required email" value="" placeholder="<?php _e( 'Email *', 'themerain' ); ?>" />
				</p>

				<p class="contact-form-subject">
					<input type="text" name="subject" id="subject" class="required" value="" placeholder="<?php _e( 'Subject *', 'themerain' ); ?>" />
				</p>

				<p class="contact-form-message">
					<textarea name="message" id="message" class="required" cols="45" rows="8" placeholder="<?php _e( 'Message *', 'themerain' ); ?>"></textarea>
				</p>

				<p class="contact-form-submit">
					<input type="submit" name="submit" value="<?php _e( 'Send Message', 'themerain' ); ?>" />
				</p>
			</form>

		<?php } ?>
	</div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>