<?php
function register_pricing_for_business()
{
  $args = array(
    'label'                 => __('Pricing for business', 'SECRET-domain-admin'),
    'description'           => '',
    'supports'              => ['title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'page-attributes'],
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
    'rewrite'               => ['slug' => 'pricing-for-business', 'with_front' => false],
    'capability_type'       => 'post',
  );
  register_post_type('pricing-for-business', $args);
}
add_action('init', 'register_pricing_for_business', 2);
