<?php $sidebar = get_post_meta( $post->ID, "sidebar_set", $single = true ); ?>

<div id="secondary" role="complementary">
	<?php if ( $sidebar ) {
		if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( $sidebar ) ):
	endif; }
	if ( ! $sidebar ) {
		if ( ! dynamic_sidebar( 'sidebar' ) ) :
	endif; } ?>
</div>