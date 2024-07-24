<?php
// Template Name: Safeguarding

set_header_theme(array(
  'background' => 'black',
  'invert' => false
));

get_header();

Enqueue::style('public/views/safeguarding/safeguarding.css', [
  'is_root_path' => true,
]);
?>
<div class="sf-header container" data-columns data-theme="black">
  <div class="sf-header__title">
    <h1><?php the_title(); ?></h1>
  </div>

  <h2 class="sf-header__content">
    <?php the_content(); ?>
  </h2>
</div>

<?php if (have_rows('safeguarding_section')) : ?>
  <div class="sf-page-content" data-theme="black">
    <?php while (have_rows('safeguarding_section')) : the_row(); ?>

      <?php if (have_rows('content')) : ?>
        <?php while (have_rows('content')) : the_row();
          $editor = get_sub_field('editor');
        ?>
          <?php if ($editor) : ?>
            <div class="sf-page-content__section container" data-columns>
              <div class="sf-page-content__regular sf-regular-content">
                <?php echo $editor; ?>
              </div>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_footer(); ?>
