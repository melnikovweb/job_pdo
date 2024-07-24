<?php

$group_name = $args['group_name'] ?? 'animated-cards-section';
$class_name = $args['class_name'] ?? '';

if (have_rows($group_name)) :

  Enqueue::style('public/parts/animated-cards-section/animated-cards-section.css', [
    'is_root_path' => true,
  ]);

?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <?php if (get_sub_field('displaying')) : ?>
      <section class="animated-cards-section container" data-theme="<?php the_sub_field('theme'); ?>">
        <div class="<?php echo esc_attr($class_name); ?>">
          <div class="animated-cards-section__info">
            <?php $title = get_sub_field('title') ?? ''; ?>
            <?php if ($title) : ?>
              <div class="animated-cards-section__title"><?php echo wp_kses_post($title); ?></div>
            <?php endif; ?>

            <?php $description = get_sub_field('description') ?? ''; ?>
            <?php if ($description) : ?>
              <div class="animated-cards-section__description"><?php echo esc_html($description); ?></div>
            <?php endif; ?>

            <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
              'block_name' => 'animated-cards-section',
              'buttons' => get_sub_field('buttons'),
            )) ?>

          </div>

          <?php if (have_rows('items')) : ?>
            <div class="animated-cards-section__cards">

              <?php while (have_rows('items')) : the_row(); ?>
                <?php
                $name = get_sub_field('name') ?? '';
                $card_description = get_sub_field('description') ?? '';
                $image = get_sub_field('image');
                $video_mp4 = get_sub_field('video-mp4');
                $video_webm = get_sub_field('video-webm');
                ?>

                <div class="animated-cards-section__card">
                  <div class="animated-cards-section__card-info">

                    <?php if ($name) : ?>
                      <div class="animated-cards-section__card-name"><?php echo esc_html($name); ?></div>
                    <?php endif; ?>


                    <?php if ($card_description) : ?>
                      <div class="animated-cards-section__card-description"><?php echo esc_html($card_description); ?></div>
                    <?php endif; ?>
                  </div>



                  <?php if ($video_mp4 || $video_webm) : ?>
                    <div class="animated-cards-section__card-video-wrapper">
                      <video class="animated-cards-section__card-video" autoplay muted loop playsinline>
                        <?php if ($video_mp4) : ?>
                          <source src="<?php echo esc_url($video_mp4); ?>" type='video/mp4; codecs="hvc1"'>
                        <?php endif; ?>
                        <?php if ($video_webm) : ?>
                          <source src="<?php echo esc_url($video_webm); ?>" type="video/webm">
                        <?php endif; ?>
                      </video>
                    </div>
                  <?php elseif ($image) : ?>
                    <?php echo wp_get_attachment_image($image, 'full', null, ['class' => 'object-contain']); ?>
                  <?php endif; ?>

                </div>
              <?php endwhile; ?>
            </div>

          <?php endif; ?>
        </div>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>