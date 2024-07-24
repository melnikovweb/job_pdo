<?php if (have_rows('banner_section')) : ?>
  <?php 
    Enqueue::style('public/parts/banner-section/banner-section.css', [
      'is_root_path' => true,
    ]);
  ?>

  <?php while (have_rows('banner_section')) : the_row();
    // TODO: Move themes from args to ACF field
    $theme = get_sub_field('inherit_theme') ? '' : ('data-theme="' . ($args['theme'] ?? 'black') . '"');

    $indent = ($args['indent'] ?? true) ? '' : 'data-indent="none"';
    $label = get_sub_field('label');
    $title = get_sub_field('title');
  ?>
    <section class="banner-section container" data-columns <?php echo $theme ?> <?php echo $indent ?>>
      <div class="banner-section__header">
        <?php if (isset($label) and !empty($label)) : ?>
          <div class="banner-section__label"><?php echo $label ?></div>
        <?php endif; ?>

        <h1 class="banner-section__title"><?php echo $title ?></h1>

        <h2 class="banner-section__content"><?php the_sub_field('description') ?></h2>

        <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
          'block_name' => 'banner-section',
          'buttons' => get_sub_field('buttons')
        )) ?>
      </div>

      <?php
      $is_template_exist = isset($args['template_part']);
      $is_media_exist = !empty(get_sub_field('media'));

      if ($is_template_exist or $is_media_exist) : ?>
        <div class="banner-section__preview">
          <?php if ($is_template_exist) : ?>
            <?php get_template_part($args['template_part']); ?>
          <?php elseif ($is_media_exist) :
            $media_id = get_sub_field('media');
          ?>
            <?php echo wp_get_attachment_image( $media_id, [676, 431], false, ['alt' => $title]); ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
