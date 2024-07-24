<!--
  Template Name: Consumet duty
-->

<?php

set_header_theme(array(
  'background' => 'black',
  'invert' => false
));

get_header();

Enqueue::style('public/views/consumer-duty/consumer-duty.css', [
  'is_root_path' => true,
]);
?>

<div class="du-header container" data-columns data-theme="black">
  <div class="du-header__navigate-wrapper container" data-columns>
    <a href="#" class="du-header__nevigate-up icon-arrow-up"></a>
  </div>

  <div class="du-header__title">
    <?php the_title('<h1>', '</h1>'); ?>
  </div>

  <?php if (have_rows('content_navigation')) : ?>
    <?php while (have_rows('content_navigation')) : the_row();
      $navigation_title  = get_sub_field('title');
    ?>
      <nav class="du-header__navigation du-navigation">
        <?php if (have_rows('items')) : ?>
          <div class="du-navigation__title">
            <?php echo $navigation_title ?>
          </div>

          <div class="du-navigation__items">
            <?php while (have_rows('items')) : the_row(); ?>
              <div class="du-navigation__item">
                <?php
                $link = get_sub_field('link');

                if ($link) :
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                ?>
                  <a href="<?php echo esc_url($link_url); ?>" class="du-navigation__link icon-arrow-right">
                    <?php echo esc_html($link_title); ?>
                  </a>
                <?php endif; ?>

                <?php if (have_rows('sub_navigation')) : ?>
                  <ul class="du-navigation__sub-navigation">
                    <?php while (have_rows('sub_navigation')) : the_row(); ?>
                      <li class="du-navigation__sub-item icon-dot-separator">
                        <?php
                        $link = get_sub_field('link');

                        if ($link) :
                          $link_url = $link['url'];
                          $link_title = $link['title'];
                        ?>
                          <a href="<?php echo esc_url($link_url); ?>">
                            <?php echo esc_html($link_title); ?>
                          </a>
                        <?php endif; ?>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </nav>
    <?php endwhile; ?>
  <?php endif;; ?>
</div>

<?php if (have_rows('page_content')) : ?>
  <div class="du-page-content" data-theme="black">
    <?php while (have_rows('page_content')) : the_row();
      $anchor = get_sub_field('anchor');
    ?>
      <div id="<?php echo $anchor; ?>" class="du-page-content__section container" data-columns>
        <?php if (have_rows('content')) : ?>
          <?php while (have_rows('content')) : the_row();
            $editor = get_sub_field('editor');
            $table = get_sub_field('table');
          ?>
            <?php if ($editor) : ?>
              <div class="du-page-content__regular du-regular-content">
                <?php echo $editor; ?>
              </div>
            <?php endif; ?>

            <?php if ($table) : ?>
              <div class="du-page-content__table du-table-content">
                <?php echo $table ?>
              </div>
            <?php endif; ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_footer(); ?>
