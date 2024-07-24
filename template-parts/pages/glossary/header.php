<?php

$glossary = Enqueue::script('public/views/glossary/glossary.js', [], [
  'is_root_path' => true,
]);

$glossary->localize('wpPageData', array(
  'ajaxUrl' => admin_url('admin-ajax.php'),
  'nonce' => wp_create_nonce('glossary-nonce'),
  'notFoundText' => __('Not found', 'SECRET-domain')
));

set_header_theme([
  'background' => 'dark'
]);

get_header();

Enqueue::style('public/views/glossary/glossary.css', [
  'is_root_path' => true,
]);

?>

<?php if (have_rows('glossary', 'options')) : ?>
  <?php while (have_rows('glossary', 'options')) : the_row(); ?>
    <section class="gl-header container" data-theme="dark">
      <h1 class="gl-header__title">
        <?php the_sub_field('title'); ?>
      </h1>
      <h2 class="gl-header__subtitle">
        <?php the_sub_field('description'); ?>
      </h2>

      <div class="gl-search">
        <label class="gl-search__field-wrap">
          <i class="gl-search__icon icon-search"></i>
          <input class="gl-search__field" type="search" placeholder="<?php _e('Search', 'SECRET-domain'); ?>">
        </label>
        <div class="gl-search__result">
          <ul class="gl-search__result-list" role="list"></ul>
        </div>
      </div>

      <?php
      $alphabet = get_terms([
        'taxonomy'   => 'alphabet',
        'hide_empty' => true
      ]);
      ?>

      <?php if ($alphabet) { ?>
        <?php
        $current_tax_id = '';
        if (is_tax('alphabet')) {
          $current_tax = get_queried_object();
          if ($current_tax instanceof WP_Term) {
            $current_tax_id = $current_tax->term_id;
          }
        }
        ?>
        <ul class="gl-alphabet">
          <?php foreach ($alphabet as $letter) { ?>
            <li class="gl-alphabet__latter<?php if ($current_tax_id == $letter->term_id) {
                                            echo ' active';
                                          } ?>">
              <a class="gl-alphabet__link" href="<?php echo get_term_link($letter->term_id); ?>"><?php echo $letter->name; ?></a>
            </li>
          <?php } ?>
        </ul>
      <?php } ?>

    </section>
  <?php endwhile; ?>
<?php endif; ?>