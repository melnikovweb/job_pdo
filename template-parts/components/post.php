<?php
Enqueue::style('public/parts/posts/posts.css', [
  'is_root_path' => true
]);

$displaying_title = $args['displaying_title'] ?? true;
$displaying_description = $args['displaying_description'] ?? true;
$displaying_details = $args['displaying_details'] ?? true;
$displaying_link = $args['displaying_link'] ?? true;
$theme = $args['theme'] ?? 'default';

if ( $post->post_type === 'case-studies' ) {
  $categories = get_the_terms($post->ID, 'case-studies-category');
} elseif ( $post->post_type === 'news' ){
  $categories = get_the_terms($post->ID, 'news-category');
} else {
  $categories = get_the_category();
}

?>
<article class="post" data-style="<?php echo $theme ?>">
  <div class="post__section">
    <div class="post__banner">
      <a href="<?php the_permalink(); ?>">
        <?php
        $title = get_the_title();
        $preview_id = get_post_thumbnail_id();
        echo wp_get_attachment_image($preview_id, 'img-481-210', false, ['alt' => $title])
        ?>
      </a>
      <div class="post__tag chips like-hover"><?php echo end($categories)->name ?></div>
    </div>
  </div>

  <div class="post__section">
    <div class="post__content">
      <h2 class="post__head">
        <?php if ($displaying_title) : ?>
          <a class="post__title" href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
        <?php endif; ?>

        <?php if ($displaying_details) : ?>
          <div class="post__timeline">
            <div class="post__timeline-part icon-dot-separator"><?php echo get_the_date('F j, Y') ?></div>

            <div class="post__timeline-part icon-dot-separator"><?php echo do_shortcode('[read_meter]') ?></div>
          </div>
        <?php endif; ?>
      </h2>

      <?php if ($displaying_description) : ?>
        <div class="post__description"><?php echo get_the_excerpt(); ?></div>
      <?php endif; ?>
    </div>

    <?php if ($displaying_link) : ?>
      <div class="post__actions">
        <a href="<?php the_permalink(); ?>" class="post__button" data-button data-style="blue outlined">Read more</a>
      </div>
    <?php endif; ?>
  </div>
</article>
