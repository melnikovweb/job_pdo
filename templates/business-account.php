<?php
// Template Name: Business Account

set_header_theme(['background' => 'dark']);

get_header();

Enqueue::style('public/views/business-account/business-account.css', [
  'is_root_path' => true,
]);

$business_account = Enqueue::script('public/views/business-account/business-account.js', [], [
  'is_root_path' => true,
]);

$business_account->localize('businessAccountData', [
  "transfers" => get_field('transfers')['sections']
]);
?>

<?php get_template_part('template-parts/sections/banner-section', '', [
  'template_part' => 'template-parts/pages/business-account/animation'
]); ?>

<?php get_template_part('template-parts/sections/benefits-section', 'benefits-section', get_field('benefits_section_numbers')) ?>

<?php if (have_rows('transfers')) : ?>
  <?php while (have_rows('transfers')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $buttons = get_sub_field('buttons');
  ?>
    <section class="business-transfers container" data-theme="dark" data-element="business-transfers">
      <div class="business-transfers__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php if (isset($buttons)) : ?>
          <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
            'block_name' => 'section-header',
            'buttons' => $buttons
          )) ?>
        <?php endif; ?>
      </div>

      <?php if (have_rows('sections')) : ?>
        <div class="business-transfers__groups" data-see-more="list">
          <?php while (have_rows('sections')) : the_row();
            $logo = get_sub_field('logo');
            $title = get_sub_field('title');
            $caption = get_sub_field('caption');
            $currency_keys = get_sub_field('currency_select');
            $currencies_per_view = get_sub_field('currencies_per_view');
          ?>
            <div class="business-transfers__group">
              <?php if ($logo) : ?>
                <div class="business-transfers__name">
                  <div class="business-transfers__logo">
                    <img src="<?php echo esc_url($logo['sizes']['thumbnail']); ?>" alt="<?php echo $title; ?>" />
                  </div>

                  <?php echo $title ?>
                </div>
              <?php endif; ?>

              <div class="business-transfers__caption">
                <?php echo $caption  ?>
              </div>

              <?php if (is_array($currency_keys)) :
                $currencies = array_map(fn ($key) => CurrencyData\get_currency($key), $currency_keys);
              ?>
                <div class="business-transfers__countries ba-countries-block" data-json='<?php echo json_encode($currencies); ?>' data-items-per-view="<?php echo $currencies_per_view; ?>"></div>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>

        <button data-see-more="action" data-button data-style="black text" data-more="See more" data-less="See less">
          See more
        </button>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('ibans_section')) : ?>
  <?php while (have_rows('ibans_section')) : the_row();
    $title = get_sub_field('section_title');
    $description = get_sub_field('section_description');
  ?>
    <section class="iban container bg-black" data-theme="black">

      <div class="ibans-country__header">
        <div class="iban__title">
          <?php echo $title; ?>
        </div>

        <div class="iban__p"> <!-- todo - need to check why we use (p) -->
          <?php echo $description; ?>
        </div>
      </div>

      <?php if (have_rows('tables')) : ?>
        <?php while (have_rows('tables')) : the_row();
          $table_title = get_sub_field('table_title');
          $table_caption = get_sub_field('table_caption');
          $table_headers = get_sub_field('table_headers');
          $table_items = get_sub_field('table_items');
        ?>
          <div class="iban__type">
            <?php echo $table_title ?>
          </div>

          <div class="iban__type-text">
            <?php echo $table_caption ?>
          </div>

          <div class="iban__tabs">
            <div class="iban__tab p-t-46">

              <div class="iban__cols-header">
                <?php if ($table_headers) : ?>
                  <?php foreach ($table_headers as $header) : ?>
                    <!-- TODO: remove it from the admin -->
                    <?php if ($header !== 'Country') : ?>
                      <div class="iban__col-header"> <?php echo $header ?> </div>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

              <div class="iban__tab-rows">
                <?php if ($table_items) : ?>
                  <?php foreach ($table_items as $item) : ?>

                    <div class="iban__tab-row">
                      <div class="iban__tab-row-left">
                        <img src="<?php echo esc_url($item['col_1']['icon']['sizes']['thumbnail']); ?>" class="iban__tab-row-left-img" alt="<?php echo esc_attr($item['col_1']['icon']['alt']); ?>" />
                        <div class="iban__tab-row-left-text">
                          <?php if ($item['col_1']['text']) : ?>
                            <span>
                              <?php echo $item['col_1']['text'] ?>
                            </span>
                          <?php endif; ?>

                          <?php if ($item['col_1']['caption']) : ?>
                            <span>
                              <?php echo $item['col_1']['caption'] ?>
                            </span>
                          <?php endif; ?>

                          <?php if ($item['col_1']['caption2']) : ?>
                            <span>
                              <?php echo $item['col_1']['caption2'] ?>
                            </span>
                          <?php endif; ?>
                        </div>
                      </div>

                      <div class="iban__tab-row-center">
                        <?php if ($item['col_3']['text']) : ?>
                          <span>
                            <?php echo $item['col_3']['text'] ?>
                          </span>
                        <?php else : ?>
                          <p class="iban__tab-row-center-content lime">
                            coming soon
                          </p>
                        <?php endif; ?>
                      </div>

                      <div class="iban__tab-row-center">
                        <span>
                          <?php echo $item['col_4']['text'] ?>
                        </span>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>

        <?php endwhile; ?>
      <?php endif; ?>

    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/industries-section', 'industries-section') ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<!-- TODO: Have to be a template part -->
<?php if (have_rows('currencies')) : ?>
  <?php while (have_rows('currencies')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $list_of_currencies = get_sub_field('currency_select');
  ?>
    <section class="currencies-section container" data-theme="black">
      <div class="currencies-section__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => get_sub_field('buttons')
        )) ?>
      </div>

      <?php if ($list_of_currencies) : ?>
        <div class="currencies-section__content">
          <?php for ($index = 0; $index < 3; $index++) : ?>
            <div class="ticker-row<?php echo ($index % 2 !== 0) ? ' reverse' : '' ?>">
              <div class="ticker-row__wrapper">
                <?php foreach ($list_of_currencies as $key) :
                  $currency = CurrencyData\get_currency($key);
                ?>
                  <div class="currency-card">
                    <div class="currency-card__media">
                      <img src="<?php echo $currency->flag ?>" alt="<?php echo $currency->name; ?>">
                    </div>

                    <div class="currency-card__content">
                      <?php echo $currency->name; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="ticker-row__wrapper" area-hidden="true">
                <?php foreach ($list_of_currencies as $key) :
                  $currency = CurrencyData\get_currency($key);
                ?>
                  <div class="currency-card" area-hidden="true">
                    <div class="currency-card__media">
                      <img src="<?php echo $currency->flag ?>" alt="<?php echo $currency->name; ?>">
                    </div>

                    <div class="currency-card__content">
                      <?php echo $currency->name; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>


<?php get_template_part('template-parts/sections/get-started-section'); ?>

<?php get_template_part('template-parts/sections/post-recommendations-section'); ?>

<?php get_template_part('template-parts/sections/faq-section'); ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_footer() ?>
