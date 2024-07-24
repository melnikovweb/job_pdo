<?php
$group_name = $args['group_name'] ?? 'supported_countries';

if (have_rows($group_name)) :

    Enqueue::style('public/parts/supported-countries-section/supported-countries-section.css', [
        'is_root_path' => true
    ]);

    Enqueue::script('public/parts/supported-countries-section/supported-countries-section.js', [], [
        'is_root_path' => true
    ]);
?>

  <?php while (have_rows($group_name)) : the_row(); ?>
    <?php if (get_sub_field('displaying')) : ?>
                <section class="supported-countries-section container" data-theme="white">
                    <div class="section-header">
                        <div class="section-header__title">
                            <?php echo get_sub_field('section_title'); ?>
                        </div>

                        <div class="section-header__description">
                            <?php echo get_sub_field('section_description'); ?>
                        </div>
                    </div>

                    <?php foreach (CountryDataApi\get_supported_countries(get_sub_field('country_select')) as $region => $countries) : ?>
                        <div class="countries-wrap">
                            <div class="region-title">
                                <?php echo $region ?>
                            </div>

                            <div class="supported-countries-section__items" data-see-more="list">
                                <?php foreach ($countries as $country) : ?>
                                    <div class="supported-countries-section__item">
                                        <img src="<?php echo $country->flags->svg; ?>" alt="<?php echo $country->name->common; ?>" class="supported-countries-section__item-icon">
                                        <div class="supported-countries-section__item-title">
                                            <?php echo $country->name->common; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div data-button data-style="blue text" data-see-more="action">
                                    See more
                                </div>
                        </div>
                    <?php endforeach; ?>

                </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
