<!--
    Template Name: Pricing for business
 -->

<?php

set_header_theme(array(
  'background' => 'dark',
  'invert' => false
));

get_header();

Enqueue::style('public/views/pricing-business/pricing-business.css', [
  'is_root_path' => true,
]);

$main = Enqueue::script('public/views/pricing-business/pricing-business.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::SWIPER,
  FunctionPars\EnqueueScripts\GlobalScripts::CHOICES
], [
  'is_root_path' => true,
]);

$main->localize('pricingBusinessData', array(
  'industryFilter' => get_field('pricing_table')['industry_filter'],
  'countryFilter' => get_field('pricing_table')['country_filter'],
  'ageOfIncorporation' => get_field('pricing_table')['age_of_incorporation'],
  'turnoverFilter' => get_field('pricing_table')['turnover_filter'],
  'templateUrl' => get_template_directory_uri(),
  'allCountries' => CountryDataApi\get_all_available_countries(),
));

$pricing_business_tiers = get_posts([
  'posts_per_page' => -1,
  'post_type'      => 'pricing-for-business',
]);
?>

<section class="pricing-header-section container" data-columns data-theme="dark">
  <div class="pricing-header-section__content">
    <div class="section-header">
      <h1 class="section-header__title">
        <?php the_title(); ?>
      </h1>

      <div class="section-header__description">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</section>
<?php if (have_rows('pricing_table')) : ?>
  <?php while (have_rows('pricing_table')) : the_row();
    $pricing_table_items = get_sub_field('pricing_table_items');
  ?>
    <section class="pricing-section" data-theme="dark">
      <div class="container">

        <div class="pricing-business-header container" data-columns data-indent="none">
          <div class="pricing-business-header__content">
            <h1 class="pricing-business-header__title"><?php echo get_field('pricing_table')['pricing_table_header']['title'] ?></h1>
            <h2 class="pricing-business-header__description"><?php echo get_field('pricing_table')['pricing_table_header']['description'] ?></h2>
          </div>
        </div>

        <div class="pricing-business-filter payment-methods-filters">
          <div class="pricing-business-card">
            <div class="pricing-business-card__header">
              <?php echo get_field('pricing_table')['country_filter']['title'] ?>
            </div>

            <div class="pricing-business-card__content">
              <div class="payment-methods-filters__control">
                <select id="country-of-incorporation-filter">
                  <option value="">
                    <?php echo get_field('pricing_table')['country_filter']['placeholder'] ?>
                  </option>
                </select>
              </div>
            </div>
          </div>

          <div class="pricing-business-card">
            <div class="pricing-business-card__header">
              <?php echo get_field('pricing_table')['industry_filter']['title'] ?>
            </div>

            <div class="pricing-business-card__content">
              <div class="payment-methods-filters__control">
                <select id="industries-filter">
                  <option value="">
                    <?php echo get_field('pricing_table')['industry_filter']['placeholder'] ?>
                  </option>
                </select>
              </div>
            </div>
          </div>

          <div class="pricing-business-card">
            <div class="pricing-business-card__header">
              <?php echo get_field('pricing_table')['age_of_incorporation']['title'] ?>
            </div>

            <div class="pricing-business-card__content">
              <ul>
                <?php foreach (get_field('pricing_table')['age_of_incorporation']['items'] as $item) : ?>
                  <li>
                    <label for="radio-age<?php echo $item['tier'] ?>"><input id="radio-age<?php echo $item['tier'] ?>" name="age-of-incorporation-filter" type="radio" class="radio" value="<?php echo $item['tier'] ?>" />
                      <?php echo $item['title'] ?>
                    </label>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>

          <div class="pricing-business-card">
            <div class="pricing-business-card__header">
              <?php echo get_field('pricing_table')['turnover_filter']['title'] ?>
            </div>

            <div class="pricing-business-card__content">
              <ul>
                <?php foreach (get_field('pricing_table')['turnover_filter']['items'] as $item) : ?>
                  <li>
                    <label for="radio-turnover<?php echo $item['tier'] ?>">
                      <input id="radio-turnover<?php echo $item['tier'] ?>" name="turnover-filter" type="radio" class="radio" value="<?php echo $item['tier'] ?>" />

                      <?php echo $item['title'] ?>
                    </label>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="pricing-filters-data-wrapper">

          <?php foreach ($pricing_business_tiers as $pricing_tier) :
            $tier_id = $pricing_tier->menu_order;
            $post_id = $pricing_tier->ID;
          ?>
            <?php if (have_rows('groups', $post_id)) : ?>
              <?php while (have_rows('groups', $post_id)) : the_row();
                $title = get_sub_field('title');
                $notes = get_sub_field('notes');
              ?>

                <div class="pricing-filters-data" data-tier="tier_<?php echo $tier_id ?>">

                  <?php if (isset($title)) : ?>
                    <div class="pricing-filters-data__header">
                      <?php echo $title ?>
                    </div>
                  <?php endif; ?>

                  <div class="pricing-filters-data__items">
                    <?php if (have_rows('items')) : ?>
                      <?php while (have_rows('items')) : the_row();
                        $name = get_sub_field('name');
                        $caption = get_sub_field('caption');
                        $value = get_sub_field('value');
                      ?>
                        <div class="pricing-filters-data__item">
                          <div class="pricing-filters-data__item-label">
                              <?php if (!empty($name)) : ?>
                              <div class="pricing-filters-data__item-label-header has-content">
                                <?php echo $name ?>
                              </div>
                            <?php endif; ?>
                            <div class="pricing-filters-data__item-label-text">
                              <?php echo $caption ?>
                            </div>
                          </div>
                          <div class="pricing-filters-data__item-value">
                            <?php echo $value ?>
                          </div>
                        </div>
                      <?php endwhile; ?>
                      <?php if ($notes) : ?>
                        <div class="pricing-filters-data__items-notes"><?php echo $notes ?></div>
                      <?php endif; ?>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>

<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php if (have_rows('business_model')) : ?>
  <?php while (have_rows('business_model')) : the_row();
    $title = get_sub_field('title');
    $content = get_sub_field('content');
    $buttons = get_sub_field('buttons');
  ?>
    <?php if (get_sub_field('displaying') ?? true) : ?>
      <section class="business-model-section container" data-columns data-theme="blue">
        <div class="business-model-section__container">
          <div class="business-model-section__title">
            <?php echo $title ?>
          </div>

          <div class="business-model-section__content">
            <?php echo $content ?>
          </div>

          <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
            'block_name' => 'business-model-section',
            'buttons' => $buttons
          )) ?>
        </div>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('company_structure')) : ?>
  <?php while (have_rows('company_structure')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $complex_block = get_sub_field('complex');
    $group_block = get_sub_field('group');
  ?>
    <?php if (get_sub_field('displaying') ?? true) : ?>
      <div class="company-structure-section container" data-columns data-theme="dark">
        <div class="company-structure-section__header">
          <div class="company-structure-section__title">
            <?php echo $title ?>
          </div>

          <div class="company-structure-section__description">
            <?php echo $description ?>
          </div>
        </div>

        <div class="company-structure-section__groups">
          <div class="company-structure-section__group company-structure-group">
            <div class="company-structure-group__info">
              <div class="company-structure-group__title">
                <?php echo $complex_block['title'] ?>
              </div>

              <div class="company-structure-group__description">
                <?php echo $complex_block['description'] ?>
              </div>

              <div class="company-structure-group__price" data-prefix="from" data-currency="eur">
                <?php echo $complex_block['price'] ?>
              </div>
            </div>

            <div class="company-structure-group__chart">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/pricing-for-checkout/company-structure-inline.png' ?>" alt="">
            </div>
          </div>

          <div class="company-structure-section__group company-structure-group">
            <div class="company-structure-group__info">
              <div class="company-structure-group__title">
                <?php echo $group_block['title'] ?>
              </div>

              <div class="company-structure-group__description">
                <?php echo $group_block['description'] ?>
              </div>

              <div class="company-structure-group__price" data-prefix="from" data-currency="eur">
                <?php echo $group_block['price'] ?>
              </div>
            </div>

            <div class="company-structure-group__chart">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/pricing-for-checkout/company-structure-block.png' ?>" alt="">
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('currencies')) : ?>
  <?php while (have_rows('currencies')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $buttons = get_sub_field('buttons');
  ?>
    <section class="currencies-section container" data-theme="dark">
      <div class="currencies-section__header section-header">
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

      <div class="currencies-section__content">
        <div class="currencies-preview"></div>

        <div class="currencies-preview"></div>

        <div class="currencies-preview"></div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/callback-section', 'callback-section', ['group_name' => 'next_step']) ?>

<?php get_footer(); ?>
