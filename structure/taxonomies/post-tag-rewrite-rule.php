<?php

function SECRET_custom_post_tag_permalink($url, $post)
{
  if ('post' === get_post_type($post)) {
    $tags = get_the_tags($post->ID);
    if ($tags) {
      $tag_slugs = array();
      foreach ($tags as $tag) {
        $tag_slugs[] = $tag->slug;
      }
      $url = trailingslashit(home_url($tag_slugs[0] . '/' . $post->post_name));
    }
  }
  return $url;
}

add_filter('post_link', 'SECRET_custom_post_tag_permalink', 10, 2);

function SECRET_custom_post_tag_rewrite_rule()
{
  add_rewrite_rule(
    '(blog|case-studies|news)/([^/]+)/?$',
    'index.php?tag=$matches[1]&name=$matches[2]',
    'top'
  );
}
add_action('init', 'SECRET_custom_post_tag_rewrite_rule', 10, 0);
