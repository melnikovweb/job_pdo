<?php
/*
    Template Name: legal-policies
    */

set_header_theme(array(
  'background' => 'black',
  'invert' => false
));

get_header();

Enqueue::style('public/views/legal-policies/legal-policies.css', [
  'is_root_path' => true,
]);
?>
<?php if (have_rows('licenses_section')) : ?>
  <?php while (have_rows('licenses_section')) : the_row();
    $licenses_title = get_sub_field('licenses_title');
  ?>
    <section class="licenses-header-section container" data-columns data-theme="dark">
      <div class="licenses-header-section__content">
        <div class="section-header">
          <h1 class="section-header__title">
            <?php echo $licenses_title ?>
          </h1>
        </div>
      </div>
      <div class="licenses-section">
        <div class="licenses-section__content">
          <?php while (have_rows('licenses')) : the_row();
            $icon = get_sub_field('icon');
            $name = get_sub_field('name');
            $description = get_sub_field('description');
          ?>
            <div class="licenses-section__item">
              <div class="licenses-section__license-name">
                <div class="licenses-section__img">
                  <?php echo wp_get_attachment_image($icon, 'icon-46', true, ['alt' => $name]); ?>
                </div>
                <h2 class="licenses-section__name">
                  <?php echo $name ?>
                </h2>
              </div>
              <div class="licenses-section__license-description">
                <?php echo $description ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php if (have_rows('legal_section')) : ?>
  <?php while (have_rows('legal_section')) : the_row();
    $legal_title = get_sub_field('legal_title');
  ?>
    <section class="legal-section-section" data-theme="dark">
      <div class="legal-section__header">
        <div class="section-header">
          <h1 class="section-header__title">
            <?php echo $legal_title ?>
          </h1>
        </div>
      </div>

      <div class="legal-section__content">
        <?php if (have_rows('tabs')) : ?>
          <tabs-group data-theme="dark" primary-theme="dark" secondary-theme="blue" border-theme="white">
            <span slot="icon" class="icon-chevron-down"></span>
            <?php while (have_rows('tabs')) : the_row(); ?>
              <tab-item class="tabs-item container" label="<?php the_sub_field('tabs_title') ?>">
                <div class="legal-section__links container" data-indent="none" data-columns>
                  <?php while (have_rows('links')) : the_row();
                    $link = get_sub_field('link');
                  ?>
                    <?php
                    if ($link) :
                      $link_url = $link['url'];
                      $link_title = $link['title'];
                      $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                      <a class="legal-section__link <?php echo $link_theme_classes ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                        <?php echo esc_html($link_title); ?>
                      </a>
                    <?php endif; ?>
                  <?php endwhile; ?>
                </div>
              </tab-item>
            <?php endwhile; ?>
          </tabs-group>
        <?php endif; ?>
      </div>

    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/callback-section', 'callback-section', ['group_name' => 'next_step']) ?>

<?php get_footer(); ?>
