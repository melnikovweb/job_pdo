<?php
// Template Name: Payment schemes

set_header_theme(array(
  'background' => 'black',
  'invert' => false
));

get_header();

Enqueue::style('public/views/payment-schemes/payment-schemes.css', [
  'is_root_path' => true,
]);

$payment_schemes = Enqueue::script(
  'public/views/payment-schemes/payment-schemes.js',
  [FunctionPars\EnqueueScripts\GlobalScripts::SWIPER],
  ['is_root_path' => true,]
);

$payment_schemes->localize('paymentSchemesData', [
  'templateUrl' => get_template_directory_uri()
]);
?>

<?php get_template_part('template-parts/sections/primary-banner-section'); ?>

<?php get_template_part('template-parts/sections/benefits-section', 'benefits-section', get_field('benefits_section_numbers')) ?>

<?php if (have_rows('account-details')) : ?>
  <?php while (have_rows('account-details')) : the_row();
    $title = get_sub_field('section_title');
    $description = get_sub_field('section_description');
  ?>
    <section class="account-details container" data-theme="white">
      <div class="account-details__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>
      </div>

      <div class="countries" data-element="countries-list">
        <div class="countries__items" data-see-more="list">
          <?php $countries = get_sub_field('countries');
          if ($countries) : ?>
            <?php foreach ($countries as $item) : ?>
              <div class="countries__item">
                <div class="countries__icon">

                  <?php echo wp_get_attachment_image($item['icon'], 'icon-40', true, ['alt' => $item['title']]); ?>
                </div>

                <div class="countries__title">
                  <?php echo $item['title'] ?>
                </div>
              </div>
            <?php endforeach ?>
          <?php endif ?>
        </div>

        <div class="countries__action" data-button data-style="blue text" data-see-more="action">
          See more
        </div>
      </div>

    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('payment-schemes')) : ?>
  <?php while (have_rows('payment-schemes')) : the_row();
    $title = get_sub_field('section_title');
    $description = get_sub_field('section_description');
  ?>
    <section class="payment-schemes-table-header container" data-theme="blue">
      <div class="section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('payment-scheme-table')) : ?>
  <section class="payment-schemes-table container" data-theme="black">
    <?php while (have_rows('payment-scheme-table')) : the_row();
      $table_headers = get_sub_field('table_headers');
      $table_items = get_sub_field('table_items');
    ?>
      <div class="pricing__tabs">
        <div class="pricing__tab p-t-46">
          <div class="pricing__pays-top">
            <?php if ($table_headers) : ?>
              <?php foreach ($table_headers as $header) : ?>
                <div class="pricing__pays-top-item">
                  <?php echo $header ?>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

          <div class="pricing__pays">
            <?php if ($table_items) : ?>
              <?php foreach ($table_items as $item) : ?>
                <div class="pricing__pay">
                  <div class="pricing__pay-left">
                    <?php echo wp_get_attachment_image($item['col1']['icon'], 'img-120-64', false, ['class' => 'pricing__pay-left-img']); ?>
                    <div class="pricing__pay-left-text">
                      <?php if ($item['col1']['text']) : ?>
                        <span>
                          <?php echo $item['col1']['text'] ?>
                        </span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="pricing__pay-center" data-clamp="container">
                    <div class="pricing__pay-center-content" data-clamp="text">
                      <span>
                        <?php echo $item['col2'] ?>
                      </span>
                    </div>
                    <button class="more-info btn btn-primary" data-clamp="action" data-show-text="see more" data-hide-text="see less"></button>
                  </div>
                  <div class="pricing__pay-right" data-clamp="container">
                    <div class="pricing__pay-right-content" data-clamp="text">
                      <span>
                        <?php echo $item['col3'] ?>
                      </span>
                    </div>
                    <button class="more-info btn btn-primary" data-clamp="action" data-show-text="see more" data-hide-text="see less"></button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </section>
<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php if (have_rows('currencies')) : ?>
  <?php while (have_rows('currencies')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
  ?>
    <section class="currencies-section container" data-theme="black">
      <div class="currencies-section__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php if (have_rows('buttons')) : ?>
          <div class="section-header__actions">
            <?php while (have_rows('buttons')) : the_row();
              $theme = get_sub_field('theme');
              $is_outline = get_sub_field('is_outline');
              $link = get_sub_field('button');
              $link_style = $is_outline ? 'outline' : 'default';
              $link_options_map = (object) [
                'white' => (object) [
                  'default' => 'white',
                  'outline' => 'brdr brdr-white',
                ],
                'blue' => (object) [
                  'default' => 'blue',
                  'outline' => 'brdr brdr-blue',
                ],
                'black' => (object) [
                  'default' => 'black',
                  'outline' => 'brdr brdr-black',
                ],
              ];
              $link_theme_classes = $link_options_map->{$theme}->{$link_style};
            ?>
              <?php
              if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
              ?>
                <a class="section-header__button btn-def <?php echo $link_theme_classes ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                  <?php echo esc_html($link_title); ?>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="currencies-section__content">
        <div class="currencies-preview"></div>

        <div class="currencies-preview"></div>

        <div class="currencies-preview"></div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php

get_template_part('template-parts/sections/industries-section', 'industries-section');
get_template_part('template-parts/sections/get-started-section');
get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section');
get_template_part('template-parts/sections/faq-section');
get_template_part('template-parts/sections/callback-section');
get_footer();

?>
