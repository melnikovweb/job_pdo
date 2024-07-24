<?php
$group_name = $args['group_name'] ?? 'get_started';

if (have_rows($group_name)) :
  Enqueue::style('public/parts/get-started-section/get-started-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <section class="get-started container" data-theme="<?php the_sub_field('theme') ?>">
      <div class="get-started__header section-header">
        <div class="section-header__title"><?php the_sub_field('title') ?></div>
        <div class="section-header__description"><?php the_sub_field('description') ?></div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => get_sub_field('buttons'),
        )) ?>
      </div>

      <?php if (have_rows('steps')) : ?>
        <div class="stepper">
          <?php while (have_rows('steps')) : the_row(); ?>
            <div class="stepper__step"><?php the_sub_field('text') ?></div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
