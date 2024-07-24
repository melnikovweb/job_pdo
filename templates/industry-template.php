<?php
// Template Name: Industry template

set_header_theme(array(
  'background' => 'dark',
  'invert' => true
));

get_header();

Enqueue::style('public/views/industry-template/industry-template.css', [
  'is_root_path' => true,
]);
?>

<?php while (have_rows('page_banner')) : the_row();
  $title = get_sub_field('title')
?>
  <section class="ind-banner-section container" data-columns data-theme="black">
    <div class="ind-banner-section__header">
      <h1 class="ind-banner-section__title"><?php echo $title ?></h1>

      <div class="ind-banner-section__content"><?php the_sub_field('description') ?></div>

      <?php get_template_part('template-parts/sections/actions-block', 'actions-block', array(
        'block_name' => 'page_banner',
        'buttons' => get_sub_field('buttons')
      )) ?>
    </div>

    <?php
    $is_media_exist = !empty(get_sub_field('media'));
    $media_id = get_sub_field('media');
    if ($is_media_exist) : ?>
      <div class="ind-banner-section__preview">
        <?php echo wp_get_attachment_image($media_id, [523, 785], false, ['alt' => $title]); ?>
      </div>

    <?php endif; ?>
  </section>
<?php endwhile; ?>

<?php while (have_rows('ind_cards_section')) : the_row(); ?>
  <?php if (get_sub_field('displaying')) : ?>
    <section class="ind-cards-section container" data-theme="dark">
      <?php if (have_rows('cards')) : ?>
        <?php while (have_rows('cards')) : the_row();
          $countries = get_sub_field('card_title');
        ?>
          <div class="card-wrap">
            <h2 class="card-header">
              <?php echo get_sub_field('card_header'); ?>
            </h2>
            <div class="card-items">
              <?php foreach (get_sub_field('card_items') as $card) : ?>
                <div class="card-item <?php echo $card['is_black'] ? 'black' : ''; ?>">
                  <div class="card-item__header">
                    <div class="card-item__header-icon">
                      <a class="icon-<?php echo $card['icons_select'] ?>">
                      </a>
                    </div>
                    <div class="card-item__header-text">
                      <?php echo $card['card_title'] ?>
                    </div>
                  </div>
                  <div class="countries-item__content">
                    <?php echo $card['card_content'] ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </section>
  <?php endif; ?>
<?php endwhile; ?>

<?php if (have_rows('sections_order')) : ?>
  <?php while (have_rows('sections_order')) : the_row();
    $order = get_sub_field('order');
  ?>
    <?php if ($order) : ?>
      <?php foreach ($order as $item) : ?>
        <?php
        $template_path = 'template-parts/sections/' . $item;
        get_template_part($template_path, $item);
        ?>
      <?php endforeach; ?>
    <?php endif; ?>

  <?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>
