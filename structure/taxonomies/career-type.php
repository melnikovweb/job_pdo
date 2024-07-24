<?php

add_action('init', 'register_career_type');
function register_career_type()
{
  /**
   * Taxonomy: Career Type.
   */

  $labels = [
    'name'                  => __('Career Types', 'SECRET-domain-admin'),
    'singular_name'         => __('Career Type'),
  ];

  $args = [
    'label'                 => __('Career Type', 'SECRET-domain-admin'),
    'labels'                => $labels,
    'public'                => false,
    'publicly_queryable'    => null,
    'show_in_nav_menus'     => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'show_tagcloud'         => true,
    'show_in_quick_edit'    => true,
    'show_in_admin_bar'     => true,
    'hierarchical'          => true,
    'show_admin_column'     => true,
  ];
  register_taxonomy('career-type', ['career'], $args);
}
