<?php
Enqueue::style('public/parts/integration-item-component/integration-item-component.css', [
  'is_root_path' => true
]);

$images = $args['images'];
$title = $args['title'];
$content = $args['content'];
$buttons = $args['links'];
?>

<div class="integration-component__group">
  <?php if ($images) : ?>
    <div class="integration-section__pics">
      <?php foreach ($images as $image_id) { ?>
        <div class="integration-component__img">
          <?php echo wp_get_attachment_image($image_id, 'icon-72', true); ?>
        </div>
      <?php }; ?>
    </div>
  <?php endif; ?>

  <div class="integration-component__content">
    <div class="integration-component__name"><?php echo $title ?></div>

    <div class="integration-component__text"><?php echo $content ?></div>

    <div class="integration-component__links">
      <?php if ($buttons) {
        foreach ($buttons as $button) :
          $link = $button['link'];
          if ($link) :
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
      ?>
            <a href="<?php echo esc_url($link_url); ?>" class="integration-component__link icon-arrow-right" target="<?php echo esc_attr($link_target); ?>">
              <?php echo esc_html($link_title); ?>
            </a>
          <?php endif; ?>
      <?php endforeach;
      } ?>
    </div>
  </div>
</div>
<?php ?>
