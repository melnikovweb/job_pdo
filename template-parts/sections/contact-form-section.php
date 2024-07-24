<?php
$group_name = $args['group_name'] ?? 'сontact_form_section';
$options_key = $args['options_key'] ?? '';

if (have_rows($group_name, $options_key)) :
  Enqueue::style('public/parts/contact-form-section/contact-form-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($group_name, $options_key)) : the_row(); ?>
    <?php if (get_sub_field('displaying')) : ?>
      <?php $title = get_sub_field('title'); ?>
      <section class="contact-form-section" data-theme="<?php the_sub_field('theme'); ?>" id="contact-form-section">
        <div class="container">
          <?php if ($title): ?>
            <div class="contact-form-section__title"><?php echo esc_html($title); ?></div>
          <?php endif; ?>
          <div class="contact-form-section__wrap-form">
            <?php get_template_part('template-parts/components/contact-form', '', ['form_shortcode' => get_sub_field('form_shortcode')]) ?>
          </div>
        </div>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
