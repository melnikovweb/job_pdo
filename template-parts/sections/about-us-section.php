<?php
$group_name = $args['group_name'] ?? 'about_us';

if (have_rows($group_name)) :
  Enqueue::style('public/parts/about-us-section/about-us-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($group_name)) : the_row(); ?>
    <section class="about-us-section" data-theme="white">
      <?php if (have_rows('settings')) : ?>
        <?php while (have_rows('settings')) : the_row(); ?>
          <?php if (get_sub_field('displaying')) : 
              $title = get_sub_field('title');
            ?>
            <div class="about-us-section__information container">
              <div class="about-us-section__header container" data-columns data-indent="none">
                <div class="about-us-section__title"><?php echo $title; ?></div>

                <div class="about-us-section__description"><?php the_sub_field('description'); ?></div>

                <?php get_template_part('template-parts/sections/actions-block', 'actions-block', [
                  'block_name' => 'about-us-section',
                  'buttons' => get_sub_field('buttons'),
                ]) ?>
              </div>

              <?php
              $gallery = (get_sub_field('images') ?: get_field('images_section', 'options')) ?? [];
            
              $is_gallery_shown = get_sub_field('is_gallery_shown') === "true" ;
              
              if (($is_gallery_shown) && count($gallery) === 1) : ?>
                <div class="about-us-section__preview">
                  <?php
                    echo wp_get_attachment_image( $gallery[0]['ID'], 'img-1680-636', false, ['alt' => $title]);
                  ?>  
                </div>
                <?php elseif ($is_gallery_shown && count($gallery) > 1) : ?>
                  <?php get_template_part('template-parts/sections/image-blocks-section', 'image-blocks-section', ['gallery' => $gallery]); ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
      
      <?php if (get_sub_field('displaying-timeline')) : ?>
        <?php get_template_part('template-parts/sections/timeline-section', 'timeline-section') ?>
      <?php endif; ?>

    </section>
  <?php endwhile; ?>
<?php endif; ?>
