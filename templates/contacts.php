<?php
// Template Name: Contacts

set_header_theme(array(
  'background' => 'dark',
  'invert' => true
));

get_header();

Enqueue::style('public/views/contacts/contacts.css', [
  'is_root_path' => true,
]);

$contacts = Enqueue::script('public/views/contacts/contacts.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::SWIPER
], [
  'is_root_path' => true,
]);
?>

<section class="cu-banner section-hero p-inline" data-theme="dark">
  <?php if ($conttitle = get_field('conttitle')) : ?>
    <div class="section-hero-top">
      <h1 class="cu-banner__heading anim-text-heading"><?php echo esc_html($conttitle); ?></h1>
    </div>
  <?php endif; ?>
</section>

<section class="cu-tabs container" data-columns data-theme="dark">
  <div class="cu-tabs__asside">
    <?php if (have_rows('contforms')) :
      $counter = 1;
    ?>
      <div class="swiper">
        <div class="swiper-wrapper">
          <?php while (have_rows('contforms')) : the_row(); ?>
            <?php $displaying = get_sub_field('displaying'); ?>
            <?php if ($displaying) : ?>
              <div class="swiper-slide cu-tabs__item-header<?php echo $counter == 1 ? ' active' : ''; ?>" data-tab-btn="tab-<?php echo $counter; ?>">
                <?php $icon = get_sub_field('icons_select'); ?>

                <?php if ($icon) : ?>
                  <div class="cu-tabs__item-header__icon icon-<?php echo $icon; ?>"></div>
                <?php endif; ?>

                <h2 class="cu-tabs__item-header__title"><?php the_sub_field('tab_title'); ?></h2>

                <div class="cu-tabs__item-header__desciption"><?php the_sub_field('tab_description'); ?></div>
              </div>
              <?php $counter++; ?>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class="cu-tabs__content">
    <?php if (have_rows('contforms')) :
      $counter = 1;
    ?>
      <?php while (have_rows('contforms')) : the_row(); ?>
        <?php $displaying = get_sub_field('displaying'); ?>
        <?php if ($displaying) : ?>
          <div class="cu-tabs__item-content<?php echo $counter == 1 ? ' active' : ''; ?>" data-tab-elem="tab-<?php echo $counter; ?>">
            <?php get_template_part('template-parts/components/contact-form', '', ['form_shortcode' => get_sub_field('form_shortcode')]) ?>
          </div>
        <?php endif; ?>
        <?php $counter++; ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</section>

<?php get_template_part('template-parts/sections/our-offices-section'); ?>

<?php get_footer(); ?>
