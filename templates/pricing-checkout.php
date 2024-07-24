<!--
    Template Name: Pricing for checkout
 -->

<?php

get_header();

Enqueue::style('public/views/pricing-checkout/pricing-checkout.css', [
  'is_root_path' => true,
]);

$main = Enqueue::script('public/views/pricing-checkout/pricing-checkout.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::SWIPER,
  FunctionPars\EnqueueScripts\GlobalScripts::CHOICES,
  FunctionPars\EnqueueScripts\GlobalScripts::DATATABLES
], [
  'is_root_path' => true,
]);

$mid_for_app = LandingDataApi\get_mid_for_app();
$type_filter_placeholder = get_field('payments_table')['type_filter_placeholder'];
$country_filter_placeholder = get_field('payments_table')['country_filter_placeholder'];

$main->localize('wpPageData', array(
  'typeFilterPlaceholder' => get_field('payments_table')['type_filter_placeholder'],
  'countryFilterPlaceholder' => get_field('payments_table')['country_filter_placeholder'],
  'midForApp' => $mid_for_app,
  'allCountries' => CountryDataApi\get_all_available_countries(),
));

set_header_theme(array(
  'background' => 'dark',
  'invert' => false
));

function typeToText($value)
{
  $text = str_replace('_', ' ', $value);

  return ucwords($text);
}

$pricing_for_checkout = get_posts([
  'posts_per_page' => -1,
  'post_type'      => 'pricing-for-checkout',
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

<?php if (have_rows('payments_table')) : ?>
  <?php while (have_rows('payments_table')) : the_row();
    $search_placeholder = get_sub_field('search_filter_placeholder');
  ?>
    <section class="payment-methods-table container" data-theme="dark">
      <filters-group class="payment-methods-filters">
        <button slot="button" data-button data-style="blue" class="icon-filter">Filter</button>

        <div class="payment-methods-filters__control" slot="filter">
          <div class="filters-search-wrapper icon-search">
            <input id="payment-methods-search" type="text" placeholder="<?php echo $search_placeholder ?>" />
          </div>
        </div>

        <div class="payment-methods-filters__control" slot="filter">
          <select id="payment-methods-types">
            <option value="">
              <?php echo $type_filter_placeholder ?>
            </option>
            <option value="All"><?php _e('All', 'SECRET-domain'); ?></option>
            <?php
            $payment_method_types = get_terms(array(
              'taxonomy'   => 'payment-method-type',
              'hide_empty' => true,
            ));

            foreach ($payment_method_types as $type) : ?>
              <option value="<?php echo ($type->name); ?>"><?php echo ($type->name); ?></option>
            <?php endforeach; ?>

          </select>
        </div>

        <div class="payment-methods-filters__control" slot="filter">
          <select id="payment-methods-countries">
            <option value="">
              <?php echo $country_filter_placeholder ?>
            </option>
          </select>
        </div>
      </filters-group>

      <table id="payment-methods-table">
        <thead>
          <tr>
            <?php if (have_rows('table_headers')) : ?>
              <?php while (have_rows('table_headers')) : the_row();
                $header = get_sub_field('text');
              ?>
                <th style="<?php echo (get_row_index() > 2 ? 'min-width: 200px;' : 'min-width: 400px;') ?>"><?php echo $header ?></th>
              <?php endwhile; ?>
              <th class="payment-methods__country-codes"><?php _e('Country Codes', 'SECRET-domain'); ?></th>
            <?php endif; ?>
          </tr>
        </thead>

        <tbody>
          <?php
          foreach ($pricing_for_checkout as $pricing) :

            $id = $pricing->ID;
            $transaction_fee = get_field('transaction_fee', $id) ?: "–";
            $refund_fee = get_field('refund_fee', $id) ?: "–";
            $countries = get_the_terms($id, 'payment-method-country');
            $child_country_codes = [];
            $countries_html = '';

            foreach ($countries as $country_parent) :

              if ($country_parent->parent === 0) {
                $countries_html .= '<div class="supported-countries__section" data-region="' . $country_parent->name . '">';

                $child_countries = [];

                foreach ($countries as $key => $country_child) :
                  if ($country_child->parent === $country_parent->term_id) {
                    array_push($child_countries, $country_child->name);
                    array_push($child_country_codes, $country_child->description);
                  }
                endforeach;

                $countries_html .=  join(', ', $child_countries);
                $countries_html .=  '</div>';
              }
            endforeach;
          ?>
            <tr>
              <td>
                <div class="payment-method-type">
                  <div class="payment-method-type__banner">
                    <?php echo (get_the_post_thumbnail($id)); ?>
                  </div>

                  <div class="payment-method-type__content">
                    <div class="payment-method-type__title">
                      <?php echo (get_the_title($id)); ?>
                    </div>

                    <div class="payment-method-type__description" data-type="">
                      <span hidden><?php echo get_the_terms($id, 'payment-method-type')[0]->name; ?></span>

                      <?php echo typeToText(get_the_terms($id, 'payment-method-type')[0]->name); ?>
                    </div>
                  </div>
                </div>
              </td>

              <td>
                <text-clamp>
                  <div class="supported-countries" slot="short">
                    <?php echo $countries_html ?>
                  </div>
                  <div class="supported-countries" slot="long">
                    <?php echo $countries_html ?>
                  </div>
                </text-clamp>
              </td>

              <td> <?php echo $transaction_fee; ?> </td>

              <td> <?php echo $refund_fee; ?> </td>

              <?php $country_codes =  join(', ', $child_country_codes); ?>
              <td class="payment-methods__country-codes"> <?php echo $country_codes; ?> </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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

<?php get_template_part('template-parts/sections/integration-section', 'integration-section') ?>

<?php get_template_part('template-parts/sections/all-payment-methods-section', 'all-payment-methods') ?>

<?php get_template_part('template-parts/sections/callback-section', 'callback-section', ['group_name' => 'next_step']) ?>

<?php get_footer(); ?>