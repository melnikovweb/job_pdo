<?php
// Template Name: Payment methods list

set_header_theme(array(
  'background' => 'white',
  'invert' => true
));

get_header();

Enqueue::style('public/views/payment-methods-list/payment-methods-list.css', [
  'is_root_path' => true,
]);

$main = Enqueue::script('public/views/payment-methods-list/payment-methods-list.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::SWIPER,
  FunctionPars\EnqueueScripts\GlobalScripts::CHOICES,
  FunctionPars\EnqueueScripts\GlobalScripts::DATATABLES
], [
  'is_root_path' => true,
]);

$mid_for_app = LandingDataApi\get_mid_for_app();
$country_filter_placeholder = get_field('payments_table')['country_filter_placeholder'];
$currency_filter_placeholder = get_field('payments_table')['currency_filter_placeholder'];
$search_placeholder =  get_field('payments_table')['search_filter_placeholder'];
$table_title =  get_field('payments_table')['table_title'];
$table_description =  get_field('payments_table')['table_description'];

$available_countries = CountryDataApi\get_all_available_countries();

$main->localize('wpPageData', array(
  'countryFilterPlaceholder' => get_field('payments_table')['country_filter_placeholder'],
  'currencyFilterPlaceholder' => get_field('payments_table')['currency_filter_placeholder'],
  'midForApp' => $mid_for_app,
  'allCountries' => $available_countries,
  'allRegions' => CountryDataApi\get_countries_region($available_countries),
));

function typeToText($value)
{
  $text = str_replace('_', ' ', $value);

  return ucwords($text);
}
?>

<?php get_template_part('template-parts/sections/banner-section', '', array(
  'theme' => 'white',
  'template_part' => 'template-parts/pages/payment-methods-list/animation'
)); ?>

<?php get_template_part('template-parts/sections/benefits-section', 'benefits-section', get_field('benefits_section_numbers')) ?>

<?php if (have_rows('popular_pm_section')) : ?>
  <?php while (have_rows('popular_pm_section')) : the_row();
    $header = get_sub_field('header');
  ?>
    <section class="popular-pm-section container" data-columns data-theme="blue">
      <div class="popular-pm-section__header">
        <?php echo $header; ?>
      </div>
      <div class="popular-pm-section__groups">
        <?php while (have_rows('popular_pms')) : the_row();
          $icon = get_sub_field('icon');
          $title = get_sub_field('title');
          $description = get_sub_field('description');
        ?>
          <div class="popular-pm-section__group">
            <div class="popular-pm-section__icon">
              <img src="<?php echo esc_url($icon['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
            </div>
            <div class="popular-pm-section__name">
              <?php echo $title; ?>
            </div>
            <div class="popular-pm-section__caption">
              <?php echo $description; ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('payments_table')) : ?>
  <?php while (have_rows('payments_table')) : the_row();
  ?>
    <?php if (get_sub_field('displaying')) : ?>
      <section class="payment-methods-table container" data-theme="dark">

        <div class="pm-header-section">
          <div class="section-header">
            <h1 class="section-header__title">
              <?php echo $table_title ?>
            </h1>

            <div class="section-header__description">
              <?php echo $table_description ?>
            </div>
          </div>
        </div>

        <filters-group class="payment-methods-filters payment-methods-list-filters">
          <button slot="button" data-button data-style="blue" class="icon-filter">Filter</button>

          <div class="payment-methods-filters__control" slot="filter">
            <div class="filters-search-wrapper icon-search">
              <input id="payment-methods-search" type="text" placeholder="<?php echo $search_placeholder ?>" />
            </div>
          </div>

          <div class="payment-methods-filters__control" slot="filter">
            <select id="payment-methods-countries">
              <option value="">
                <?php echo $country_filter_placeholder ?>
              </option>
            </select>
          </div>

          <div class="payment-methods-filters__control" slot="filter">
            <select id="payment-methods-currency">
              <option value="">
                <?php echo $currency_filter_placeholder ?>
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
                  $width = get_sub_field('width');
                ?>
                  <th style="min-width: <?php echo $width ?>px;
      width: <?php echo $width ?>px;"><?php echo $header ?></th>
                <?php endwhile; ?>
              <?php endif; ?>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($mid_for_app as $value) :
              $payment_method = $value->paymentMethod;
              $geo_information = $payment_method->geoInformation;
              $currencies = $payment_method->currencies;

              $countries = CountryDataApi\get_countries($geo_information->countries);

              $regions = CountryDataApi\get_countries_region($countries);

              $countries_sections = array_map(function ($region, $countries) {
                $names = array_map(fn ($item) => $item->name->common, $countries);

                $block_start = '<div class="supported-countries__section" data-region="' . $region . '">';
                $block_end = '</div>';

                return $block_start . join(', ', $names) . $block_end;
              }, array_keys($regions), $regions);

            ?>
              <tr>
                <td>
                  <div class="payment-method-type">
                    <div class="payment-method-type__banner">
                      <img src="<?php echo $payment_method->logo ?>" alt="" />
                    </div>

                    <div class="payment-method-type__content">
                      <div class="payment-method-type__title">
                        <?php echo $payment_method->title ?>
                      </div>

                      <div class="payment-method-type__description" data-type="">
                        <span hidden><?php echo $payment_method->type; ?></span>

                        <?php echo typeToText($payment_method->type); ?>
                      </div>
                    </div>
                  </div>
                </td>

                <td>
                  <text-clamp>
                    <div class="supported-countries" slot="short">
                      <?php echo join('', array_values($countries_sections)) ?>
                    </div>

                    <div class="supported-countries" slot="long">
                      <?php echo join(' ', array_values($countries_sections)) ?>
                    </div>
                  </text-clamp>
                </td>

                <td>
                  <?php echo join(', ', array_values($currencies)) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </section>
    <?php endif; ?>

  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php get_template_part('template-parts/sections/integration-section', 'integration-section') ?>
<?php get_template_part('template-parts/sections/industries-section', 'industries-section') ?>
<?php get_template_part('template-parts/sections/get-started-section', 'get-started-section') ?>
<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section'); ?>
<?php get_template_part('template-parts/sections/faq-section'); ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_footer(); ?>
