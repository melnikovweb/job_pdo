<?php if (have_rows('banner_section')) : ?>
  <?php
  Enqueue::style('public/parts/primary-banner-section/primary-banner-section.css', [
    'is_root_path' => true
  ]);

  ?>

  <?php while (have_rows('banner_section')) : the_row();
    // TODO: Move themes from args to ACF field
    $theme = get_sub_field('inherit_theme') ? '' : ('data-theme="' . ($args['theme'] ?? 'black') . '"');
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $indent = ($args['indent'] ?? true) ? '' : 'data-indent="none"';
  ?>
    <section class="primary-banner-section container" data-columns <?php echo $theme ?> <?php echo $indent ?>>
      <div class="primary-banner-section__header">
        <h1 class="primary-banner-section__title"><?php echo $title ?></h1>

        <h2 class="primary-banner-section__content"><?php echo $description ?></h2>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'primary-banner-section',
          'buttons' => get_sub_field('buttons')
        )) ?>
      </div>

      <?php
      $is_template_exist = isset($args['template_part']);
      $is_media_exist = !empty(get_sub_field('media'));

      if ($is_template_exist or $is_media_exist) : ?>
        <div class="primary-banner-section__preview">
          <?php if ($is_template_exist) : ?>
            <?php get_template_part($args['template_part']); ?>
          <?php elseif ($is_media_exist) :
            $media_id = get_sub_field('media');
            echo wp_get_attachment_image($media_id, [1382, 874]);
          ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
