<?php
  $group_name = $args['group_name'] ?? 'get_started_with_icons';

  if (have_rows($group_name)) :
    Enqueue::style('public/parts/get-started-with-icons-section/get-started-with-icons-section.css', [
      'is_root_path' => true,
    ]);
    ?>
    <?php while (have_rows($group_name)) : the_row(); ?>
    <section class="get-started-with-icons container" data-theme="<?php echo esc_attr(the_sub_field('theme')); ?>">
      <div class="get-started-with-icons__header section-header">
        <div class="section-header__title"><?php the_sub_field('title') ?></div>
        <div class="section-header__description"><?php the_sub_field('description') ?></div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => get_sub_field('buttons'),
        )) ?>
      </div>
      <?php if (have_rows('steps')) : ?>
        <div class="get-started-with-icons__steps">
          <?php while (have_rows('steps')) : the_row(); ?>
            <div class="get-started-with-icons__step">
              <?php
                $is_icon_exist = !empty(get_sub_field('icon'));
                $icon_id = get_sub_field('icon');
                if ($is_icon_exist) : ?>
                  <div class="get-started-with-icons__step-image">
                    <?php echo wp_get_attachment_image($icon_id, 'thumbnail', false, ['alt' => get_sub_field('text')]); ?>
                  </div>
                <?php endif; ?>
              <div class="get-started-with-icons__step-text"><?php the_sub_field('text') ?></div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
  <?php endif; ?>