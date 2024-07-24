<?php

add_action('init', 'register_case_studies_category');
function register_case_studies_category()
{
  /**
   * Taxonomy: Case Studies category.
   */

  $labels = [
    'name'                  => __('Case Studies categories', 'SECRET-domain-admin'),
    'singular_name'         => __('Case Studies category'),
  ];

  $args = [
    'label'                 => __('Case Studies category', 'SECRET-domain-admin'),
    'labels'                => $labels,
    'public'                => true,
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
    'has_archive'           => true,
    'rewrite'               => ['slug' => 'case-studies-category', 'with_front' => false],
  ];
  register_taxonomy('case-studies-category', ['case-studies'], $args);
}
