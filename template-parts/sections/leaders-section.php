<?php
  if (have_rows('leaders_section')) :
    Enqueue::style('public/parts/leaders-section/leaders-section.css', [
      'is_root_path' => true,
    ]);
    ?>
    <?php while (have_rows('leaders_section')) : the_row();
    $title = get_sub_field('title');
    $top_gallery = get_sub_field('top_gallery');
    $bottom_gallery = get_sub_field('bottom_gallery');
    ?>
    <section class="leaders-section container" data-theme="white">
      <div class="leaders-section__content">
        <?php if ($top_gallery) : ?>
          <div class="leaders-section__ticker">
            <div class="leaders-section__ticker-wrapper" aria-hidden="true">
              <?php foreach ($top_gallery as $image_id) : ?>
                <div class="leaders-section__image-card">
                  <div class="leaders-section__image-media">
                    <?php echo wp_get_attachment_image($image_id, 'full', false, ['alt' => 'Industry Leader']); ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <div class="leaders-section__ticker-wrapper" aria-hidden="true">
              <?php foreach ($top_gallery as $image_id) : ?>
                <div class="leaders-section__image-card">
                  <div class="leaders-section__image-media">
                    <?php echo wp_get_attachment_image($image_id, 'full', false, ['alt' => 'Industry Leader']); ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="leaders-section__header">
          <div class="leaders-section__title section-header__title">
            <?php echo wp_kses_post($title); ?>
          </div>
        </div>
        <?php if ($bottom_gallery) : ?>
          <div class="leaders-section__ticker leaders-section__ticker--reverse">
            <div class="leaders-section__ticker-wrapper" aria-hidden="true">
              <?php foreach ($bottom_gallery as $image_id) : ?>
                <div class="leaders-section__image-card">
                  <div class="leaders-section__image-media">
                    <?php echo wp_get_attachment_image($image_id, 'full', false, ['alt' => 'Industry Leader']); ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <div class="leaders-section__ticker-wrapper" aria-hidden="true">
              <?php foreach ($bottom_gallery as $image_id) : ?>
                <div class="leaders-section__image-card">
                  <div class="leaders-section__image-media">
                    <?php echo wp_get_attachment_image($image_id, 'full', false, ['alt' => 'Industry Leader']); ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endwhile; ?>
  <?php endif; ?>
