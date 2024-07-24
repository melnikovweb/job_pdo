<?php $group_name = $args['group_name'] ?? 'integrate_links'; ?>
<?php if (have_rows($group_name)) : ?>
  <?php 
    Enqueue::style('public/parts/integrate-links/integrate-links.css', [
      'is_root_path' => true,
    ]);
   ?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <section class="integrate-links container" data-theme="black">
      <div class="integrate-links__title"><?php the_sub_field('title'); ?></div>
      <?php if (have_rows('links')) : ?>
        <div class="integrate-links__row">
          <div class="integrate-links__links">
            <?php while (have_rows('links')) : the_row(); ?>
              <?php $link = get_sub_field('link'); ?>
              <?php if ($link) : ?>
                <a class="integrate-links__link" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ?? '_self'); ?>">
                  <?php echo esc_html($link['title']); ?>
                  <span class="integrate-links__icon icon-arrow-right-up"></span>
                </a>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>