<?php
$group_name = $args['group_name'] ?? 'integrate_section';

if (have_rows($group_name)) :
    Enqueue::style('public/parts/integration-section/integration-section.css', [
      'is_root_path' => true,
    ]);
    ?>
    <?php while (have_rows($group_name)) : the_row(); ?>
        <section class="integration-section container" data-columns data-theme="<?php echo get_sub_field('theme') ?>">
          <div class="integration-section__header">
            <div class="integration-section__title">
              <?php echo get_sub_field('title') ?>
            </div>

            <div class="integration-section__description">
              <?php echo get_sub_field('description') ?>
            </div>

            <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
              'block_name' => 'integration-section',
              'buttons' => get_sub_field('buttons')
            )) ?>
          </div>

          <?php if (have_rows('ways')) : ?>
            <div class="integration-section__groups">
              <?php while (have_rows('ways')) : the_row();
              ?>
                  <?php get_template_part('template-parts/components/integration-item-component', 'integration-item-component', array(
                      'images' => get_sub_field('images'),
                      'title' => get_sub_field('title'),
                      'content' => get_sub_field('content'),
                      'links' => get_sub_field('links'),
                  )) ?>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </section>
    <?php endwhile; ?>
<?php endif; ?>