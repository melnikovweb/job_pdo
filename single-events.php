<?php
set_header_theme(array(
  'background' => 'white',
  'invert' => true
));

get_header();

Enqueue::style('public/views/single-post/single-post.css', [
  'is_root_path' => true
]);

$category = get_the_terms($post->ID, 'events-type');

$start_date = get_field('start_date');
$end_date = get_field('end_date');
$full_date = $start_date && $end_date ? date('M d, Y', strtotime($start_date)) . ' - ' . date('M d, Y', strtotime($end_date)) : ($start_date ? date('M d, Y', strtotime($start_date)) : 'test');
?>

<div class="sp-banner container" data-columns data-theme="white">
  <?php if (get_the_post_thumbnail_url()) : ?>
    <div class="sp-banner__img-wrapper"><?php the_post_thumbnail(); ?></div>
  <?php endif; ?>

  <div class="sp-banner__info">
    <h1 class="sp-banner__title"><?php the_title() ?></h1>

    <div class="sp-banner__data">
      <div class="sp-banner__item icon-dot-separator"><?php echo $full_date ?></div>

      <?php if ($category) { ?><div class="sp-banner__item icon-dot-separator"><?php echo end($category)->name; ?></div><?php } ?>
    </div>
  </div>
</div>

<div class="sp-content container" data-columns data-theme="white">
  <a href="<?php echo esc_url(get_post_type_archive_link('events')); ?>" class="sp-content__back-button icon-arrow-left"><?php _e('Back to Events', 'SECRET-domain'); ?></a>

  <div class="sp-content__container">
    <?php the_content(); ?>
  </div>
</div>

<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section.php'); ?>

<?php get_footer(); ?>