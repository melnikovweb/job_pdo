<?php
set_header_theme(array(
  'background' => 'white',
  'invert' => true
));

get_header();

Enqueue::style('public/views/archive/archive.css', [
  "is_root_path" => true
]);

$categories_select_data = array(
  'hide_empty' => 0,
  'parent' => 0,
);

$post_type = get_post_type();


if ($post_type !== 'post') {
  $page_title = get_post_type_object($post_type)->labels->singular_name;
  $filter_category_all_link = get_post_type_archive_link($post_type);
} else {
  $page_title = get_the_archive_title();
  $filter_category_all_link = get_post_type_archive_link('post');
}

if ($post_type === 'case-studies') {
  $categories =  get_terms([
    'taxonomy' => 'case-studies-category',
    'hide_empty' => true,
  ]);
} elseif ($post_type === 'news') {
  $categories =  get_terms([
    'taxonomy' => 'news-category',
    'hide_empty' => true,
  ]);
} else {
  $categories = get_categories([
    'hide_empty' => true,
  ]);
}


$current_url = trailingslashit(home_url(add_query_arg(array(), $wp->request)));
?>

<section class="categories container" data-columns data-theme="white">
  <div class="categories__title" data-offset-start="2">
    <h1><?php echo $page_title; ?></h1>
  </div>

  <?php if ($categories) : ?>
    <div class="categories__content" data-offset-start="2">
      <div class="chips-list">
        <?php if ($filter_category_all_link) : ?>
          <?php $filter_category_all_link = trailingslashit($filter_category_all_link); ?>
          <a href="<?php echo esc_url($filter_category_all_link); ?>" class="chips<?php echo ($filter_category_all_link == $current_url ? ' active' : '') ?>"><?php _e('All', 'SECRET-domain'); ?></a>
        <?php endif; ?>

        <?php foreach ($categories as $item) : ?>
          <?php
          $name = $item->name;
          $category_link = trailingslashit(get_category_link($item->term_id));
          ?>
          <a href="<?php echo esc_url($category_link); ?>" class="chips <?php echo ($category_link == $current_url ? ' active' : '') ?>">
            <?php echo $name; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</section>

<section id="posts-container" class="posts-section container" data-columns data-theme="white">
  <?php if (have_posts()) : ?>
    <div id="posts-container" class="posts-section__posts posts" data-offset-start="2">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/components/post'); ?>
      <?php endwhile; ?>
    </div>

    <div class="posts-section__pagination" data-offset-start="2">
      <?php the_posts_pagination(); ?>
    </div>
  <?php endif; ?>
</section>


<?php
get_template_part('template-parts/sections/callback-section', '', ['options_key' => 'options'])
?>

<?php get_footer(); ?>