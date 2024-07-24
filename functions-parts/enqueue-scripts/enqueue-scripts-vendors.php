<?php
add_action('wp_enqueue_scripts', 'enqueue_vendors');
function enqueue_vendors()
{
  wp_register_style('SECRET-vendors', get_template_directory_uri() . '/public/vendors/vendors.css', [], _S_VERSION);
  wp_enqueue_style('SECRET-vendors');
}
