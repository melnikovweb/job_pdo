<?php
function register_personal_pricing()
{
  $args = array(
    'label'                 => __('Personal pricing', 'SECRET-domain-admin'),
    'description'           => '',
    'supports'              => ['title', 'custom-fields', 'page-attributes'],
    'public'                => false,
    'publicly_queryable'    => false,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'exclude_from_search'   => false,
    'has_archive'           => false,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'hierarchical'          => true,
    'menu_position'         => 6,
    'menu_icon'             => 'dashicons-editor-table',
    'can_export'            => true,
    'rewrite'               => ['slug' => 'personal-pricing', 'with_front' => false],
    'capability_type'       => 'post',
  );
  register_post_type('personal-pricing', $args);
}
add_action('init', 'register_personal_pricing', 2);
