<?php
// Template Name: Checkout

set_header_theme(array(
  'background' => 'black',
  'invert' => false
));

get_header();

Enqueue::style('public/views/checkout/checkout.css', [
  'is_root_path' => true,
]);

Enqueue::script('public/views/checkout/checkout.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::SWIPER
], [
  'is_root_path' => true,
]);
?>

<?php get_template_part('template-parts/sections/banner-section', '', []); ?>

<?php get_template_part('template-parts/sections/benefits-section', 'benefits-section', get_field('benefits_section_numbers')) ?>

<?php if (have_rows('benefits-section')) : ?>
  <?php while (have_rows('benefits-section')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $button = get_sub_field('buttons');
  ?>
    <section class="benefits-section container" data-theme="black">
      <div class="benefits-section__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => get_sub_field('buttons'),
        )) ?>
      </div>
    </section>

    <section class="benefits-section-tabs" data-theme="dark">
      <tabs-group primary-theme="dark" secondary-theme="blue" border-theme="white">
        <span slot="icon" class="icon-chevron-down"></span>
        <?php while (have_rows('tabs')) : the_row(); ?>
          <tab-item label="<?php the_sub_field('tabs_title'); ?>">
            <?php if (have_rows('tabs_content')) : the_row();
              $title = get_sub_field('title');
              $description = get_sub_field('description');
              $sub_description = get_sub_field('sub_description');
            ?>
              <section class="money-flows container" data-columns>
                <div class="money-flows__header">
                  <div class="money-flows__title">
                    <?php echo $title ?>
                  </div>

                  <div class="money-flows__description">
                    <?php echo $description ?>
                  </div>
                </div>

                <?php if (have_rows('groups')) : ?>
                  <div class="money-flows__groups">
                    <?php while (have_rows('groups')) : the_row();
                      $title = get_sub_field('title');
                      $description = get_sub_field('description');

                    ?>
                      <div class="money-flows__group">
                        <div class="money-flows__name">
                          <?php echo $title ?>
                        </div>

                        <div class="money-flows__caption">
                          <?php echo $description ?>
                        </div>
                      </div>
                    <?php endwhile; ?>
                    <?php if ($sub_description) : ?>
                      <div class="money-flows__footnote">
                        <div class="money-flows__footnote-description">
                          <?php echo $sub_description ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </section>
            <?php endif; ?>
          </tab-item>
        <?php endwhile; ?>
      </tabs-group>
    </section>
  <?php endwhile; ?>
<?php endif; ?>


<?php if (have_rows('video-guide-section')) : ?>
  <?php while (have_rows('video-guide-section')) : the_row();
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $image = get_sub_field('image');
    $video = get_sub_field('video');
  ?>
    <section class="video-guide-section container" data-theme="white">
      <div class="video-guide-section__header section-header">
        <div class="section-header__title">
          <?php echo $title; ?>
        </div>

        <div class="section-header__description">
          <?php echo $description; ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => get_sub_field('buttons'),
        )) ?>
      </div>

      <?php if (have_rows('media')) : ?>
        <?php while (have_rows('media')) : the_row(); ?>

          <div class="video-guide-section__media">
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

    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/all-payment-methods-section', 'all-payment-methods') ?>

<?php get_template_part('template-parts/sections/industries-section', 'industries-section') ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php get_template_part('template-parts/sections/integration-section', 'integration-section') ?>

<?php get_template_part('template-parts/sections/get-started-section', 'get-started-section') ?>

<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section'); ?>

<?php get_template_part('template-parts/sections/faq-section'); ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_template_part('template-parts/sections/contact-form-section') ?>

<?php get_footer(); ?>
