<?php

add_action('init', 'register_events_type');
function register_events_type()
{
  /**
   * Taxonomy: Events Type.
   */

  $labels = [
    'name'                  => __('Events Types', 'SECRET-domain-admin'),
    'singular_name'         => __('Events Type'),
  ];

  $args = [
    'label'                 => __('Events Type', 'SECRET-domain-admin'),
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
    'rewrite'               => ['slug' => 'events-type', 'with_front' => false],
  ];
  register_taxonomy('events-type', ['events'], $args);
}
