<div class="ft-geo-target">
  <div class="ft-geo-target__container">
    <?php if (have_rows('group')) : ?>
      <?php while (have_rows('group')) : the_row(); ?>
        <div class="ft-geo-target__section">
          <div class="ft-geo-target__content">
            <?php the_sub_field('content') ?>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
</div>
