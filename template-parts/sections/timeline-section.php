<?php if (have_rows('timeline_section')) :
Enqueue::style('public/parts/timeline-section/timeline-section.css', [
  'is_root_path' => true,
]);

Enqueue::script('public/parts/timeline-section/timeline-section.js', [FunctionPars\EnqueueScripts\GlobalScripts::SWIPER], [
  'is_root_path' => true,
]);
?>
  <?php while (have_rows('timeline_section')) : the_row(); ?>
    <?php if (get_sub_field('displaying')) :
      $timeline = get_sub_field('timeline');

      usort($timeline, function ($a, $b) {
        $timestampA = strtotime(str_replace('/', '-', $a['date']));
        $timestampB = strtotime(str_replace('/', '-', $b['date']));

        return $timestampB - $timestampA;
      });
    ?>
      <div class="timeline-section container" data-theme="white">
        <div class="timeline-section__header">
          <div class="timeline-section__headline"><?php the_sub_field('title') ?></div>

          <div class="timeline-section__actions">
            <button class="timeline-section__button icon-arrow-left" data-arrow-button data-style="blue" data-direction="prev"></button>

            <button class="timeline-section__button icon-arrow-right" data-arrow-button data-style="blue" data-direction="next"></button>
          </div>
        </div>

        <div class="swiper">
          <div class="timeline-section__line"></div>

          <div class="swiper-wrapper">
            <?php if ($timeline) : ?>
              <?php foreach ($timeline as $item) : ?>
                <div class="swiper-slide">
                  <div class="timeline-section__item">
                    <time class="timeline-section__date" datetime="<?php echo $item['date']; ?>"><?php echo date_parse($item['date'])['year']; ?></time>

                    <div class="timeline-section__group">
                      <div class="timeline-section__title"><?php echo $item['title'] ?></div>

                      <div class="timeline-section__content"><?php echo $item['content'] ?></div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
