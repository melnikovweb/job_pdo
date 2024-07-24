<!-- 
    Template Name: Pricing
 -->
<?php

get_header();

Enqueue::style('public/views/pricing/pricing.css', [
  'is_root_path' => true,
]);

$main = Enqueue::script('public/views/pricing/pricing.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::CHOICES
], [
  'is_root_path' => true,
]);

$country_filter_placeholder = __('Country', 'SECRET-domain');

$main->localize('wpPageData', array(
  'countryFilterPlaceholder' => $country_filter_placeholder,
  'allCountries' => CountryDataApi\get_all_available_countries(),
));

$personal_pricing_tiers = get_posts([
  'posts_per_page' => -1,
  'post_type'      => 'personal-pricing',
]);
?>

<section class="pp-banner" data-theme="dark">
  <h1 class="pp-banner__title"><?php the_title(); ?></h1>
</section>

<section class="pp-tabs" data-theme="dark">
  <tabs-group primary-theme="blue" secondary-theme="black" border-theme="white" is-single-shown="false">
    <tab-item label="Virtual banking">
      <div class="pp-tabs__container container" data-columns>
        <div class="pp-tabs__filters payment-methods-filters">
          <div class="payment-methods-filters__control">
            <select id="countries-filter">
              <option value="">
                <?php echo $country_filter_placeholder; ?>
              </option>
            </select>
          </div>
        </div>

        <div class="pp-tabs__content">
          <div class="pp-pricing-groups">
            <?php foreach ($personal_pricing_tiers as $pricing_tier) :
              $tier_id = $pricing_tier->ID;
              $pricing_terms = get_the_terms($tier_id, 'payment-method-country');
              $countries = array_filter($pricing_terms ? $pricing_terms : array(), fn ($country) => $country->parent != 0);
              $country_codes = array_map(fn ($country) => $country->description, $countries);
            ?>
              <div class="pp-pricing-groups__section" data-codes='<?php echo json_encode(array_values($country_codes)) ?>' data-id="<?php echo $pricing_tier->menu_order ?>">
                <?php if (have_rows('groups', $tier_id)) : ?>
                  <?php while (have_rows('groups', $tier_id)) : the_row();
                    $title = get_sub_field('title');
                    $notes = get_sub_field('notes');

                  ?>
                    <div class="pp-pricing-groups__group">
                      <?php if ($title) : ?>
                        <div class="pp-pricing-groups__header">
                          <h2 class="pp-pricing-groups__title"><?php echo $title ?></h2>
                        </div>
                      <?php endif; ?>

                      <div class="pp-pricing-groups__content">
                        <?php if (have_rows('items')) : ?>
                          <?php while (have_rows('items')) : the_row();
                            $name = get_sub_field('name');
                            $caption = get_sub_field('caption');
                            $value = get_sub_field('value');

                          ?>
                            <div class="pp-pricing-groups__item container" data-columns data-indent="none">
                              <?php if ($name) : ?>
                                <div class="pp-pricing-groups__name"><?php echo $name ?></div>
                              <?php endif; ?>

                              <?php if ($caption) : ?>
                                <div class="pp-pricing-groups__caption"><?php echo $caption ?></div>
                              <?php endif; ?>

                              <?php if ($value) : ?>
                                <div class="pp-pricing-groups__value"><?php echo $value ?></div>
                              <?php endif; ?>
                            </div>
                          <?php endwhile; ?>
                        <?php endif; ?>
                      </div>

                      <?php if ($notes) : ?>
                        <div class="pp-pricing-groups__notes"><?php echo $notes ?></div>
                      <?php endif; ?>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </tab-item>
  </tabs-group>
</section>

<?php get_template_part('template-parts/sections/callback-section', 'callback-section', ['group_name' => 'next_step']) ?>

<?php get_footer(); ?>