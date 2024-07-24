<?php
// Template Name: Businesses we serve

set_header_theme(array(
  'background' => 'black'
));

get_header();

Enqueue::style('public/views/businesses-we-serve/businesses-we-serve.css', [
  'is_root_path' => true,
]);
?>

<?php get_template_part('template-parts/sections/banner-section'); ?>

<?php if (have_rows('benefits_section_numbers')) : ?>
  <section class="bw-numbers-benefits container" data-theme="black">
    <div class="bw-numbers-benefits__items">
      <?php while (have_rows('benefits_section_numbers')) : the_row(); ?>
        <article class="bw-numbers-benefits__item">
          <div class="bw-numbers-benefits__item-number">
            <?php the_sub_field('title'); ?>
          </div>
          <div class="bw-numbers-benefits__item-text">
            <?php the_sub_field('description'); ?>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
  </section>
<?php endif; ?>

<?php if (have_rows('offers')) : ?>
  <?php while (have_rows('offers')) : the_row(); ?>
    <section class="offers bg-blue" data-theme="blue">
      <div class="offers-header container">
        <div class="offers-header__title">
          <?php the_sub_field('title'); ?>
        </div>

        <div class="offers-header__description">
          <?php the_sub_field('description'); ?>
        </div>
      </div>
    </section>

    <?php if (have_rows('tabs')) : ?>
      <tabs-group primary-theme="dark" secondary-theme="blue" border-theme="white">
        <span slot="icon" class="icon-chevron-down"></span>
        <?php while (have_rows('tabs')) : the_row(); ?>
          <tab-item class="tabs-item container" label="<?php the_sub_field('title'); ?>" data-indent="none">
            <?php if (have_rows('sections')) : ?>
              <?php while (have_rows('sections')) : the_row(); ?>
                <?php
                get_template_part('template-parts/sections/industries-section');
                get_template_part('template-parts/sections/request-solution');
                get_template_part('template-parts/sections/all-payment-methods-section');
                get_template_part('template-parts/sections/integration-section');
                get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']);
                ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </tab-item>
        <?php endwhile; ?>
      </tabs-group>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>

<?php
get_template_part('template-parts/sections/get-started-section');
get_template_part('template-parts/sections/about-us-section');
get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section');
get_template_part('template-parts/sections/faq-section');
get_template_part('template-parts/sections/callback-section');
get_footer();
?>
