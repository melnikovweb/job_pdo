<?php
function SECRET_events()
{
  $args = array(
    'label'                 => __('Events', 'SECRET-domain-admin'),
    'description'           => __('Event', 'SECRET-domain-admin'),
    'supports'              => ['title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes'],
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-calendar-alt',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => ['slug' => 'events', 'with_front' => false],
    'capability_type'       => 'post',
  );
  register_post_type('events', $args);
}
add_action('init', 'SECRET_events', 1);
