<?php
// Enqueue scripts and styles.

require_once __DIR__ . '/register-scripts-global.php';

require_once __DIR__ . '/enqueue-scripts-vendors.php';

require_once __DIR__ . '/enqueue-scripts-core.php';

require_once __DIR__ . '/enqueue-scripts-web-components.php';

require_once __DIR__ . '/dequeue-gutenberg.php';

add_action('wp_enqueue_scripts', 'SECRET_enqueue_scripts');

function SECRET_enqueue_scripts()
{
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  if (function_exists('get_field')) {
    $page_type = get_field('what_section', get_the_ID());

    if ($page_type !== null) {
      wp_localize_script('cookie-access-popup', 'cookieAccessPopup', [
        'page_type' => strtolower($page_type)
      ]);
    }
  }
}
