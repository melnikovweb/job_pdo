<?php
$block_name = $args['block_name'];
$buttons = $args['buttons'];

if ($buttons) : ?>
  <div class="<?php echo $block_name ?>__actions">
    <?php foreach ($buttons as $options) :
      $theme = $options['theme'];
      $is_outline = $options['is_outline'];
      $link = $options['button'];

      $outline_style = $is_outline ? ' outlined' : ''
    ?>
      <?php
      if ($link) :
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
      ?>
        <a class="<?php echo $block_name ?>__button" data-button data-style="<?php echo $theme ?><?php echo $outline_style ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
          <?php echo esc_html($link_title); ?>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
