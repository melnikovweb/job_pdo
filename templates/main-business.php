<?php
// Template Name: Main business page

set_header_theme(array(
  'background' => 'black',
));

get_header();


Enqueue::style('public/views/main-business/main-business.css', [
  'is_root_path' => true,
]);
?>

<?php if (have_rows('banner_section')) : ?>
  <?php while (have_rows('banner_section')) : the_row();
    $buttons = get_sub_field('buttons');
  ?>
    <div class="mb-banner">
      <div class="mb-banner__section container" data-columns data-theme="dark">
        <div class="mb-banner__content">
          <h1 class="mb-banner__headline"><?php the_sub_field('title'); ?></h1>

          <div class="mb-banner__description"><?php the_sub_field('description'); ?></div>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => $buttons
        )) ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('features')) : ?>
  <section class="mb-features">
    <?php while (have_rows('features')) : the_row();
      $feature_rows = get_sub_field('feature_row') ?? '';

      foreach ($feature_rows as $feature_row) {
        $l_col = $feature_row['feature_left'] ?? '';
        $r_col  = $feature_row['feature_right'] ?? '';
    ?>
        <div class="mb-features__row">
          <div class="mb-features__column mb-features__<?php echo $l_col['theme'] ?>">
            <div class="mb-features__description">
              <h2 class="mb-features__title"><?php echo $l_col['feature_title'] ?></h2>

              <div class="mb-features__subtitle"><?php echo $l_col['feature_subtitle'] ?></div>

              <?php if ($l_col['feature_label']) : ?>
                <div class="mb-features__label"><?php echo $l_col['feature_label'] ?></div>
              <?php endif; ?>
            </div>

            <?php
            $l_video_mp4 = $l_col['video_mp4'] ?? '';
            $l_video_webm = $l_col['video_webm'] ?? '';
            $l_feature_img = $l_col['feature_img'] ?? '';
            $l_image_width = $l_col['image_width'] ?? '';
            $l_image_height = $l_col['image_height'] ?? '';
            $l_feature_icons = $l_col['feature_icons'] ?? '';
            $l_feature_buttons = $l_col['feature_buttons'] ?? '';
            ?>

            <?php if ($l_video_mp4 || $l_video_webm) : ?>
              <div class="mb-features__video-wrapper">
                <video class="mb-features__video" autoplay muted loop playsinline>
                  <?php if ($l_video_mp4) : ?>
                    <source src="<?php echo esc_url($l_video_mp4); ?>" type='video/mp4; codecs="hvc1"'>
                  <?php endif; ?>
                  <?php if ($l_video_webm) : ?>
                    <source src="<?php echo esc_url($l_video_webm); ?>" type="video/webm">
                  <?php endif; ?>
                </video>
              </div>
            <?php elseif ($l_feature_img) : ?>
              <div class="mb-features__image"><?php echo wp_get_attachment_image($l_feature_img, [$l_image_width, $l_image_height]) ?></div>
            <?php endif; ?>

            <?php if ($l_feature_icons) : ?>
              <div class="mb-features__icons-wrapper">
                <div class="mb-features__icons">
                  <?php foreach ($l_feature_icons as $icon) {
                    echo wp_get_attachment_image($icon, 'icon-110');
                  } ?>
                </div>
              </div>
            <?php endif;

            if ($l_feature_buttons) : ?>
              <div class="mb-features__links">
                <?php foreach ($l_feature_buttons as $button) { ?>
                  <a class="mb-features__link" href="<?php echo $button['feature_button']['url'] ?>">
                    <div class="mb-features__button"><?php echo $button['feature_button']['title'] ?><span class="icon-arrow-right-up"></span></div>
                  </a>
                <?php } ?>
              </div>
            <?php endif; ?>


          </div>

          <div class="mb-features__column mb-features__<?php echo $r_col['theme'] ?>">
            <div class="mb-features__description">
              <h2 class="mb-features__title"><?php echo $r_col['feature_title'] ?></h2>

              <div class="mb-features__subtitle"><?php echo $r_col['feature_subtitle'] ?></div>

              <?php if ($r_col['feature_label']) : ?>
                <div class="mb-features__label"><?php echo $r_col['feature_label'] ?></div>
              <?php endif; ?>
            </div>

            <?php
            $r_video_mp4 = $r_col['video_mp4'] ?? '';
            $r_video_webm = $r_col['video_webm'] ?? '';
            $r_feature_img = $r_col['feature_img'] ?? '';
            $r_image_width = $r_col['image_width'] ?? '';
            $r_image_height = $r_col['image_height'] ?? '';
            $r_feature_buttons = $r_col['feature_buttons'] ?? '';
            ?>

            <?php if ($r_video_mp4 || $r_video_webm) : ?>
              <div class="mb-features__video-wrapper">
                <video class="mb-features__video" autoplay muted loop playsinline>
                  <?php if ($r_video_mp4) : ?>
                    <source src="<?php echo esc_url($r_video_mp4); ?>" type='video/mp4; codecs="hvc1"'>
                  <?php endif; ?>
                  <?php if ($r_video_webm) : ?>
                    <source src="<?php echo esc_url($r_video_webm); ?>" type="video/webm">
                  <?php endif; ?>
                </video>
              </div>
            <?php elseif ($r_feature_img) : ?>
              <div class="mb-features__image"><?php echo wp_get_attachment_image($r_feature_img, [$r_image_width, $r_image_height]) ?></div>
            <?php endif; ?>

            <?php
            if ($r_feature_buttons) : ?>
              <div class="mb-features__links">
                <?php foreach ($r_feature_buttons as $button) { ?>
                  <a class="mb-features__link" href="<?php echo $button['feature_button']['url'] ?>">
                    <div class="mb-features__button"><?php echo $button['feature_button']['title'] ?><span class="icon-arrow-right-up"></span></div>
                  </a>
                <?php } ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php } ?>

    <?php endwhile; ?>
  </section>
<?php endif; ?>

<?php get_template_part('template-parts/sections/account-benefits/account-benefits') ?>

<?php get_template_part('template-parts/sections/industries-section', 'industries-section', ['group_name' => 'industries_section']) ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php get_template_part('template-parts/sections/about-us-section') ?>

<?php get_template_part('template-parts/sections/get-started-section') ?>

<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section'); ?>

<?php get_template_part('template-parts/sections/faq-section') ?>

<?php get_template_part('template-parts/sections/callback-section') ?>

<?php get_template_part('template-parts/sections/contact-form-section') ?>

<?php get_footer(); ?>