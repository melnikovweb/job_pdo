<?php

add_action('wp_enqueue_scripts', 'dequeue_gutenberg');
function dequeue_gutenberg()
{
  wp_dequeue_style('wp-block-library');
}
