<?php
$group_name = $args['group_name'] ?? 'interim_section';

if (have_rows($group_name)) :
  Enqueue::style('public/parts/interim-section/interim-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <?php if (get_sub_field('displaying')) : ?>
      <section class="interim-section container" data-theme="<?php the_sub_field('background'); ?>">
        <div class="interim-section__text"><?php the_sub_field('text') ?></div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'interim-section',
          'buttons' => get_sub_field('buttons'),
        )) ?>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
