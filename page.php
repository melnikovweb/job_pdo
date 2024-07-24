<?php
Enqueue::style('public/views/empty-page/empty-page.css', [
  'is_root_path' => true
]);

set_header_theme([
  'background' => 'white',
]);

get_header(); ?>

<div class="ep-empty-page" data-theme="white">
  <div class="ep-empty-page__header container" data-columns>
    <h1 class="ep-empty-page__title"><?php the_title(); ?></h1>
  </div>

  <div class="ep-empty-page__content container">
    <?php the_content(); ?>
  </div>
</div>

<?php get_footer(); ?>
