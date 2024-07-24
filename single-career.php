<?php
set_header_theme(array(
  'background' => 'white',
  'invert' => true
));

get_header();

Enqueue::style('public/views/single-career/single-career.css', [
  'is_root_path' => true
]);


Enqueue::script('public/views/single-career/single-career.js', [], [
  'is_root_path' => true,
]);

$career_type = get_the_terms($post->ID, 'career-type');
$career_location = get_the_terms($post->ID, 'career-location');
$career_team = get_the_terms($post->ID, 'career-team');

$apply_linkedin = get_field('career_links')['apply_linkedin'];
$apply_now = get_field('career_links')['apply_now'];


if (have_rows('career', 'options')) :
  while (have_rows('career', 'options')) : the_row();
    $short_description = get_sub_field('short_description');
    $learn_more_link = get_sub_field('learn_more_link');
    $back_link = get_sub_field('back_link');
    $form_shortcode = get_sub_field('form_shortcode');
    $apply_now = !$apply_now ? get_sub_field('apply_now') : $apply_now;
    $apply_linkedin = !$apply_linkedin ? get_sub_field('apply_linkedin') : $apply_linkedin;
  endwhile;
endif;

$posts = get_posts([
  'post_type' => 'career',
  'post_status' => 'publish',
  'numberposts' => 4
]);

?>

<section data-theme="white" class="sc-banner">
  <div class="container sc-banner__wrapper" data-columns>

    <div class="sc-banner__left-side">
      <a href="<?php echo $back_link ?>" class="sc-banner__back-button icon-arrow-left"></a>
      <h1 class="sc-banner__title"><?php the_title() ?></h1>

      <div class="sc-banner__chips chips-list">
        <?php if ($career_type) : foreach ($career_type as $item) { ?>
            <div class="sc-banner__chips-item chips"><?php echo ($item)->name; ?></div>
        <?php }
        endif; ?>

        <?php if ($career_location) : foreach ($career_location as $item) { ?>
            <div class="sc-banner__chips-item chips"><?php echo ($item)->name; ?></div>
        <?php }
        endif; ?>

        <?php if ($career_team) : foreach ($career_team as $item) { ?>
            <div class="sc-banner__chips-item chips"><?php echo ($item)->name; ?></div>
        <?php }
        endif; ?>
      </div>
    </div>

    <div class="sc-banner__right-side">
      <?php if ($apply_now) :  ?>
        <a class="sc-banner__button" data-button="" data-style="blue" href="<?php echo ($apply_now); ?>"><?php _e('Apply now', 'SECRET-domain'); ?></a>
      <?php endif; ?>
      <?php if ($apply_linkedin) :  ?>
        <a class="sc-banner__button" data-button="" data-style="blue outlined" href="<?php echo ($apply_linkedin); ?>" target="_blank"><?php _e('Apply with LinkedIn', 'SECRET-domain'); ?></a>
      <?php endif; ?>

    </div>

  </div>
</section>
<section class="sc-content container" data-columns data-theme="white">

  <div class="sc-content__container">
    <?php the_content(); ?>
  </div>
  <div class="sc-content__sidebar-wrapper">
    <div class="sc-content__sidebar">
      <div class="sc-content__sidebar-about">
        <h4 class="sc-content__sidebar-title"><?php _e('About us', 'SECRET-domain'); ?></h4>

        <?php if ($short_description) :  ?>
          <div class="sc-content__sidebar-description"><?php echo ($short_description); ?></div>
        <?php endif; ?>
        <?php if ($learn_more_link) :  ?>
          <a href="<?php echo ($learn_more_link['url']); ?>" class="sc-content__more-button icon-arrow-right"><?php echo ($learn_more_link['title']); ?></a>
        <?php endif; ?>

      </div>
      <hr>
      <div class="sc-content__sidebar-related">
        <h4 class="sc-content__sidebar-title"><?php _e('Related jobs', 'SECRET-domain'); ?></h4>
        <div class="sc-content__related-posts">
          <?php
          foreach ($posts as $item) {
            if (get_the_ID() !== $item->ID) {
          ?>
              <a href="<?php echo (get_permalink($item->ID)); ?>" class="sc-content__related-post icon-arrow-right-up"><?php echo ($item->post_title); ?></a>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('template-parts/sections/contact-form-section', '', ['options_key' => 'options']) ?>

<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section.php'); ?>

<?php get_footer(); ?>