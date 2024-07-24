<?php
add_action('init', 'register_payment_method_country');
function register_payment_method_country()
{
  $labels = [
    'name'                  => __('Countries', 'SECRET-domain-admin'),
    'singular_name'         => __('Country', 'SECRET-domain-admin'),
  ];

  $args = [
    'label'                 => __('Countries', 'SECRET-domain-admin'),
    'labels'                => $labels,
    'public'                => false,
    'publicly_queryable'    => false,
    'show_in_nav_menus'     => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'show_tagcloud'         => true,
    'show_in_quick_edit'    => null,
    'hierarchical'          => true,
    'show_admin_column'     => true,
  ];
  register_taxonomy('payment-method-country', ['pricing-for-checkout', 'personal-pricing'], $args);

  // TODO: Have to be optimized
  // $available_countrties = CountryDataApi\get_all_available_countries();
  // $regions_map = CountryDataApi\get_countries_region($available_countrties);

  // foreach ($regions_map as $region => $countries) {
  //   if (!term_exists($region, 'payment-method-country')) {
  //     wp_insert_term($region, 'payment-method-country');

  //     foreach ($countries as $country) {
  //       $parent_term = term_exists($region, 'payment-method-country');
  //       $parent_term_id = $parent_term['term_id'];

  //       wp_insert_term(
  //         $country->name->common,
  //         'payment-method-country',
  //         array(
  //           'description' => $country->cca2,
  //           'parent'      => $parent_term_id,
  //         )
  //       );
  //     }
  //   }
  // }
}
