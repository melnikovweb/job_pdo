<?php
$group_name = $args['group_name'] ?? 'banner_lottie';

if (have_rows($group_name)) : ?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <?php
      Enqueue::style('public/parts/banner-lottie/banner-lottie.css', [
        'is_root_path' => true,
      ]);

      $banner_lottie = Enqueue::script('public/parts/banner-lottie/banner-lottie.js', [
        FunctionPars\EnqueueScripts\GlobalScripts::LOTTIE
      ], [
        'is_root_path' => true
      ]);

      $banner_lottie->localize('wpPageData', array(
        'animationData' => get_sub_field('lottie_animation_data'),
      ));

      $video_mov_url = get_sub_field('video_mov_url');
      $video_webm_url = get_sub_field('video_webm_url');
    ?>
    <section class="banner-lottie" data-theme="black">
      <div class="banner-lottie__container container">
        <?php if ($video_mov_url || $video_webm_url): ?>
          <video class="banner-lottie__video" autoplay muted loop playsinline>
            <?php if ($video_mov_url): ?>
              <source src="<?php echo esc_url($video_mov_url); ?>" type='video/quicktime'>
            <?php endif; ?>
            <?php if ($video_webm_url): ?>
              <source src="<?php echo esc_url($video_webm_url); ?>" type="video/webm">
            <?php endif; ?>
          </video>
        <?php endif; ?>

        <div class="banner-lottie__content">
          <div class="banner-lottie__animation"></div>

          <div class="banner-lottie__title"><?php the_sub_field('title') ?></div>
          <div class="banner-lottie__description"><?php the_sub_field('description') ?></div>
          <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
            'block_name' => 'section-header',
            'buttons' => get_sub_field('buttons'),
          )) ?>
        </div>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
