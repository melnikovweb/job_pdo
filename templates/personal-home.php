<?php
// Template Name: Personal home page 

set_header_theme(array(
  'background' => 'black',
  'invert' => false
));

get_header();

Enqueue::style('public/views/personal-home/personal-home.css', [
  'is_root_path' => true,
]);
?>

<?php get_template_part('template-parts/sections/primary-banner-section'); ?>

<?php if (have_rows('second_repeater') and (get_field('second_section_display') == 'show')) : ?>
  <section class="hp-benefits container" data-columns data-theme="black">
    <?php while (have_rows('second_repeater')) : the_row();
      $text = get_sub_field('text');
    ?>
      <div class="hp-benefits__item">
        <?php echo $text; ?>
      </div>
    <?php endwhile; ?>
  </section>
<?php endif; ?>

<?php if (have_rows('transfers')) : ?>
  <?php while (have_rows('transfers')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $buttons = get_sub_field('buttons');
  ?>
    <div class="hp-transfers container" data-theme="blue">
      <div class="hp-transfers__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => $buttons
        )) ?>
      </div>

      <?php if (have_rows('sections')) : ?>
        <div class="hp-transfers__groups">
          <?php while (have_rows('sections')) : the_row();
            $logo_id = get_sub_field('logo');
            $currencies = get_sub_field('currency_select');
          ?>
            <div class="hp-transfers__group hp-transfer-group">
              <div class="hp-transfer-group__header">
                <div class="hp-transfer-group__logo">
                  <?php echo wp_get_attachment_image($logo_id, 'icon-80'); ?>
                </div>

                <div class="hp-transfer-group__title">
                  <?php the_sub_field('title'); ?>
                </div>
              </div>

              <div class="hp-transfer-group__caption">
                <?php the_sub_field('caption'); ?>
              </div>

              <div class="hp-transfer-group__items">
                <?php
                if ($currencies) : ?>
                  <?php foreach ($currencies as $key) :
                    $item = CurrencyData\get_currency($key);
                  ?>
                    <div class="hp-transfer-group__item" data-currency="<?php echo $item->currency ?>">
                      <div class="hp-transfer-group__img">
                        <img src="<?php echo esc_url($item->flag); ?>" alt="<?php echo esc_attr($item->name); ?>" />
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>

          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('currencies')) : ?>
  <?php while (have_rows('currencies')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $currencies = get_sub_field('currency_select');
  ?>
    <section class="hp-currencies-section container" data-theme="white">
      <div class="hp-currencies-section__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>
      </div>

      <?php if ($currencies) :
        $ROWS_AMOUNT = 2;
      ?>
        <div class="hp-currencies-section__content">
          <?php for ($index = 0; $index < $ROWS_AMOUNT; $index++) : ?>
            <div class="ticker-row<?php echo ($index % 2 !== 0) ? ' reverse' : '' ?>">
              <div class="ticker-row__wrapper" area-hidden="true">
                <?php foreach ($currencies as $key) :
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

              <div class="ticker-row__wrapper" area-hidden="true">
                <?php foreach ($currencies as $key) :
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




<?php if (have_rows('issuance_cards')) : ?>
  <?php while (have_rows('issuance_cards')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $buttons = get_sub_field('buttons');
    $image = get_sub_field('image');
    $video = get_sub_field('video');
  ?>
    <section class="hp-information-section container" data-theme="black">
      <div class="hp-information-section__header section-header">
        <div class="section-header__label">
          COMING SOON
        </div>

        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => $buttons
        )) ?>
      </div>

      <?php if (have_rows('media')) : ?>
        <?php while (have_rows('media')) : the_row(); ?>

          <div class="hp-information-section__media">
            <?php if (get_row_layout() == 'image') :
              $image_id = get_sub_field('image');
              echo wp_get_attachment_image($image_id, [1396, 786]);
            ?>
            <?php elseif (get_row_layout() == 'video') :
              $video = get_sub_field('video');
            ?>
              <?php echo $video ?>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

      <?php if (have_rows('sections')) : ?>
        <div class="hp-information-section__groups">
          <?php while (have_rows('sections')) : the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
          ?>
            <div class="hp-information-section__group">
              <div class="hp-information-section__name">
                <?php echo $title; ?>
              </div>

              <div class="hp-information-section__caption">
                <?php echo $description; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'list-of-countries-link', ['group_name' => 'list_of_countries_link']) ?>

<?php if (have_rows('money_flows_section')) : ?>
  <?php while (have_rows('money_flows_section')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
  ?>
    <section class="hp-money-flows container" data-columns data-theme="blue">
      <div class="hp-money-flows__header">
        <div class="hp-money-flows__title">
          <?php echo $title ?>
        </div>

        <div class="hp-money-flows__description">
          <?php echo $description ?>
        </div>
      </div>

      <?php if (have_rows('groups')) : ?>
        <div class="hp-money-flows__groups">
          <?php while (have_rows('groups')) : the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
          ?>
            <div class="hp-money-flows__group">
              <div class="hp-money-flows__name">
                <?php echo $title ?>
              </div>

              <div class="hp-money-flows__caption">
                <?php echo $description ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('shopping')) : ?>
  <?php while (have_rows('shopping')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $image = get_sub_field('image');
    $video = get_sub_field('video');
    $buttons = get_sub_field('buttons');
  ?>
    <section class="hp-information-section container" data-theme="black">
      <div class="hp-information-section__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => $buttons
        )) ?>
      </div>

      <?php if (have_rows('media')) : ?>
        <?php while (have_rows('media')) : the_row(); ?>

          <div class="hp-information-section__media">
            <?php if (get_row_layout() == 'image') :
              $image = get_sub_field('image');
            ?>
              <img src="<?php echo $image ?>" alt="">
            <?php elseif (get_row_layout() == 'video') :
              $video = get_sub_field('video');
            ?>
              <?php echo $video ?>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

      <?php if (have_rows('sections')) : ?>
        <div class="hp-information-section__groups">
          <?php while (have_rows('sections')) : the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
          ?>
            <div class="hp-information-section__group">
              <div class="hp-information-section__name">
                <?php echo $title; ?>
              </div>

              <div class="hp-information-section__caption">
                <?php echo $description; ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('get_started')) : ?>
  <?php while (have_rows('get_started')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $buttons = get_sub_field('buttons');
  ?>

    <section class="hp-get-started container" data-theme="blue">
      <div class="hp-get-started__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => $buttons
        )) ?>
      </div>

      <?php if (have_rows('groups')) : ?>
        <div class="stepper">
          <?php while (have_rows('groups')) : the_row();
            $text = get_sub_field('text');
          ?>
            <div class="stepper__step">
              <?php echo $text ?>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php if (have_rows('advanced_verification')) : the_row();
  $title = get_sub_field('title');
  $text = get_sub_field('text');
  $notes = get_sub_field('notes');
  $buttons = get_sub_field('buttons');
?>
  <section class="hp-advanced-verification container" data-theme="black">
    <div class="hp-advanced-verification__header">
      <div class="hp-advanced-verification__title">
        <?php echo $title ?>
      </div>

      <div class="hp-advanced-verification__description">
        <?php echo $text ?>
      </div>

      <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
        'block_name' => 'hp-advanced-verification',
        'buttons' => $buttons
      )) ?>
    </div>

    <?php if (have_rows('table')) : ?>
      <?php while (have_rows('table')) : the_row();
        $basic_column_title = get_sub_field('basic_column_title');
        $pro_column_title = get_sub_field('pro_column_title');
      ?>
        <div class="hp-advanced-verification__table">
          <div class="hp-advanced-verification__row">
            <div class="hp-advanced-verification__cell empty" data-style="header"></div>

            <div class="hp-advanced-verification__cell" data-style="header">
              <div class="hp-advanced-verification__name">
                <?php echo $basic_column_title ?>
              </div>
            </div>

            <div class="hp-advanced-verification__cell" data-style="header">
              <div class="hp-advanced-verification__name">
                <?php echo $pro_column_title ?>
              </div>
            </div>
          </div>

          <?php if (have_rows('groups')) : ?>
            <?php while (have_rows('groups')) : the_row(); ?>
              <div class="hp-advanced-verification__row">
                <?php if (have_rows('rows')) : ?>
                  <?php while (have_rows('rows')) : the_row();
                    $name = get_sub_field('name');
                    $is_capital_name = get_sub_field('is_capital_name');
                    $is_value_exist = get_sub_field('has_content');
                    $name_style = $is_capital_name ? 'headline' : 'default';
                  ?>
                    <div class="hp-advanced-verification__cell" data-style="<?php echo $name_style ?>">
                      <div class="hp-advanced-verification__name">
                        <?php echo $name ?>
                      </div>
                    </div>

                    <div class="hp-advanced-verification__cell<?php echo $is_value_exist ? '' : ' empty' ?>" data-style="value">
                      <?php if ($is_value_exist) : ?>
                        <?php if (have_rows('basic_column')) : ?>
                          <?php while (have_rows('basic_column')) : the_row();
                            $layout = get_row_layout();
                          ?>
                            <?php if ($layout == 'text') :
                              $text = get_sub_field('text');
                            ?>
                              <div class="hp-advanced-verification__name">
                                <?php echo $text ?>
                              </div>
                            <?php elseif ($layout == 'checkbox') :
                              $is_included = get_sub_field('checkbox');
                            ?>
                              <div class="hp-advanced-verification__marker <?php echo $is_included ? 'icon-check-circle checked' : 'icon-minus' ?>"></div>
                            <?php endif; ?>
                          <?php endwhile; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>

                    <div class="hp-advanced-verification__cell<?php echo $is_value_exist ? '' : ' empty' ?>" data-style="value">
                      <?php if ($is_value_exist) : ?>
                        <?php if (have_rows('pro_column')) : ?>
                          <?php while (have_rows('pro_column')) : the_row();
                            $layout = get_row_layout();
                          ?>
                            <?php if ($layout == 'text') :
                              $text = get_sub_field('text');
                            ?>
                              <div class="hp-advanced-verification__name">
                                <?php echo $text ?>
                              </div>
                            <?php elseif ($layout == 'checkbox') :
                              $is_included = get_sub_field('checkbox');
                            ?>
                              <div class="hp-advanced-verification__marker <?php echo $is_included ? 'icon-check-circle checked' : 'icon-minus' ?>"></div>
                            <?php endif; ?>
                          <?php endwhile; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>

    <?php if (have_rows('notes')) : ?>
      <div class="hp-advanced-verification__notes">
        <?php while (have_rows('notes')) : the_row();
          $text = get_sub_field('note');
        ?>
          <div class="hp-advanced-verification__note">
            <?php echo $text; ?>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>

<?php get_template_part('template-parts/sections/post-recommendations-section'); ?>

<?php get_template_part('template-parts/sections/faq-section'); ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_footer(); ?>
