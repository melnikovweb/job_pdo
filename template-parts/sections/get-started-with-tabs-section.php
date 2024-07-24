<?php
$group_name = $args['group_name'] ?? 'get_started_with_tabs';

if (have_rows($group_name)) :
  Enqueue::style('public/views/get-started-with-tabs-section/get-started-with-tabs-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <section class="get-started"  data-theme="<?php the_sub_field('theme') ?>">
      <div class="get-started__header section-header container">
        <div class="section-header__title"><?php the_sub_field('title') ?></div>

        <div class="section-header__description"><?php the_sub_field('description') ?></div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'section-header',
          'buttons' => get_sub_field('buttons'),
        )) ?>
      </div>

      <?php if (have_rows('tabs')) : ?>
        <tabs-group data-theme="black" primary-theme="black" secondary-theme="blue" border-theme="white">
          <span slot="icon" class="icon-chevron-down"></span>

          <?php while (have_rows('tabs')) : the_row(); ?>
            <tab-item class="tabs-item container" label="<?php the_sub_field('tabs_title') ?>">
              <?php if (have_rows('steps')) : ?>
                <div class="stepper">
                  <?php while (have_rows('steps')) : the_row(); ?>
                    <div class="stepper__step"><?php the_sub_field('text') ?></div>
                  <?php endwhile; ?>
                </div>
              <?php endif; ?>
            </tab-item>
          <?php endwhile; ?>
        </tabs-group>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
