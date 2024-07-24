<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SECRET
 */

Enqueue::style('public/parts/footer/footer.css', [
  'is_root_path' => true
]);

$page_type = get_field('what_section');
$geo_location = get_field('geo_location', 'options');
$hide_all_navigation = get_field('hide_all_navigation');

$footer = Enqueue::script('public/parts/footer/footer.js', [], [
  'is_root_path' => true
]);

if ($geo_location) {
  $footer->localize('SECRETGeoLocation', [
    'urlWithId' => $geo_location['url_with_id']
  ]);
}
?>

</main>

<footer class="ft-footer-container container" data-columns data-theme="dark">
  <?php if (have_rows('footer_options', 'options')) : ?>
    <?php while (have_rows('footer_options', 'options')) : the_row();
      $logo = get_sub_field('logo');
    ?>
      <div class="ft-footer-container__section">
        <div class="ft-header">
          <?php if (!empty($logo)) : ?>
            <div class="ft-header__logo">
              <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
            </div>
          <?php endif; ?>

          <?php if (!$hide_all_navigation && have_rows('navigation')) : ?>
            <nav class="ft-header__navigation">
              <?php while (have_rows('navigation')) : the_row();
                $link_type = get_sub_field('what_section');
                $link = get_sub_field('link');
              ?>
                <?php
                if ($link) :
                  $active_class = $link_type == $page_type ? 'active' : '';
                ?>
                  <a class="ft-header__link <?php echo $active_class; ?>" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?? '_self'); ?>">
                    <?php echo esc_html($link['title']); ?>
                  </a>
                <?php endif; ?>
              <?php endwhile; ?>
            </nav>
          <?php endif; ?>

          <?php if (have_rows('social_networks')) : ?>
            <div class="ft-header__social-networks">
              <?php while (have_rows('social_networks')) : the_row();
                $field_type = get_sub_field('field_type');
                $icon_class = 'icon-' . get_sub_field('network');
                $href = ($field_type == 'email') ? ('mailto:' . get_sub_field('email')) : get_sub_field('link');
              ?>
                <a href="<?php echo $href; ?>" class="ft-header__social-network <?php echo $icon_class ?>" target="_blank" rel="nofollow noopener noreferrer" alt="<?php get_sub_field('network'); ?>"></a>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php if (have_rows('footer_subscribe', 'options')) : ?>
    <?php while (have_rows('footer_subscribe', 'options')) : the_row(); ?>
      <?php if (get_sub_field('displaying')) : ?>
        <div class="ft-footer-container__section">
          <div class="ft-subscribe container" data-columns data-indent="none">
            <div class="ft-subscribe__title"><?php the_sub_field('title') ?></div>

            <div class="ft-subscribe__form">
              <?php
              $field = '[newsletter_field label="" name="email" placeholder="' . get_sub_field('placeholder') . '"]';
              $form = '[newsletter_form id="footer-subscribe-form" button_label="' . __('Subscribe', 'SECRET-domain') . '"]' . $field . ' [/newsletter_form]';

              echo do_shortcode($form);
              ?>

              <button class="ft-subscribe__button" type="submit" data-button data-style="blue" form="footer-subscribe-form">
                <?php the_sub_field('button_label') ?>
              </button>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php if (!$hide_all_navigation) : ?>
    <div class="ft-footer-container__section">
      <?php if ($page_type == 'Personal') : ?>
        <?php if (have_rows('personal_navigation', 'options')) : ?>
          <nav class="ft-navigation">
            <?php while (have_rows('personal_navigation', 'options')) : the_row(); ?>
              <div class="ft-navigation__group" data-footer-navigation="container">
                <div class="ft-navigation__title icon-chevron-down" data-footer-navigation="button"> <?php the_sub_field('title') ?> </div>

                <?php if (have_rows('links')) : ?>
                  <div class="ft-navigation__items" data-footer-navigation="list">
                    <?php while (have_rows('links')) : the_row();
                      $link = get_sub_field('link');
                    ?>
                      <?php if ($link) : ?>
                        <a class="ft-navigation__item" href="<?php echo esc_url($link['url']); ?>" target="<?php echo ($link['target'] ?? '_self') ?>">
                          <?php echo esc_html($link['title']); ?>
                        </a>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </nav>
        <?php endif; ?>
      <?php else : ?>
        <?php if (have_rows('business_navigation', 'options')) : ?>
          <nav class="ft-navigation">
            <?php while (have_rows('business_navigation', 'options')) : the_row(); ?>
              <div class="ft-navigation__group" data-footer-navigation="container">
                <div class="ft-navigation__title icon-chevron-down" data-footer-navigation="button"> <?php the_sub_field('title') ?> </div>

                <?php if (have_rows('links')) : ?>
                  <div class="ft-navigation__items" data-footer-navigation="list">
                    <?php while (have_rows('links')) : the_row();
                      $link = get_sub_field('link');
                    ?>
                      <?php if ($link) : ?>
                        <a class="ft-navigation__item" href="<?php echo esc_url($link['url']); ?>" target="<?php echo ($link['target'] ?? '_self') ?>">
                          <?php echo esc_html($link['title']); ?>
                        </a>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </nav>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="ft-footer-container__section">
    <?php
    $images = get_field('footer_services', 'options');

    if ($images) : ?>
      <div class="ft-services">
        <?php foreach ($images as $image_id) : ?>
          <div class="ft-services__item">
            <?php echo wp_get_attachment_image($image_id, 'footer-icon', true) ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if (have_rows('geo_target', 'options')) : ?>
    <div id="geo-target-container" class="ft-footer-container__section">
      <?php while (have_rows('geo_target', 'options')) : the_row();
        ob_start();

        get_template_part('template-footer-parts/components/geo-target');

        $shortcode_content = ob_get_clean();

        $id = 'id="' . get_sub_field('target_id') . '"';
        $content_type = 'content="' . get_sub_field('content_type') . '"';
        $shortcode = '[geotargetlygeocontentwrap ' . $id . ' ' . $content_type . ']' . $shortcode_content . '[/geotargetlygeocontentwrap]';
      ?>
        <?php echo do_shortcode($shortcode); ?>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</footer>

</div>

<?php wp_footer(); ?>
</body>

</html>