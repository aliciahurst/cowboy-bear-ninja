<?php

class Rainy_Customize {

	// Add sections and controls
	public static function register ( $wp_customize ) {

		// General section
		$wp_customize->add_section( 'rainy_general_settings', array(
			'title'		=> 'General',
			'priority'	=> 35
		) );

		$wp_customize->add_setting( 'rainy_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rainy_logo', array(
			'label'		=> 'Logo',
			'section'	=> 'rainy_general_settings',
			'settings'	=> 'rainy_logo',
			'priority'	=> 1
		) ) );

		$wp_customize->add_setting( 'rainy_favicon' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rainy_favicon', array(
			'label'		=> 'Favicon (16x16)',
			'section'	=> 'rainy_general_settings',
			'settings'	=> 'rainy_favicon',
			'priority'	=> 2
		) ) );

		$wp_customize->add_setting( 'rainy_default_header_image' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rainy_default_header_image', array(
			'label'		=> 'Default header image',
			'section'	=> 'rainy_general_settings',
			'settings'	=> 'rainy_default_header_image',
			'priority'	=> 3
		) ) );

		$wp_customize->add_setting( 'rainy_footer_first_column', array( 'default' => '&copy; Copyright ' . date( 'Y ' ) . get_bloginfo( 'name' ) ) );
		$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'rainy_footer_first_column', array(
			'label'		=> 'Footer first column',
			'section'	=> 'rainy_general_settings',
			'settings'	=> 'rainy_footer_first_column',
			'priority'	=> 4
		) ) );

		$wp_customize->add_setting( 'rainy_footer_second_column' );
		$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'rainy_footer_second_column', array(
			'label'		=> 'Footer second column',
			'section'	=> 'rainy_general_settings',
			'settings'	=> 'rainy_footer_second_column',
			'priority'	=> 5
		) ) );

		$wp_customize->add_setting( 'rainy_tracking_code' );
		$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'rainy_tracking_code', array(
			'label'		=> 'Tracking code',
			'section'	=> 'rainy_general_settings',
			'settings'	=> 'rainy_tracking_code',
			'priority'	=> 6
		) ) );

		// Blog section
		$wp_customize->add_section( 'rainy_blog_settings', array(
			'title'		=> 'Blog',
			'priority'	=> 36
		) );

		$wp_customize->add_setting( 'rainy_default_blog_title', array( 'default' => 'Blog' ) );
		$wp_customize->add_control( 'rainy_default_blog_title', array(
			'label'		=> 'Default blog title',
			'section'	=> 'rainy_blog_settings',
			'type'		=> 'text',
			'priority'	=> 1
		) );

		$wp_customize->add_setting( 'rainy_default_blog_subtitle', array( 'default' => 'Blog subtitle' ) );
		$wp_customize->add_control( 'rainy_default_blog_subtitle', array(
			'label'		=> 'Default blog subtitle',
			'section'	=> 'rainy_blog_settings',
			'type'		=> 'text',
			'priority'	=> 2
		) );

		$wp_customize->add_setting( 'rainy_default_blog_header_image' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rainy_default_blog_header_image', array(
			'label'		=> 'Default blog header image',
			'section'	=> 'rainy_blog_settings',
			'settings'	=> 'rainy_default_blog_header_image',
			'priority'	=> 3
		) ) );

		// Custom CSS section
		$wp_customize->add_section( 'rainy_custom_css_settings', array(
			'title'		=> 'Custom CSS',
			'priority'	=> 37
		) );

		$wp_customize->add_setting( 'rainy_custom_css' );
		$wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'rainy_custom_css', array(
			'label'		=> 'Custom CSS',
			'section'	=> 'rainy_custom_css_settings',
			'settings'	=> 'rainy_custom_css',
			'priority'	=> 1
		) ) );

	}

	// Add favicon
	public static function rainy_favicon() {

		if ( get_theme_mod( 'rainy_favicon' ) ) {
			echo '<link rel="shortcut icon" href="' . get_theme_mod( 'rainy_favicon' ) . '" />';
		} else {
			echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/assets/images/favicon.ico" />';
		}

	}

	// Add custom CSS
	public static function rainy_dynamic_css() {

		$custom_css = get_theme_mod( 'rainy_custom_css' );

		$output = '';

		if ( $custom_css ) {
			$output .= $custom_css;
		}

		if ( $output ) {
			echo '<style>' . $output . '</style>';
		}

	}

	// Add tracking code
	public static function rainy_tracking_code() {

		echo get_theme_mod( 'rainy_tracking_code' );

	}

}

add_action( 'customize_register' , array( 'Rainy_Customize' , 'register' ) );

add_action( 'wp_head' , array( 'Rainy_Customize' , 'rainy_favicon' ) );

add_action( 'wp_head' , array( 'Rainy_Customize' , 'rainy_dynamic_css' ) );

add_action( 'wp_footer' , array( 'Rainy_Customize' , 'rainy_tracking_code' ) );

/**
 * -----------------------------------------------------------------------------
 * Custom textarea control
 * -----------------------------------------------------------------------------
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	class WP_Customize_Textarea_Control extends WP_Customize_Control {

		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="7" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}

	}

}