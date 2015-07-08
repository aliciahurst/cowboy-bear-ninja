<?php

function custom_meta_boxes() {

  $tr_sidebars = ot_get_option( 'tr_sidebars' );
  $tr_sidebars_array = array();
  $tr_sidebars_array[0] = array (
    'label' => "Default sidebar",
    'value' => 'sidebar'
  );

  $sidebars_k = 1;
  if ( ! empty( $tr_sidebars ) ) {
    foreach ( $tr_sidebars as $tr_sidebar ) {
      $tr_sidebars_array[$tr_sidebars_k++] = array(
        'label' => $tr_sidebar['title'],
        'value' => $tr_sidebar['id']
      );
    }
  }

  $post = array(
  	'id'        => 'metabox_post',
  	'title'     => 'Post Settings',
  	'desc'      => '',
  	'pages'     => array( 'post' ),
  	'context'   => 'normal',
  	'priority'  => 'high',
  	'fields'    => array(
      array(
        'id'          => 'subtitle',
        'label'       => 'Subtitle',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => ''
      ),
      array(
        'id'          => 'header_img',
        'label'       => 'Header Image',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'class'       => ''
      ),
      array(
        'id'          => 'sidebar_set',
        'label'       => 'Choose Sidebar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices'     => $tr_sidebars_array
      ),
      array(
        'id'          => 'post_slides',
        'label'       => 'Slider',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'post_slide',
            'label'       => 'Upload Image',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'post_videos',
        'label'       => 'Videos',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'post_video',
            'label'       => 'URL (Link)',
            'desc'        => 'Enter URL to the video from YouTube or Vimeo, e.g. http://vimeo.com/78468485',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      )
    )
  );
  
  $portfolio = array(
  	'id'        => 'metabox_portfolio',
  	'title'     => 'Portfolio Settings',
  	'desc'      => '',
  	'pages'     => array( 'portfolio', 'hidden'),
  	'context'   => 'normal',
  	'priority'  => 'high',
  	'fields'    => array(
      array(
        'id'          => 'subtitle',
        'label'       => 'Subtitle',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => ''
      ),
      array(
        'id'          => 'header_img',
        'label'       => 'Header Image',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'class'       => ''
      ),
      array(
        'id'          => 'portfolio_slides',
        'label'       => 'Slider',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'portfolio_slide',
            'label'       => 'Upload Image',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'portfolio_images',
        'label'       => 'Images',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'portfolio_image',
            'label'       => 'Upload Image',
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'portfolio_videos',
        'label'       => 'Videos',
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'portfolio_video',
            'label'       => 'URL (Link)',
            'desc'        => 'Enter URL to the video from YouTube or Vimeo, e.g. http://vimeo.com/78468485',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'tr_portfolio_content',
        'label'       => 'Portfolio Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'class'       => ''
      )
    )
  );
  
  $gallery = array(
    'id'        => 'metabox_gallery',
    'title'     => 'Gallery Settings',
    'desc'      => '',
    'pages'     => array( 'gallery' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'gallery_img',
        'label'       => 'Upload Image',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'class'       => ''
      )
    )
  );
  
  $page = array(
    'id'        => 'metabox_page',
    'title'     => 'Layout Settings',
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'subtitle',
        'label'       => 'Subtitle',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => ''
      ),
      array(
        'id'          => 'header_img',
        'label'       => 'Header Image',
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'class'       => ''
      ),
      array(
        'id'          => 'sidebar_set',
        'label'       => 'Choose Sidebar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices'     => $tr_sidebars_array
      )
    )
  );
  
  ot_register_meta_box( $post );
  ot_register_meta_box( $portfolio );
  ot_register_meta_box( $gallery );
  ot_register_meta_box( $page );

}
add_action( 'admin_init', 'custom_meta_boxes' );