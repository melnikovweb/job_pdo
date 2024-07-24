<?php if ($args) :
  $categories = $args;
?>
  <?php if ($categories) : ?>
    <div class="chips-list">
      <button type="button" data-value="all" class="chips active"><?php _e('All', 'SECRET-domain'); ?></button>

      <?php foreach ($categories as $item) :
        $value = $item->slug;
        $name = $item->name;
      ?>
        <button type="button" data-value="<?php echo $value; ?>" class="chips">
          <?php echo $name; ?>
        </button>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>