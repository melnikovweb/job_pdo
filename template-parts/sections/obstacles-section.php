<?php if (have_rows('obstacles_section')) :

  Enqueue::style('public/parts/obstacles-section/obstacles-section.css', [
    'is_root_path' => true,
  ]);

  Enqueue::script('public/parts/obstacles-section/obstacles-section.js', [
    FunctionPars\EnqueueScripts\GlobalScripts::SWIPER
  ], [
    'is_root_path' => true
  ]);

?>
  <?php while (have_rows('obstacles_section')) : the_row(); ?>
    <?php if (get_sub_field('displaying')) : ?>
      <section class="obstacles-section container" data-theme="dark">
        <?php $title = get_sub_field('title') ?? ''; ?>
        <?php if ($title) : ?>
          <div class="obstacles-section__title"><?php echo wp_kses_post($title); ?></div>
        <?php endif; ?>

        <?php if (have_rows('cards')) : ?>
          <div class="obstacles-section__cards" id="obstacles-cards">
            <div class="swiper">
              <div class="swiper-wrapper">

                <?php while (have_rows('cards')) : the_row(); ?>
                  <div class="obstacles-section__card swiper-slide">
                    <?php $name = get_sub_field('name') ?? ''; ?>
                    <?php if ($name) : ?>
                      <div class="obstacles-section__card-name"><?php echo wp_kses_post($name); ?></div>
                    <?php endif; ?>

                    <?php if (have_rows('items')) : ?>
                      <div class="obstacles-section__card-items">
                        <?php while (have_rows('items')) : the_row(); ?>
                          <?php
                          $card_title = get_sub_field('title') ?? '';
                          $card_description  = get_sub_field('description') ?? '';
                          ?>
                          <div class="obstacles-section__card-item">
                            <?php if ($card_title) : ?>
                              <div class="obstacles-section__card-title"><?php echo esc_html($card_title); ?></div>
                            <?php endif; ?>

                            <?php if ($card_description) : ?>
                              <div class="obstacles-section__card-description"><?php echo esc_html($card_description); ?></div>
                            <?php endif; ?>

                          </div>
                        <?php endwhile; ?>
                      </div>
                    <?php endif; ?>

                  </div>
                <?php endwhile; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>