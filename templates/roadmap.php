<?php
// Template Name: Roadmap

set_header_theme(array(
  'background' => 'blue',
  'invert' => false
));

get_header();

Enqueue::style('public/views/roadmap/roadmap.css', [
  'is_root_path' => true,
]);


Enqueue::script('public/views/roadmap/roadmap.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::SWIPER
], [
  'is_root_path' => true,
]);
?>

<?php if (have_rows('banner')) : ?>
  <?php while (have_rows('banner')) : the_row();
    $buttons = get_sub_field('buttons');
  ?>
    <div class="rd-banner">
      <div class="rd-banner__section container" data-columns data-theme="dark">
        <div class="rd-banner__content">
          <h1 class="rd-banner__headline"><?php the_sub_field('title'); ?></h1>

          <h2 class="rd-banner__description"><?php the_sub_field('description'); ?></h2>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => $buttons
        )) ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php while (have_rows('timeline_section')) : the_row(); ?>
  <?php if (get_sub_field('displaying')) :
    $timeline = get_sub_field('timeline');

    usort($timeline, function ($a, $b) {
      $timestampA = strtotime(str_replace('/', '-', $a['date']));
      $timestampB = strtotime(str_replace('/', '-', $b['date']));

      return $timestampB - $timestampA;
    });
  ?>
    <div class="milestone-section container" data-theme="white">
      <div class="milestone-section__header">
        <div class="milestone-section__headline"><?php the_sub_field('title') ?></div>
      </div>

      <div class="milestone-container">
        <div class="milestone-wrapper">
          <div class="milestone-section__line"></div>
        </div>

        <div class="milestone-wrapper" data-see-more="list">
          <?php if ($timeline) : ?>
            <?php foreach ($timeline as $item) : ?>
              <div class="milestone-section__item-wrapper">
                <div class="milestone-section__item">
                  <time class="milestone-section__date" datetime="<?php echo $item['date']; ?>"><?php echo date_parse($item['date'])['year']; ?></time>
                  <div class="milestone-section__group">
                    <div class="milestone-section__title"><?php echo $item['title'] ?></div>
                    <div class="milestone-section__content"><?php echo $item['content'] ?></div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
      <div data-button data-style="blue text" data-see-more="action">
        See more
      </div>
    </div>
  <?php endif; ?>
<?php endwhile; ?>

<?php if (have_rows('partnership')) : ?>
  <?php while (have_rows('partnership')) : the_row();
    $title = get_sub_field('title');
  ?>
    <div id="partnership" class="partnership container" data-theme="light-blue">
      <div class="partnership__header">
        <div class="partnership__title"><?php echo $title ?></div>
      </div>
      <div class="partnership__content">
        <?php while (have_rows('partners')) : the_row();
          $icon_id = get_sub_field('icon');
          $title = get_sub_field('title');
          $caption = get_sub_field('caption');
        ?>
          <div class="partner-item">
            <article class="partner" data-style="secondary">
              <div class="partner__section">
                <div class="partner__banner">
                  <?php if (!empty($icon_id)) {
                    echo wp_get_attachment_image($icon_id, [80, 160], false, ['alt' => $title]);
                  }
                  ?>
                  <span class="partner__banner-icon icon-arrow-right-up"></span>
                </div>
              </div>

              <div class="partner__section">
                <div class="partner__content">
                  <div class="partner__head">
                    <?php if ($title) : ?>
                      <div class="partner__title"><?php echo $title; ?></div>
                    <?php endif; ?>
                  </div>

                  <?php if ($caption) : ?>
                    <div class="partner__description"><?php echo $caption; ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </article>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section'); ?>
<?php get_footer() ?>
