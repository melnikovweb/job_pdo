<?php
add_filter('navigation_markup_template', 'SECRET_navigation_template', 10, 2);
function SECRET_navigation_template($template, $class)
{
  global $wp_query;
  $current_page = max(1, get_query_var('paged'));
  $total_pages = $wp_query->max_num_pages;

  $prev_class = ($current_page == 1) ? ' disabled' : '';
  $next_class = ($current_page == $total_pages) ? ' disabled' : '';

  $pagination = paginate_links([
    'prev_next' => false,
    'mid_size'  => 3,
  ]);

  $template = '
  <div class="posts-pagination">
    <a class="posts-pagination__arrow icon-arrow-left' . esc_attr($prev_class) . '" href="' . esc_url(get_previous_posts_page_link()) . '"></a>
    <div class="posts-pagination__content">
      ' . $pagination . '
    </div>
    <a class="posts-pagination__arrow icon-arrow-right' . esc_attr($next_class) . '" href="' . esc_url(get_next_posts_page_link()) . '"></a>
  </div>';

  $output = '
  <div class="posts-section__pagination">
    ' . $template . '
  </div>';

  return $output;
}

add_filter('paginate_links_output', 'SECRET_navigation_links_template');
function SECRET_navigation_links_template($html)
{
  $html = preg_replace_callback('/ class=[\'"][^\'"]+[\'"]/', static function ($mm) {
    return strtr($mm[0], [
      'current'      => 'current',
      'page-numbers' => 'posts-pagination__item',
    ]);
  }, $html);

  return $html;
}
