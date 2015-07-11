<?php

/*--------------------------------------------------------------------------------------*/
/*	Dynamic CSS
/*--------------------------------------------------------------------------------------*/

function tr_dynamic_css() {
	$tr_primary_link_color = ot_get_option( 'tr_primary_link_color' );
	$tr_secondary_link_color = ot_get_option( 'tr_secondary_link_color' );
	$tr_bg_color = ot_get_option( 'tr_bg_color' );
	$tr_header_bg_color = ot_get_option( 'tr_header_bg_color' );
	$custom_css = ot_get_option( 'tr_custom_css' );
	
	$output = '';
	
	if ( $tr_primary_link_color ) {
		$output .= "a {\n color:" . $tr_primary_link_color . ";\n}\n\n";
	}
	
	if ( $tr_secondary_link_color ) {
		$output .= ".entry-meta a, .post-nav a, #filter a, .comment-list .comment-meta a {\n color:" . $tr_secondary_link_color . ";\n}\n\n";
	}
	
	if ( $tr_bg_color ) {
		$output .= "body {\n background-color:" . $tr_bg_color . ";\n}\n\n";
	}
	
	if ( $tr_header_bg_color ) {
		$output .= "#header .header-color {\n background-color:" . $tr_header_bg_color . ";\n}\n\n";
	}
	
	if ( $custom_css ) {
		$output .= "\n" . $custom_css . "\n";
	}
	
	if ( $output ) {
		$output = "<style>" . $output . "</style>";
		echo $output;
	}
}
add_action('wp_head', 'tr_dynamic_css');

/*--------------------------------------------------------------------------------------*/
/*	Favicon
/*--------------------------------------------------------------------------------------*/

function tr_favicon() {
	echo '<link rel="shortcut icon" href="' . ot_get_option( 'tr_favicon' ) . '" />';
}
add_action( 'wp_head', 'tr_favicon' );

/*--------------------------------------------------------------------------------------*/
/*	Tracking code
/*--------------------------------------------------------------------------------------*/

function tr_tracking_code() {
	echo ot_get_option( 'tr_tracking_code' );
}
add_action( 'wp_footer', 'tr_tracking_code' );

?>