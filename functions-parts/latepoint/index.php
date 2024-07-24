<?php

/**
 * Manage scripts and styles loading for the LatePoint plugin based on the presence of the [latepoint_book_form] shortcode.
 *
 * Dequeues LatePoint scripts and styles to prevent loading globally.
 * If the current post has the LatePoint booking form shortcode, enqueues the necessary scripts and styles.
 *
 * @return void
 */
function manage_latepoint()
{
  wp_dequeue_script('latepoint-main-front');
  wp_dequeue_script('latepoint-vendore-front');
  wp_dequeue_style('latepoint-main-front');

  global $post;
  if (isset($post->post_content) and has_shortcode($post->post_content, 'latepoint_book_form')) {
    wp_enqueue_script('latepoint-main-front');
    wp_enqueue_script('latepoint-vendore-front');
    wp_enqueue_style('latepoint-main-front');
  }
}

// Hook the function to the wp_enqueue_scripts action with priority 10
add_action('wp_enqueue_scripts', 'manage_latepoint', 10, 0);
