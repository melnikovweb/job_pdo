<?php
// remove_head_scripts()
add_action('wp_enqueue_scripts', 'remove_head_scripts');
function remove_head_scripts()
{
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);
  remove_action('wp_head', 'wp_print_styles', 99);
  remove_action('wp_head', 'wp_enqueue_style', 99);

  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
  add_action('wp_head', 'wp_print_styles', 30);
  add_action('wp_head', 'wp_enqueue_style', 30);
}


add_action('wp_enqueue_scripts', '_scripts');
function _scripts()
{
  if (is_admin()) return; // don't dequeue on the backend
  wp_deregister_script('jquery');

  // TODO: ???
  // AJAX-поиск
  wp_enqueue_script('search', get_template_directory_uri() . '/assets/js/search.js', array(), null, true);
  wp_localize_script('search', 'search', [
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('search-nonce'),
  ]);

  // TODO: ???
  // AJAX-подписка на рассылку с плагином newsletter
  wp_enqueue_script('newsletter', get_template_directory_uri() . '/assets/js/newsletter.js', array(), null, true);
  wp_localize_script('newsletter', 'newsletter', [
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('newsletternonce'),
    'invalid_email' => __('Enter correct email address!', 'SECRET-domain'),
  ]);

  // common scripts
  //=====================================================================
}
