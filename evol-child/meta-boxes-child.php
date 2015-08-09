<?php

/**
 * -----------------------------------------------------------------------------
 * Hidden meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_hidden_meta_boxes() {
	$meta_box = array(
		'title'		=> 'Project settings',
		'id'		=> 'rainy-metabox-hidden',
		'page' 		=> 'hidden',
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> 'Project subtitle',
				'id'		=> 'rainy_subtitle',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Header image',
				'id'		=> 'rainy_header_image',
				'desc'		=> '',
				'type'		=> 'upload',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button text',
				'id'		=> 'rainy_button_text',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button URL',
				'id'		=> 'rainy_button_url',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			)
		)
	);
	rainy_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'rainy_hidden_meta_boxes' );

/**
 * -----------------------------------------------------------------------------
 * Old/Unused Pages meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_old_meta_boxes() {
	$meta_box = array(
		'title'		=> 'Page settings',
		'id'		=> 'rainy-metabox-page',
		'page' 		=> 'old',
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> 'Page subtitle',
				'id'		=> 'rainy_subtitle',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Header image',
				'id'		=> 'rainy_header_image',
				'desc'		=> '',
				'type'		=> 'upload',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button text',
				'id'		=> 'rainy_button_text',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button URL',
				'id'		=> 'rainy_button_url',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			)
		)
	);
	rainy_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'rainy_old_meta_boxes' );

/**
 * -----------------------------------------------------------------------------
 * Team Pages meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_team_meta_boxes() {
	$meta_box = array(
		'title'		=> 'Page settings',
		'id'		=> 'rainy-metabox-page',
		'page' 		=> 'team',
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> 'Page subtitle',
				'id'		=> 'rainy_subtitle',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Header image',
				'id'		=> 'rainy_header_image',
				'desc'		=> '',
				'type'		=> 'upload',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button text',
				'id'		=> 'rainy_button_text',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button URL',
				'id'		=> 'rainy_button_url',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			)
		)
	);
	rainy_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'rainy_team_meta_boxes' );

/**
 * -----------------------------------------------------------------------------
 * Directors Pages meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_directors_meta_boxes() {
	$meta_box = array(
		'title'		=> 'Page settings',
		'id'		=> 'rainy-metabox-page',
		'page' 		=> 'directors',
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> 'Page subtitle',
				'id'		=> 'rainy_subtitle',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Header image',
				'id'		=> 'rainy_header_image',
				'desc'		=> '',
				'type'		=> 'upload',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button text',
				'id'		=> 'rainy_button_text',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Button URL',
				'id'		=> 'rainy_button_url',
				'desc'		=> '',
				'type'		=> 'text',
				'std'		=> ''
			)
		)
	);
	rainy_add_meta_box( $meta_box );
}
add_action( 'add_meta_boxes', 'rainy_directors_meta_boxes' );
