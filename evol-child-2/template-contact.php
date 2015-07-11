<?php
/*
Template Name: Contact_Child
*/

$nameError = '';
$emailError = '';
$commentError = '';

if ( isset( $_POST['submitted'] ) ) {
	if ( trim( $_POST['contactName'] ) === '' ) {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim( $_POST['contactName'] );
	}
	
	if ( trim( $_POST['email'] ) === '' ) {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if ( ! eregi( "^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim( $_POST['email'] ) ) ) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim( $_POST['email'] );
	}
	
	if ( trim( $_POST['comments'] ) === '' ) {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if ( function_exists( 'stripslashes' ) ) {
			$comments = stripslashes( trim($_POST['comments'] ) );
		} else {
			$comments = trim( $_POST['comments'] );
		}
	}
	
	if ( ! isset( $hasError ) ) {
		$emailTo = get_option( 'admin_email' );
		
		$subject = '[Contact Form] From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n" . 'Reply-To: ' . $email;
		
		mail( $emailTo, $subject, $body, $headers );
		$emailSent = true;
	}
}

get_header(); ?>
	<main id="main">
		<div class="inner">
			<div id="primary" role="main">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
						
						<?php if ( isset( $emailSent ) && $emailSent == true ) { ?>
							<p class="success"><?php _e( 'Thanks, your email was sent successfully.', 'themerain' ); ?></p>
						<?php } else { ?>
							
							<?php if ( isset( $hasError ) || isset( $captchaError ) ) { ?>
								<p class="error"><?php _e( 'Sorry, an error occurred.', 'themerain' ); ?><p>
							<?php } ?>
							<!-- <div class="one-third last">
							<form id="contact-form" action="<?php the_permalink(); ?>" method="post">
								<p>
									<label for="contactName"><?php _e( 'Name', 'themerain' ); ?> <span>*</span></label>
									<input type="text" name="contactName" id="contactName" class="required requiredField" value="<?php if ( isset( $_POST['contactName'] ) ) echo $_POST['contactName']; ?>" />
								</p>
								
								<p>
									<label for="email"><?php _e( 'Email', 'themerain' ); ?> <span>*</span></label>
									<input type="text" name="email" id="email" class="required requiredField email" value="<?php if ( isset( $_POST['email'] ) ) echo $_POST['email']; ?>" />
								</p>
								
								<p>
									<label for="commentsText"><?php _e( 'Message', 'themerain' ); ?> <span>*</span></label>
									<textarea name="comments" id="commentsText" class="required requiredField" cols="45" rows="8"><?php if ( isset( $_POST['comments'] ) ) echo $_POST['comments']; ?></textarea>
								</p>
								
								<input type="submit" name="submitted" id="submitted" value="<?php _e( 'Send Message', 'themerain' ); ?>" />
							</form>
							</div> -->
						<?php } ?>
					</article>
					
				<?php endwhile; endif; ?>
			</div>
		</div>
	</main>

<div id="map">
<?php echo do_shortcode('[su_gmap address="175 Varick Street, New York, NY 10014" class="map"]'); ?>
<div class="overlay" onClick="style.pointerEvents='none'"></div>
</div>
<?php get_footer(); ?>