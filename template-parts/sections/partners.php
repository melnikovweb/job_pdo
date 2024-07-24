<?php
$group_name = $args['group_name'] ?? 'partners';
$top_not_indent = isset($args['top_not_indent']) ? $args['top_not_indent'] : false;

if (have_rows($group_name)) :
  Enqueue::style('public/parts/partners/partners.css', [
    'is_root_path' => true,
  ]);
  ?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <section class="partners container<?php if ($top_not_indent) { echo ' partners-top-not-indent'; } ?>" data-columns data-theme="<?php echo get_sub_field('theme') ?>">
      <div class="partners__header">
        <div class="partners__title">
          <?php echo get_sub_field('title') ?>
        </div>

        <div class="partners__description">
          <?php echo get_sub_field('description') ?>
        </div>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'partners',
          'buttons' => get_sub_field('buttons')
        )) ?>
      </div>

      <?php if (have_rows('ways')) : ?>
        <div class="partners__groups ">
          <?php while (have_rows('ways')) : the_row(); ?>
            <div class="partners__group <?php echo get_sub_field('is_gray') ? 'gray' : ''; ?> " >
              <?php
                $images = get_sub_field('images');
                $buttons = get_sub_field('links');
              ?>
              <?php if ($images) : ?>
                <div class="integration-section__pics">
                  <?php foreach ($images as $image) { ?>
                    <div class="partners__img">
                      <?php echo wp_get_attachment_image( $image, 'icon-72', true); ?>
                    </div>
                  <?php }; ?>
                </div>
              <?php endif; ?>

              <div class="partners__name"><?php the_sub_field('title') ?></div>

              <div class="partners__text"><?php the_sub_field('content') ?></div>

              <div class="partners__links">
                <?php if ($buttons){ foreach ($buttons as $button) :
                  $link = $button['link'];
                    if ($link) :
                      $link_url = $link['url'];
                      $link_title = $link['title'];
                      $link_target = $link['target'] ? $link['target'] : '_self';
                      ?>
                    <a href="<?php echo esc_url($link_url); ?>" class="partners__link icon-arrow-right" target="<?php echo esc_attr($link_target); ?>">
                      <?php echo esc_html($link_title); ?>
                    </a>
                  <?php endif; ?>
                <?php endforeach; } ?>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>