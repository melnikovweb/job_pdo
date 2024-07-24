<?php
function SECRET_case_studies()
{
  $args = array(
    'label'                 => __('Case Studies', 'SECRET-domain-admin'),
    'description'           => __('Case', 'SECRET-domain-admin'),
    'supports'              => ['title', 'editor', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'thumbnail', 'author', 'page-attributes'],
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_in_rest'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-editor-table',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => ['slug' => 'case-studies', 'with_front' => false],
    'capability_type'       => 'post',
  );
  register_post_type('case-studies', $args);
}
add_action('init', 'SECRET_case_studies', 1);
