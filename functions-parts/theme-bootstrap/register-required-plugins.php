<?php
require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'SECRET_register_required_plugins');
function SECRET_register_required_plugins()
{
  $base_path = get_template_directory() . '/bootstrap';

  $plugins = array(
    array(
      'name'     => 'Advanced Custom Fields PRO',
      'slug'     => 'advanced-custom-fields-pro',
      'source'   => $base_path . '/advanced-custom-fields-pro-6.2.1.1.zip',
      'required' => true,
    ),

    array(
      'name'     => 'All in One SEO',
      'slug'     => 'all-in-one-seo-pack',
      'required' => false,
    ),

    array(
      'name'     => 'All In One WP Security',
      'slug'     => 'all-in-one-wp-security-and-firewall',
      'required' => false,
    ),

    array(
      'name'     => 'Contact Form 7',
      'slug'     => 'contact-form-7',
      'required' => true,
    ),

    array(
      'name'     => 'Duplicator',
      'slug'     => 'duplicator',
      'required' => false,
    ),

    array(
      'name'     => 'Export All URLs',
      'slug'     => 'export-all-urls',
      'required' => false,
    ),

    array(
      'name'     => 'Flamingo',
      'slug'     => 'flamingo',
      'required' => false,
    ),

    array(
      'name'     => 'Geo Content',
      'slug'     => 'geo-targetly-geo-content',
      'required' => true,
    ),

    array(
      'name'     => 'Newsletter',
      'slug'     => 'newsletter',
      'required' => true,
    ),

    array(
      'name'     => 'No Category Base (WPML)',
      'slug'     => 'no-category-base-wpml',
      'required' => true,
    ),

    array(
      'name'     => 'Read Meter - Reading Time & Progress Bar for WordPress',
      'slug'     => 'read-meter',
      'required' => true,
    ),

    array(
      'name'     => 'Regenerate Thumbnails',
      'slug'     => 'regenerate-thumbnails',
      'required' => false,
    ),

    array(
      'name'     => 'W3 Total Cache',
      'slug'     => 'w3-total-cache',
      'required' => false,
    ),

    array(
      'name'     => 'WP Mail SMTP',
      'slug'     => 'wp-mail-smtp',
      'required' => false,
    ),

    array(
      'name'               => 'WP Migrate',
      'slug'               => 'wp-migrate-db-pro',
      'source'             => $base_path . '/wp-migrate-db-pro-2.6.10.zip',
      'required'           => false,
    ),
  );

  $config = array(
    'domain'       => 'SECRET-domain',
    'default_path' => '',
    'menu'         => 'SECRET-install-required-plugins',
    'has_notices'  => true,
    'is_automatic' => true,
  );

  tgmpa($plugins, $config);
}
