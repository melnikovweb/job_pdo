<?php
// Template Name: About Us

set_header_theme(array(
  'background' => 'blue',
  'invert' => false
));

get_header();

Enqueue::style('public/views/about-us/about-us.css', [
  'is_root_path' => true,
]);

$about_us = Enqueue::script('public/views/about-us/about-us.js', [], [
  'is_root_path' => true,
]);

$teams_list = get_field('teams_section')['teams'];

$about_us->localize('pageData', array(
  'teamsList' => $teams_list,
));


?>

<?php if (have_rows('banner')) : ?>
  <?php while (have_rows('banner')) : the_row();
    $buttons = get_sub_field('buttons');
    $title = get_sub_field('title');
  ?>
    <div class="au-banner">
      <div class="au-banner__section container" data-columns data-theme="blue">
        <div class="au-banner__content">
          <h1 class="au-banner__headline"><?php echo $title ?></h1>

          <h2 class="au-banner__description"><?php the_sub_field('description'); ?></h2>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => $buttons
        )) ?>
      </div>
      
      <?php
        $image_id = get_sub_field('image');
        
        if (!empty($image_id)) : ?>
        <div class="au-banner__section container" data-columns data-theme="white">
          <div class="au-banner__img-wrapper">
          <?php
              echo wp_get_attachment_image($image_id, [1382, 909], false, ['alt' => $title]); ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
<?php endif; ?>
<section class="container">
  <?php get_template_part('template-parts/sections/image-blocks-section'); ?>
</section>

<?php get_template_part('template-parts/sections/timeline-section') ?>

<?php if (have_rows('teams_section')) : ?>
  <?php while (have_rows('teams_section')) : the_row();
    $buttons = get_sub_field('buttons');
  ?>
    <?php if (get_sub_field('displaying')) : ?>
      <div class="au-teams-section" data-theme="white">
        <div class="au-teams-section__header container" data-columns>
          <div class="au-teams-section__title"><?php the_sub_field('title') ?></div>

          <div class="au-teams-section__description"><?php the_sub_field('description') ?></div>

          <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
            'block_name' => 'au-teams-section',
            'buttons' => $buttons
          )) ?>
        </div>

        <div id="profile-cards" class="au-teams-section__content container" data-columns></div>
      </div>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('values_section')) : ?>
  <?php while (have_rows('values_section')) : the_row(); ?>
    <div class="au-values" data-theme="white">
      <div class="au-values__header container" data-columns>
        <div class="au-values__title"><?php the_sub_field('title') ?></div>
      </div>

      <div class="au-values__content container" data-columns>
        <?php if (have_rows('items')) : ?>
          <?php while (have_rows('items')) : the_row(); ?>
            <div class="au-values__item">
              <div class="au-values__img-wrapper">
                <?php
                $image_id = get_sub_field('image');

                if (!empty($image_id)) {
                  echo wp_get_attachment_image($image_id, 'icon-96', true);
                }
                ?>
              </div>

              <div class="au-values__name"><?php the_sub_field('name') ?></div>

              <div class="au-values__caption"><?php the_sub_field('caption') ?></div>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section'); ?>

<?php get_template_part('template-parts/sections/callback-section', 'callback-section', ['group_name' => 'next_step']) ?>

<?php get_footer() ?>
