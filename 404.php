<?php

set_header_theme([
  'background' => 'black',
]);

get_header();

Enqueue::style('public/views/not-found-page/not-found-page.css', [
  'is_root_path' => true
]);

?>

<div class="nf-not-found-page container" data-columns data-theme="black">
  <div class="nf-not-found-page__img">
    <img src="<?php echo esc_url(get_field('photo404', 'options')); ?>" alt="Page not found">
  </div>

  <div class="nf-not-found-page__content">
    <h1 class="nf-not-found-page__title">
      <?php _e('Oops, something went wrong', 'SECRET-domain'); ?>
    </h1>

    <a class="nf-not-found-page__action" href="<?php echo home_url(); ?>" data-button data-style="blue">
      <?php _e('Back to Homepage', 'SECRET-domain'); ?>
    </a>
  </div>
</div>

<?php get_footer(); ?>