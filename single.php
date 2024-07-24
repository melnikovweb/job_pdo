<?php

set_header_theme(array(
  'background' => 'white',
  'invert' => true
));

get_header();

Enqueue::style('public/views/single-post/single-post.css', [
  'is_root_path' => true
]);
$post_type = $post->post_type;

if ($post_type === 'news' || $post_type === 'case-studies') {
  $category = get_the_terms($post->ID, $post_type . '-category');
  $back_to_name = get_post_type_object($post_type)->label;
} else {
  $category = get_the_category();
  $back_to_name = "Blog";
}

?>

<div class="sp-banner container" data-columns data-theme="white">
  <?php if (get_the_post_thumbnail_url()) : ?>
    <div class="sp-banner__img-wrapper"><?php the_post_thumbnail(); ?></div>
  <?php endif; ?>

  <div class="sp-banner__info">
    <h1 class="sp-banner__title"><?php the_title() ?></h1>

    <div class="sp-banner__data">
      <div class="sp-banner__item icon-dot-separator"><?php echo get_the_date('d F Y') ?></div>

      <div class="sp-banner__item icon-dot-separator"><?php echo do_shortcode('[read_meter]') ?></div>

      <div class="sp-banner__item icon-dot-separator"><?php echo end($category)->name; ?></div>
    </div>
  </div>
</div>

<div class="sp-content container" data-columns data-theme="white">
  <a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>" class="sp-content__back-button icon-arrow-left"><?php _e('Back to ' . $back_to_name, 'SECRET-domain'); ?></a>

  <div class="sp-content__container">
    <?php the_content(); ?>
  </div>
</div>

<?php get_template_part('template-parts/sections/post-recommendations-section',  'post-recommendations-section.php'); ?>

<?php get_footer(); ?>