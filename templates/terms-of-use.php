<?php
/*
    Template Name: Terms-of-use
    */

set_header_theme(array(
  'background' => 'black',
  'invert' => false
));

get_header();

Enqueue::style('public/views/terms-of-use/terms-of-use.css', [
  'is_root_path' => true,
]);

Enqueue::script('public/views/terms-of-use/terms-of-use.js', [], [
  'is_root_path' => true,
]);
?>


<section class="terms-header-section container" data-columns data-theme="dark">
  <div class="terms-header-section__content">
    <div class="section-header">
      <h1 class="section-header__title">
        <?php the_title(); ?>
      </h1>

      <div class="section-header__description">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</section>


<?php if (have_rows('term_of_use_section')) : ?>
  <?php while (have_rows('term_of_use_section')) : the_row();
    $back_button = get_sub_field('back_button');
    $terms_content = get_sub_field('terms_content');
    $terms_table = get_sub_field('terms_table');
  ?>
    <section class="terms-section container" data-columns data-theme="white">
      <div class="terms-section__container">
        <div class="terms-section__escape-button">

          <?php
          if ($back_button) :
            $link_url = $back_button['url'];
            $link_title = $back_button['title'];
            $link_target = $back_button['target'] ? $back_button['target'] : '_self';
          ?>
            <a class="terms-section__back-link " href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
              <span class="icon-arrow-left" style="font-size:24px;"></span>
              <?php echo esc_html($link_title); ?>
            </a>
          <?php endif; ?>
        </div>
        <div class="terms-content">
          <div class="terms-section__links">
            <?php while (have_rows('links')) : the_row();
              $link = get_sub_field('link');
              $is_current_page = get_sub_field('is_current_page');
            ?>
              <?php
              if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                $current_page_color = $is_current_page ? 'current' : '';
              ?>
                <a class="terms-section__link <?php echo $current_page_color ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                  <?php echo esc_html($link_title); ?>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
          <div class="one__select">
            <div class="one__select-top">
              <div class="one__select-top-title">
              </div>
              <svg width="48" height="49" viewBox="0 0 48 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5858 16.8329C11.3668 16.0518 12.6332 16.0518 13.4142 16.8329L24 27.4186L34.5858 16.8329C35.3668 16.0518 36.6332 16.0518 37.4142 16.8329C38.1953 17.6139 38.1953 18.8802 37.4142 19.6613L25.4142 31.6613C24.6332 32.4423 23.3668 32.4423 22.5858 31.6613L10.5858 19.6613C9.80474 18.8802 9.80474 17.6139 10.5858 16.8329Z" fill="white" />
              </svg>
            </div>
            <div class="one__select-bot">
              <?php while (have_rows('links')) : the_row();
                $link = get_sub_field('link');
              ?>
                <?php
                if ($link) :
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                  <a class="one__select-bot-item" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                    <?php echo esc_html($link_title); ?>
                  </a>
                <?php endif; ?>
              <?php endwhile; ?>
            </div>
          </div>
          <div class="terms-section__content">
            <?php if (have_rows('content')) : ?>
              <?php while (have_rows('content')) : the_row();
                $editor = get_sub_field('editor');
                $table = get_sub_field('table');
              ?>
                <?php if ($editor) : ?>
                  <div class="terms-section__text">
                    <?php echo $editor; ?>


                  </div>
                <?php endif; ?>

                <?php if ($table) : ?>
                  <div class="terms-section__table terms-table-content">
                    <?php echo $table; ?>
                  </div>
                <?php endif; ?>

              <?php endwhile; ?>
            <?php endif; ?>
          </div>

          <!---->
          <!--                    <div class="terms-section__text">                -->
          <!--                        --><?php //echo $terms_content; 
                                          ?>
          <!---->
          <!--                        <div class="terms-section__table terms-table-content">                -->
          <!--                            --><?php //echo $terms_table; 
                                              ?>
          <!--                        </div>-->
          <!--                    </div>-->

        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
