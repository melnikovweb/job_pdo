<?php
function SECRET_career()
{
  $args = array(
    'label'                 => __('Career', 'SECRET-domain-admin'),
    'description'           => __('Career', 'SECRET-domain-admin'),
    'supports'              => ['title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes'],
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-businessman',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => ['slug' => 'career', 'with_front' => false],
    'capability_type'       => 'post',
  );
  register_post_type('career', $args);
}
add_action('init', 'SECRET_career', 1);
