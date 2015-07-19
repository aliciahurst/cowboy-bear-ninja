<?php

/**
 * -----------------------------------------------------------------------------
 * Post meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_post_meta_boxes() {
	$meta_box = array(
		'title'		=> 'Post settings',
		'id'		=> 'rainy-metabox-post',
		'page' 		=> 'post',
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
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
add_action( 'add_meta_boxes', 'rainy_post_meta_boxes' );

/**
 * -----------------------------------------------------------------------------
 * Project meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_project_meta_boxes() {
	$meta_box = array(
		'title'		=> 'Project settings',
		'id'		=> 'rainy-metabox-project',
		'page' 		=> 'project',
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
add_action( 'add_meta_boxes', 'rainy_project_meta_boxes' );

/**
 * -----------------------------------------------------------------------------
 * Page meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_page_meta_boxes() {
	$meta_box = array(
		'title'		=> 'Page settings',
		'id'		=> 'rainy-metabox-page',
		'page' 		=> 'page',
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
add_action( 'add_meta_boxes', 'rainy_page_meta_boxes' );

/**
 * -----------------------------------------------------------------------------
 * Configure meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_add_meta_box( $meta_box ) {
	if ( ! is_array( $meta_box ) ) return false;
	$callback = create_function( '$post, $meta_box', 'rainy_create_meta_box( $post, $meta_box["args"] );' );
	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
}

function rainy_create_meta_box( $post, $meta_box ) {
	if ( ! is_array( $meta_box ) ) return false;

	wp_nonce_field( basename( __FILE__ ), 'rainy_meta_box_nonce' );
	echo '<table class="form-table">';

	foreach( $meta_box['fields'] as $field ) {
		$meta = get_post_meta( $post->ID, $field['id'], true );
		echo '<tr><th><label for="' . $field['id'] . '">' . $field['name'] . '</label></th>';

		switch ( $field['type'] ) {
			case 'text' :
				echo '<td><input type="text" name="rainy_meta[' . $field['id'] . ']" id="' . $field['id'] . '" value="' . ( $meta ? $meta : $field['std'] ) . '" size="30" /></td>';
				break;	

			case 'textarea' :
				echo '<td><textarea name="rainy_meta[' . $field['id'] . ']" id="' . $field['id'] . '" rows="8" cols="5">' . ( $meta ? $meta : $field['std'] ) . '</textarea></td>';
				break;

			case 'select' :
				echo'<td><select name="rainy_meta[' . $field['id'] . ']" id="' . $field['id'] . '">';
				foreach ( $field['options'] as $key => $option ) {
					echo '<option value="' . $key . '"';
					if ( $meta ) {
						if ( $meta == $key ) echo ' selected="selected"';
					} else {
						if ( $field['std'] == $key ) echo ' selected="selected"'; 
					}
					echo'>' . $option . '</option>';
				}
				echo'</select></td>';
				break;

			case 'upload':
				echo '<style>.image_preview { width: 350px; } .image_preview img { display: block; max-width:100%; width: auto; height: auto; margin: 10px 0; } .image_remove { cursor: pointer; color: #AA0000; font-size: 13px; } .image_remove:hover { color: #FF0000; } .image-error { margin: 10px 0; }</style><td><input type="text" name="rainy_meta[' . $field['id'] . ']" id="' . $field['id'] . '" class="image_url" value="' . ( $meta ? $meta : $field['std'] ) . '" /> <span class="image_upload button">Browse</span><div class="image_preview"></div></td>';
				break;

			case 'radio' :
				echo '<td>';
				foreach ( $field['options'] as $key => $option ) {
					echo '<label class="radio-label"><input type="radio" name="rainy_meta[' . $field['id'] . ']" value="' . $key . '" class="radio"';
					if ( $meta ) { 
						if ( $meta == $key ) echo ' checked="checked"'; 
					} else {
						if ( $field['std'] == $key ) echo ' checked="checked"';
					}
					echo ' /> ' . $option . '</label> ';
				}
				echo '</td>';
				break;

			case 'checkbox' :
			    echo '<td>';
			    $val = '';
                if ( $meta ) {
                    if ( $meta == 'on' ) $val = ' checked="checked"';
                } else {
                    if ( $field['std'] == 'on' ) $val = ' checked="checked"';
                }

                echo '<input type="hidden" name="rainy_meta[' . $field['id'] . ']" value="off" />
                <input type="checkbox" id="' . $field['id'] . '" name="rainy_meta[' . $field['id'] . ']" value="on"' . $val . ' /> ';
			    echo '</td>';
			    break;
		}
		echo '</tr>';
	}
	echo '</table>';
}

/**
 * -----------------------------------------------------------------------------
 * Save meta boxes
 * -----------------------------------------------------------------------------
 */

function rainy_save_meta_box( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	if ( ! isset( $_POST['rainy_meta'] ) || ! isset( $_POST['rainy_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['rainy_meta_box_nonce'], basename( __FILE__ ) ) )
		return;

	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	}

	foreach( $_POST['rainy_meta'] as $key=>$val ) {
		update_post_meta( $post_id, $key, stripslashes( htmlspecialchars( $val ) ) );
	}
}
add_action( 'save_post', 'rainy_save_meta_box' );

/**
 * -----------------------------------------------------------------------------
 * Register scripts
 * -----------------------------------------------------------------------------
 */

function rainy_meta_box_scripts() {
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'uploader', get_template_directory_uri() . '/assets/js/uploader.js', array( 'jquery', 'media-upload' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'rainy_meta_box_scripts' );