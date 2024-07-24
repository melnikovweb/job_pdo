<?php
add_action('wp_enqueue_scripts', 'enqueue_core');
function enqueue_core()
{
  wp_register_style('SECRET-core', get_template_directory_uri() . '/public/core/core.css', [], _S_VERSION);
  wp_enqueue_style('SECRET-core');

  Enqueue::script('public/core/core.js', [], [
    'is_root_path' => true,
  ]);
}
