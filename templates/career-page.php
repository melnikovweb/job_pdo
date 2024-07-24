<!--
    Template Name: Career page
 -->

<?php

get_header();

Enqueue::style('public/views/career-page/career-page.css', [
  'is_root_path' => true,
]);

Enqueue::script('public/views/career-page/career-page.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::ISOTOPE
], [
  'is_root_path' => true,
]);

$categories = get_terms(array(
  'hide_empty' => 0,
  'hierarchical' => 1,
  'order' => 'DESC',
  'orderby'=> 'slug',
  'taxonomy' => 'career-location',
));

$career = get_posts([
  'posts_per_page' => -1,
  'post_type'      => 'career',
]);

?>

<section class="career-banner container" data-theme="blue">
  <h1 class="career-banner__title"><?php echo get_the_title(); ?></h1>
</section>

<section class="filters career-filter">
<div class="ui-group career-filter__buttons">
    <div class="button-group js-radio-button-group career-filter__buttons-wrapper" data-filter-group="type">
      <?php foreach ($categories as $item) :
          $value = $item->slug;
          $name = $item->name;
          $is_active = $categories[0]->slug === $item->slug ? "active" : "";
        ?>
          <button data-filter="<?php echo '.' . $value; ?>" data-value="<?php echo $value; ?>" class="career-filter__button js-career-filter__button <?php echo $is_active; ?>"><?php echo $name; ?></button>
        <?php endforeach; ?>
    </div>
  </div>

  <div class="ui-group career-filter__select">
    <div class="career-filter__select-top">
      <div class="career-filter__select-top-title"></div>
    </div>
    <div class="button-group js-radio-button-group career-filter__select-bot"  data-filter-group="type">

      <?php foreach ($categories as $item) :
          $value = $item->slug;
          $name = $item->name;
          $is_active = $categories[0]->slug === $item->slug ? "active" : "";
        ?>
          <div data-filter="<?php echo '.' . $value; ?>" data-value="<?php echo $value; ?>" class="career-filter__select-bot-item js-career-filter__button <?php echo $is_active; ?>"><?php echo $name; ?></div>
        <?php endforeach; ?>
    </div>
  </div>
</section>






<section class="container career-list__wrapper">

<div class="career-list" data-theme="white">
<?php
foreach ($career as $item){
  $id = $item->ID;
  $career_type = get_the_terms($id, 'career-type');
  $career_location = get_the_terms($id, 'career-location');
  $career_team = get_the_terms($id, 'career-team');
  $all_terms = "";
  
  if (is_array($career_location)){
    foreach ($career_location as $career_term) {
      $all_terms .= ' ' . $career_term->slug;
    }
  }
  ?>

  <a href="<?php echo get_permalink($id); ?>">
  <div class="career-list__item icon-arrow-right-up <?php echo $all_terms; ?>">
    <div class="career-list__item-l-coll">
      <div class="career-list__item-title"><?php echo($item->post_title); ?></div>

      <div class="career-list__item-info">
        <?php if ($career_location) : foreach ($career_location as $loc_item){ ?>
          <div class="career-list__item-location icon-dot-separator">
          <?php
            $image = get_field('location_image',  $loc_item);
            if ($image){
              echo (wp_get_attachment_image($image, [24, 24]));
            }?>
            <div> 
            <?php echo ($loc_item)->name; 
          ?>
          </div>
          </div>
        <?php } endif; ?>

        <?php  if ($career_type) : foreach ($career_type as $type_item){ ?>
          <div class="career-list__item-type icon-dot-separator"><?php echo ($type_item)->name; ?></div>
        <?php } endif; ?>
      </div>
    </div>

    <div class="career-list__item-r-coll">
      <?php if ($career_team) : foreach ($career_team as $team_item){ ?>
        <div class="career-list__item-team icon-dot-separator"><?php echo ($team_item)->name; ?></div>
      <?php } endif; ?>
      
    </div>
  </div>
</a>

<?php 
}

?>
</div>
</section>

<?php if (have_rows('career-about-us')) : ?>
    <?php while (have_rows('career-about-us')) : the_row();
        $title = get_sub_field('title');
        $group_title = get_sub_field('group_title');
        $description = get_sub_field('description');
        ?>
        <section class="career-about-us container" data-columns data-theme="white">

            <div class="career-about-us__title">
                <?php echo $title ?>
            </div>

            <div class="career-about-us__groups">
                <div class="career-about-us__group_title">
                    <?php echo $group_title ?>
                </div>

                <div class="career-about-us__description">
                    <?php echo $description ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>

<section class="container">
  <?php get_template_part('template-parts/sections/image-blocks-section'); ?>
</section>

<section class="container career-values" data-theme="dark">
  <?php 
  $values = get_field('career',  'options');?>
  <h2 class="career-values__title"><?php echo $values['values_title']; ?></h2>
  <div class="career-values__groups">
    <?php 
    $count = 0;
    foreach ($values['career_values'] as $value) { 
      $count++;
      ?>
      <div class="career-values__group">
        <div class="career-values__count">
          <?php echo '0'.$count; ?>
        </div>
        <div class="career-values__info">
          <div class="career-values__name">
            <?php echo $value['value_title']; ?>
          </div>
          <div class="career-values__caption">
            <?php echo $value['values_description'];?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<?php get_template_part('template-parts/sections/post-recommendations-section', 'post-recommendations-section'); ?>

<?php get_footer(); ?>
