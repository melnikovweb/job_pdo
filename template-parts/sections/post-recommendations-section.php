<?php

$field_name = $args['field_name'] ?? 'post_recommendations';
$is_displaying = get_field($field_name)['displaying'] ?? false;

if (have_rows($field_name) and $is_displaying) :
  Enqueue::style('public/parts/post-recommendations-section/post-recommendations-section.css', [
    'is_root_path' => true
  ]);

  Enqueue::script('public/parts/post-recommendations-section/post-recommendations-section.js', [
    FunctionPars\EnqueueScripts\GlobalScripts::SWIPER
  ], [
    'is_root_path' => true
  ]);
?>
  <?php while (have_rows($field_name)) : the_row();
    $category_id = get_sub_field('category_id') ?? '';
    $recomendation_post_type  = get_sub_field('recomendation_post_type') ?? 'post';
    $title = get_sub_field('title');
    $items_visibility = get_sub_field('items_visibility') ?? array(
      'title'       => true,
      'details'     => true,
      'description' => true,
    );

    $posts = new WP_Query(array(
      'post_type'     => $recomendation_post_type,
      'category_name' => $category_id,
      'nopaging'      => true,
    ));

    $section_theme = get_sub_field('theme');
    $is_dark_theme = in_array($section_theme, array('black', 'dark'));
    $button_theme = $is_dark_theme ? 'lime' : 'blue';
  ?>

    <?php if ($is_displaying and $posts->have_posts()) : ?>
      <div id="post-recommendations" class="post-recommendations container" data-theme="<?php echo $section_theme ?>">
        <div class="post-recommendations__header">
          <div class="post-recommendations__title"><?php echo $title ?></div>

          <div class="post-recommendations__actions">
            <button class="icon-arrow-left" data-arrow-button data-style="<?php echo $button_theme ?>" data-action="prev"></button>

            <button class="icon-arrow-right" data-arrow-button data-style="<?php echo $button_theme ?>" data-action="next"></button>
          </div>
        </div>

        <div class="post-recommendations__content">
          <div class="swiper">
            <div class="swiper-wrapper">
              <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                <div class="swiper-slide">
                  <?php get_template_part('template-parts/components/post', 'post', array(
                    'theme' => 'secondary',
                    'displaying_title' => $items_visibility['title'],
                    'displaying_description' => $items_visibility['description'],
                    "displaying_details" => $items_visibility['details'],
                    "displaying_link" => false,
                  )); ?>
                </div>
              <?php endwhile;
              wp_reset_postdata();
              ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  <?php endwhile; ?>
<?php endif; ?>
