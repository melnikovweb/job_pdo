<?php
$group_name = $args['group_name'] ?? 'all_payment_methods';

if (have_rows($group_name)) :
  Enqueue::style('public/parts/all-payment-methods-section/all-payment-methods-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($group_name)) : the_row();
    $previews = get_sub_field('previews');
    $theme = isset($args['inherit_theme']) ? '' : 'data-theme="' . get_sub_field('background') . '"';
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $buttons = get_sub_field('buttons');

    $indent = ($args['indent'] ?? true) ? '' : 'data-indent="none"';
  ?>
    <div class="all-payment-methods container" data-columns <?php echo $theme ?> <?php echo $indent; ?>>
      <?php if ($title or $description) : ?>
        <div class="all-payment-methods__header section-header">
          <?php if (isset($title)) : ?>
            <h2 class="section-header__title"><?php echo $title; ?></h2>
          <?php endif; ?>

          <?php if (isset($description)) : ?>
            <div class="section-header__description"><?php echo $description; ?></div>
          <?php endif; ?>

          <?php if (isset($buttons) and !empty($buttons)) : ?>
            <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
              'block_name' => 'section-header',
              'buttons' => $buttons
            )) ?>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if ($previews and !empty($previews)) : ?>
        <div class="all-payment-methods__previews">
          <div class="all-payment-methods__preview-wrapper">
            <?php foreach ($previews as $preview) : ?>
              <div class="all-payment-methods__preview">
                <img src="<?php echo esc_url($preview['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($preview['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <div class="all-payment-methods__preview-wrapper">
            <?php foreach ($previews as $preview) : ?>
              <div class="all-payment-methods__preview">
                <img src="<?php echo esc_url($preview['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($preview['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <div class="all-payment-methods__preview-wrapper">
            <?php foreach ($previews as $preview) : ?>
              <div class="all-payment-methods__preview">
                <img src="<?php echo esc_url($preview['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($preview['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <div class="all-payment-methods__preview-wrapper">
            <?php foreach ($previews as $preview) : ?>
              <div class="all-payment-methods__preview">
                <img src="<?php echo esc_url($preview['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($preview['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
<?php endif; ?>
