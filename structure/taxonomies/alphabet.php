<?php
add_action('init', 'alphabet', 2);
function alphabet()
{
  register_taxonomy('alphabet', ['glossary'], [
    'label'                 => __('Alphabet', 'SECRET-domain-admin'),
    'description'           => __('Alphabet', 'SECRET-domain-admin'),
    'public'                => true,
    'publicly_queryable'    => null,
    'show_in_nav_menus'     => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_tagcloud'         => true,
    'show_in_quick_edit'    => null,
    'hierarchical'          => true,
    'rewrite'               => ['slug' => 'glossary-category', 'with_front' => false],
    'show_admin_column'     => true,
  ]);
}
