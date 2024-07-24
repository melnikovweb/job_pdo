<?php
add_action('init', 'register_payment_method_type');
function register_payment_method_type()
{
  $labels = [
    'name'                  => __('Payment Methods Types', 'SECRET-domain-admin'),
    'singular_name'         => __('Payment Method Type', 'SECRET-domain-admin'),
  ];

  $args = [
    'label'                 => __('Payment Method Type', 'SECRET-domain-admin'),
    'labels'                => $labels,
    'public'               => false,
    'publicly_queryable'    => false,
    'show_in_nav_menus'     => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_tagcloud'         => true,
    'show_in_quick_edit'    => null,
    'hierarchical'          => true,
    'show_admin_column'     => true,
  ];
  register_taxonomy('payment-method-type', ['pricing-for-checkout'], $args);
}
