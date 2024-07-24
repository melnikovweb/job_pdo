<?php if (have_rows('faq_section')) :
  Enqueue::style('public/parts/faq-section/faq-section.css',[
    'is_root_path' => true
  ]);
  ?>
  <?php while (have_rows('faq_section')) : the_row();
  $theme = get_sub_field('theme');
  ?>
  <?php if (get_sub_field('displaying') ?? false) : ?>
    <section class="faq-section container" data-theme="<?php echo esc_attr($theme); ?>" data-columns="12" data-offset-start="1" data-offset-end="1">
      <div class="faq-section__header">
        <div class="faq-section__title">
          <?php echo esc_html(get_sub_field('title')); ?>
        </div>
      </div>

      <?php if (have_rows('sections')) : ?>
        <accordion-group class="faq-section__content">
          <?php while (have_rows('sections')) : the_row(); ?>
            <accordion-item summary="<?php echo esc_attr(get_sub_field('summary')); ?>" theme="<?php echo esc_attr($theme); ?>">
              <?php the_sub_field('content'); ?>
            </accordion-item>
          <?php endwhile; ?>
        </accordion-group>
      <?php endif; ?>
    </section>
  <?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>