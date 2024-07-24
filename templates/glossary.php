<?php
// Template Name: Glossary

/**
 * Remove <link rel="next" ... />
 * @params string $next
 *
 * return string - new link meta tag in string 
 */
function aioseo_filter_next_link($next)
{
  return '';
}
add_filter('aioseo_next_link', 'aioseo_filter_next_link');

/**
 * Remove <link rel="next" ... />
 * @params string $prev
 *
 * return string - new link meta tag in string 
 */
function aioseo_filter_prev_link($prev)
{
  return '';
}
add_filter('aioseo_next_link', 'aioseo_filter_prev_link');

?>

<?php get_template_part('template-parts/pages/glossary/header'); ?>

<section class="letter-box container" data-theme="dark">
  <?php
  $alphabet_args = [
    'taxonomy'   => 'alphabet',
    'hide_empty' => true,
  ];

  if (is_tax('alphabet')) {
    $current_tax = get_queried_object();
    if ($current_tax instanceof WP_Term) {
      $alphabet_args['include'] = $current_tax->term_id;
    }
  }

  $alphabet = get_terms($alphabet_args);
  ?>

  <?php if ($alphabet) { ?>
    <?php foreach ($alphabet as $letter) {
      $terms = new WP_Query([
        'post_type'   => 'glossary',
        'posts_per_page' => -1,
        'tax_query'   => array(
          array(
            'taxonomy' => 'alphabet',
            'field'  => 'slug',
            'include_children'  => false,
            'terms' => $letter->slug,
          )
        ),
        'orderby' => 'title',
        'order' => 'ASC',
      ]); ?>

      <?php if ($terms->have_posts()) { ?>
        <section class="letter-box__latter">
          <div class="letter-box__latter-title"><?php echo $letter->name; ?></div>
          <ul class="letter-box__latter-list">
            <?php while ($terms->have_posts()) {
              $terms->the_post(); ?>
              <li class="letter-box__latter-item">
                <a class="letter-box__latter-item-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>
            <?php } ?>
          </ul>
          <?php wp_reset_postdata(); ?>
        </section>
      <?php } ?>
    <?php } ?>
  <?php } ?>
</section>

<?php get_footer(); ?>
