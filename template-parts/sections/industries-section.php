<?php
$group_name = $args['group_name'] ?? 'industry_section';

if (have_rows($group_name)) :
  Enqueue::style('public/parts/industries-section/industries-section.css', [
    'is_root_path' => true,
  ]);

  Enqueue::script('public/parts/industries-section/industries-section.js', [], [
    'is_root_path' => true,
  ]);

?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <?php $options_type = get_sub_field('options_type'); ?>
    <section class="industries-section container" data-columns data-theme="<?php the_sub_field('theme'); ?>">
      <div class="industries-section__header">
        <div class="industries-section__title"><?php the_sub_field('title'); ?></div>
      </div>

      <?php if (have_rows('options')) : ?>
        <div class="industries-section__content">
          <div class="industries-section__items" data-see-more="list">
            <?php while (have_rows('options')) : the_row();
              $link = get_sub_field('link');
            ?>
              <?php if ($link && $options_type == 'text') : ?>
                <span class="industries-section__text icon-<?php the_sub_field('icons_select') ?>">
                  <?php echo esc_html($link['title']); ?>
                </span>
              <?php else : ?>
                <a class="industries-section__link icon-<?php the_sub_field('icons_select') ?>" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?? '_self'); ?>">
                  <?php echo esc_html($link['title']); ?>
                  <span class="icon-arrow-right-up"></span>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
          <button type="button" class="industries-section__see-more" data-button data-style="lime text" data-see-more="action"><?php _e('See more', 'SECRET-domain'); ?></button>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>