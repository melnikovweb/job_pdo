<?php
$group_name = $args['group_name'] ?? 'block_links_section';

if (have_rows($group_name)) :
  Enqueue::style('shared/template-parts/block-links-section.css');
?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <?php if (get_sub_field('displaying')) : ?>
      <section class="block-links-section container" data-theme="<?php the_sub_field('background'); ?>">
        <div class="block-links-section__title"></div>

        <div class="block-links-section__content">
          <?php if (have_rows('links')) : ?>
            <?php while (have_rows('links')) : the_row();
              $link = get_field('link');
            ?>
              <?php if ($link) : ?>
                <a class="block-links-section__link" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?? '_self'); ?>">
                  <?php echo esc_html($link['title']); ?>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
