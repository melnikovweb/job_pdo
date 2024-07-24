<?php
function glossary()
{
  $args = array(
    'label'                 => __('Glossary', 'SECRET-domain-admin'),
    'description'           => __('Glossary', 'SECRET-domain-admin'),
    'supports'              => ['title', 'editor'],
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-book',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => ['slug' => 'glossary', 'with_front' => false,],
    'capability_type'       => 'post',
  );
  register_post_type('glossary', $args);
}
add_action('init', 'glossary', 1);
