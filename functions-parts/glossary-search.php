<?php
add_action('wp_ajax_nopriv_glossary', 'glossary_ajax');
add_action('wp_ajax_glossary', 'glossary_ajax');

function glossary_ajax()
{
  check_ajax_referer('glossary-nonce', 'nonce');

  $results = false;
  $sanitized_s = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : '';

  if ($sanitized_s) {
    global $wpdb;

    $search_query = $wpdb->prepare(
      "SELECT ID, post_title 
      FROM {$wpdb->posts} 
      WHERE post_type = 'glossary' 
      AND post_status = 'publish' 
      AND post_title LIKE %s",
      '%' . $wpdb->esc_like($sanitized_s) . '%'
    );

    $results = $wpdb->get_results($search_query);
  }

  $output = '';

  if ($results) {
    foreach ($results as $post) {
      $output .= '<li class="gl-search__result-list-item">' .
        '<a class="gl-search__result-list-link" href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a>' .
        '</li><span></span>';
    }
  } else {
    $output .= '<li class="gl-search__result-list-item">' .
      '<a class="gl-search__result-list-link" href="#">' . __('Not found', 'SECRET-domain') . '</a>' .
      '</li><span></span>';
  }

  wp_die($output);
}
