<?php
// Template Name: Prohibited jurisdictions page

get_header();

Enqueue::style('public/views/prohibited-jurisdictions/prohibited-jurisdictions.css', [
  'is_root_path' => true,
]);

Enqueue::script('public/views/prohibited-jurisdictions/prohibited-jurisdictions.js', [], [
  'is_root_path' => true,
]);

?>

<div class="pj-page" data-theme="black">
  <?php if (have_rows('header')) : ?>
    <?php while (have_rows('header')) : the_row(); ?>
      <div class="pj-header container" data-columns>
        <div class="pj-header__title">
          <h1><?php the_sub_field('title'); ?></h1>
        </div>

        <h2 class="pj-header__description"><?php the_sub_field('description'); ?></h2>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php if (have_rows('tabs')) :
    $api_integration_map = [
      'onboarding' => [
        'countries' =>  CountryDataApi\get_prohibited_countries_for_onboarding(),
        'block_list' => CountryDataApi\get_raw_prohibited_subdivisions(),
      ],
      'incoming' => [
        'countries' =>  null,
        'block_list' => CountryDataApi\get_prohibited_subdivisions_for_outgoing(),
      ],
      'outgoing' => [
        'countries' => null,
        'block_list' => CountryDataApi\get_prohibited_subdivisions_for_outgoing(),
      ]
    ];

  ?>
    <tabs-group primary-theme="blue" secondary-theme="black" border-theme="white" data-theme="black">
      <span slot="icon" class="icon-chevron-down"></span>


      <?php while (have_rows('tabs')) : the_row();
        $is_api_integration = get_sub_field('api_integration');
        $integration_map_id = get_sub_field('section_id');

        $block_countries = CountryDataApi\get_countries(get_sub_field('block_list')['country_select']);

        $countries = $is_api_integration
          ? $api_integration_map[$integration_map_id]['countries']
          : CountryDataApi\get_countries(get_sub_field('country_select'));

        $block_list = $api_integration_map[$integration_map_id]['block_list'];
      ?>
        <tab-item label="<?php the_sub_field('name') ?>">
          <div class="pj-tab-content container" data-columns>
            <div class="pj-tab-content__caption"><?php the_sub_field('description') ?></div>

            <div class="pj-tab-content__filter">
              <label class="filters-search-wrapper icon-search">
                <input class="search-filter" type="text" placeholder="Search">
              </label>
            </div>

            <div class="pj-tab-content__countries pj-countries">
              <?php if (!empty($countries)) : ?>
                <div class="pj-empty-search-result" hidden>
                  <div class="pj-empty-search-result__header">
                    <div class="pj-empty-search-result__title">The country you are looking for is not in the prohibited list.</div>
                  </div>
                </div>

                <div class="pj-countries__content">
                  <div class="pj-countries__list">
                    <?php foreach ($countries as $country) :
                      $value = [
                        isset($country->name->common) ? strtolower($country->name->common) : '',
                        isset($country->name->official) ? strtolower($country->name->official) : '',
                        isset($country->cca2) ? strtolower($country->cca2) : '',
                        isset($country->cca3) ? strtolower($country->cca3) : '',
                      ];
                    ?>
                      <div class="pj-countries__item" data-value=<?php echo "'" . json_encode($value, JSON_HEX_APOS) . "'"; ?>>
                        <img src="<?php echo $country->flags->svg; ?>" alt="<?php echo $country->name->common; ?>" class="pj-countries__flag">

                        <div class="pj-countries__name">
                          <?php echo $country->name->common; ?>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>

                  <div class="pj-countries__caption">
                    <?php the_sub_field('notes') ?>
                  </div>
                </div>
              <?php endif; ?>

            </div>

            <?php if (!empty($block_list)) : ?>
              <div class="pj-tab-content__block-list pj-block-list">
                <div class="pj-block-list__title"><?php echo get_sub_field('block_list')['title']; ?></div>

                <div class="pj-block-list__content">
                  <?php foreach ($block_list as $item) : ?>
                    <div class="pj-block-list__item">
                      <?php echo $item->name; ?> (<?php echo $item->country->name; ?>)
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </tab-item>
      <?php endwhile; ?>
    </tabs-group>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
