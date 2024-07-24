<?php
$section_key = $args['group_name'] ?? 'callback_section';
$options_key = $args['options_key'] ?? '';

// var_dump($args);

if (have_rows($section_key, $options_key)) :
  Enqueue::style('public/parts/callback-section/callback-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($section_key, $options_key)) : the_row(); ?>
    <?php if (get_sub_field('displaying')) :

      $buttons = get_sub_field('buttons');
    ?>
      <section class="callback-section container" data-theme="<?php the_sub_field('background') ?>">
        <div class="callback-section__title"><?php the_sub_field('title') ?></div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'callback-section',
          'buttons' => $buttons
        )) ?>
      </section>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
