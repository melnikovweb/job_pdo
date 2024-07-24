<?php

/**
 * Manage Contact Form 7 (CF7) JavaScript, styles, and reCAPTCHA loading based on the current post content.
 *
 * Dequeues CF7 and reCAPTCHA scripts and styles, preventing them from loading everywhere.
 * If the current post has a CF7 shortcode, enqueues necessary scripts and styles.
 *
 * @return void
 */

// TODO move logic in the settings
add_action('wp_print_scripts', function () {
  if (!is_page_template('templates/contacts.php') && !('career' === get_post_type()) && get_the_ID() != '25917' && get_the_ID() != '28376') {
    wp_dequeue_script('google-recaptcha');
    wp_dequeue_script('wpcf7-recaptcha');
  }
});
