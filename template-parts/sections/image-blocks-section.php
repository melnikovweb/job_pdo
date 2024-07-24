<?php 

$gallery = $args['gallery'] ?? [];
$gallery = $gallery ?: get_field('images_section', 'options');

if (!empty($gallery)) :
  Enqueue::style('public/parts/image-blocks-section/image-blocks-section.css',[
    'is_root_path' => true
  ]);

?>

  <div class="image-block">
      <?php foreach ($gallery as $image_block) : ?>
        <div class="image-block__item">
          <img src="<?php echo $image_block['url']; ?>" alt="<?php echo $image_block['alt']; ?>">
        </div>
      <?php endforeach; ?>
  </div>

<?php endif; ?>




