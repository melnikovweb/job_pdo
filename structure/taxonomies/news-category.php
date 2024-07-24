<?php

add_action('init', 'register_news_category');
function register_news_category()
{
  /**
   * Taxonomy: News category.
   */

  $labels = [
    'name'                  => __('News categories', 'SECRET-domain-admin'),
    'singular_name'         => __('News category'),
  ];

  $args = [
    'label'                 => __('News category', 'SECRET-domain-admin'),
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
    'rewrite'               => ['slug' => 'news-category', 'with_front' => false],
  ];
  register_taxonomy('news-category', ['news'], $args);
}
