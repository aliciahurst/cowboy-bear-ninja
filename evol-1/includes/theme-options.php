<?php

add_action( 'admin_init', 'custom_theme_options', 1 );

function custom_theme_options() {
  
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  $custom_settings = array( 
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General Options'
      ),
      array(
        'id'          => 'footer',
        'title'       => 'Footer Options'
      ),
      array(
        'id'          => 'home',
        'title'       => 'Home Options'
      ),
      array(
        'id'          => 'blog',
        'title'       => 'Blog Options'
      ),
      array(
        'id'          => 'portfolio',
        'title'       => 'Portfolio Options'
      ),
      array(
        'id'          => 'gallery',
        'title'       => 'Gallery Options'
      ),
      array(
        'id'          => 'styling',
        'title'       => 'Styling Options'
      ),
      array(
        'id'          => 'css',
        'title'       => 'Custom CSS'
      ),
      array(
        'id'          => 'sidebars',
        'title'       => 'Sidebars'
      )
    ),
    'settings'        => array( 
      array(
        'label'       => 'Logo',
        'id'          => 'tr_logo',
        'type'        => 'upload',
        'desc'        => 'Upload a logo for your site.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
      array(
        'label'       => 'Favicon',
        'id'          => 'tr_favicon',
        'type'        => 'upload',
        'desc'        => 'Upload a favicon for your site.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general'
      ),
      array(
        'label'       => 'Display Footer Sidebar',
        'id'          => 'tr_footer_sidebar',
        'type'        => 'select',
        'desc'        => 'Display footer sidebar or not?',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          ),
          array(
            'label'       => 'No',
            'value'       => 'no'
          )
        ),
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Footer Info',
        'id'          => 'tr_footer_info',
        'type'        => 'textarea-simple',
        'desc'        => 'Enter the info you would like to display in the footer.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Tracking Code',
        'id'          => 'tr_tracking_code',
        'type'        => 'textarea-simple',
        'desc'        => 'Paste your Google Analytics or other tracking code here. It will be inserted just before the closing body tag for every page.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'footer'
      ),
      array(
        'label'       => 'Recent Project Button Title',
        'id'          => 'tr_home_button_title',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Recent Project Button URL',
        'id'          => 'tr_home_button_url',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'home'
      ),
      array(
        'label'       => 'Blog pages show at most',
        'id'          => 'tr_posts_per_page',
        'type'        => 'text',
        'desc'        => 'Enter the number of posts to show per page.',
        'std'         => '5',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog'
      ),
      array(
        'label'       => 'Display Navigation',
        'id'          => 'tr_blog_nav',
        'type'        => 'select',
        'desc'        => 'Display navigation on blog page or not?',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          ),
          array(
            'label'       => 'No',
            'value'       => 'no'
          )
        ),
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog'
      ),
      array(
        'label'       => 'Display Filter',
        'id'          => 'tr_portfolio_filter',
        'type'        => 'select',
        'desc'        => 'Display filter or not?',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          ),
          array(
            'label'       => 'No',
            'value'       => 'no'
          )
        ),
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
      ),
      array(
        'label'       => 'Portfolio pages show at most',
        'id'          => 'tr_projects_per_page',
        'type'        => 'text',
        'desc'        => 'Enter the number of projects to show per page. Use -1 to display all projects.',
        'std'         => '-1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
      ),
      array(
        'label'       => 'Display Navigation',
        'id'          => 'tr_portfolio_nav',
        'type'        => 'select',
        'desc'        => 'Display navigation on portfolio page or not?',
        'choices'     => array(
          array(
            'label'       => 'No',
            'value'       => 'no'
          ),
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          )
        ),
        'std'         => 'no',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
      ),
      array(
        'label'       => 'Portfolio Page',
        'id'          => 'tr_portfolio_page',
        'type'        => 'page-select',
        'desc'        => 'Select the portfolio page. Used for the "Back to portfolio" link.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
      ),
      array(
        'label'       => 'Display Filter',
        'id'          => 'tr_gallery_filter',
        'type'        => 'select',
        'desc'        => 'Display filter or not?',
        'choices'     => array(
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          ),
          array(
            'label'       => 'No',
            'value'       => 'no'
          )
        ),
        'std'         => 'yes',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'gallery'
      ),
      array(
        'label'       => 'Gallery pages show at most',
        'id'          => 'tr_gallery_per_page',
        'type'        => 'text',
        'desc'        => 'Enter the number of images to show per page. Use -1 to display all images.',
        'std'         => '-1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'gallery'
      ),
      array(
        'label'       => 'Display Navigation',
        'id'          => 'tr_gallery_nav',
        'type'        => 'select',
        'desc'        => 'Display navigation on portfolio page or not?',
        'choices'     => array(
          array(
            'label'       => 'No',
            'value'       => 'no'
          ),
          array(
            'label'       => 'Yes',
            'value'       => 'yes'
          )
        ),
        'std'         => 'no',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'gallery'
      ),
      array(
        'label'       => 'Primary Link Color',
        'id'          => 'tr_primary_link_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => '#313133',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'styling'
      ),
      array(
        'label'       => 'Secondary Link Color',
        'id'          => 'tr_secondary_link_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => '#AAAAAA',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'styling'
      ),
      array(
        'label'       => 'Background Color',
        'id'          => 'tr_bg_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => '#FFFFFF',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'styling'
      ),
      array(
        'label'       => 'Header Background Color',
        'id'          => 'tr_header_bg_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => '#313131',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'styling'
      ),
      array(
        'label'       => 'Custom CSS',
        'id'          => 'tr_custom_css',
        'type'        => 'css',
        'desc'        => 'Paste your code here. It will be inserted just before the closing body tag for every page.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'css'
      ),
      array(
        'label'       => 'About Sidebars',
        'id'          => 'tr_about_sidebars',
        'type'        => 'textblock',
        'desc'        => 'All sidebars that you create here will appear both in the Appearance &gt; Widgets, and then you can choose them for specific pages or posts.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'sidebars'
      ),
      array(
        'label'       => 'Create Sidebars',
        'id'          => 'tr_sidebars',
        'type'        => 'list-item',
        'desc'        => 'Choose a unique title for each sidebar.',
        'settings'    => array(
          array(
            'label'       => 'ID',
            'id'          => 'id',
            'type'        => 'text',
            'desc'        => 'Write a lowercase single world as ID (or number), without any spaces.',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'sidebars'
      )
    )
  );

  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }

}