<?php
// Template Name: Supported countries page

set_header_theme(array(
  'background' => 'white',
  'invert' => true
));

get_header();

Enqueue::style('public/views/supported-countries/supported-countries.css', [
  'is_root_path' => true,
]);

?>

<?php if (have_rows('base')) : ?>
  <?php while (have_rows('base')) : the_row(); ?>
    <div class="sc-supported-countries container" data-theme="white">
      <div class="sc-supported-countries__header">
        <div class="sc-supported-countries__title">
          <h1><?php the_sub_field('title') ?></h1>
        </div>

        <h2 class="sc-supported-countries__description"><?php the_sub_field('description') ?></h2>
      </div>

      <div class="sc-supported-countries__list">
        <?php foreach (CountryDataApi\get_countries(get_sub_field('country_select')) as $country) : ?>
          <div class="sc-supported-countries__item">
            <img src="<?php echo $country->flags->svg; ?>" alt="" class="sc-supported-countries__flag">

            <div class="sc-supported-countries__name">
              <?php echo $country->name->common; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
