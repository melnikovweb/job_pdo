<?php
// Template Name: Plugins

set_header_theme(array(
  'background' => 'dark'
));

get_header();

Enqueue::style('public/views/plugins/plugins.css',  [
  'is_root_path' => true,
]);
?>

<?php if (have_rows('banner_section')) : ?>
  <?php while (have_rows('banner_section')) : the_row(); ?>
    <div class="plugins-banner">
      <div class="plugins-banner__section container" data-columns data-theme="dark">
        <div class="plugins-banner__content">
          <h1 class="plugins-banner__headline"><?php the_sub_field('title'); ?></h1>

          <div class="plugins-banner__description"><?php the_sub_field('description'); ?></div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php get_template_part('template-parts/sections/partners', '', ['group_name' => 'integrate_section', 'top_not_indent' => true]); ?>

  <?php get_template_part('template-parts/sections/integrate-links'); ?>

  <?php get_template_part('template-parts/sections/partners'); ?>

  <?php get_template_part('template-parts/sections/callback-section'); ?>

  <?php get_footer(); ?>
