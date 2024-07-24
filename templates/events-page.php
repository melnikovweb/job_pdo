<!--
    Template Name: Events
 -->

<?php

get_header();

Enqueue::style('public/views/events-page/events-page.css', [
  'is_root_path' => true,
]);

Enqueue::script('public/views/events-page/events-page.js', [
  FunctionPars\EnqueueScripts\GlobalScripts::ISOTOPE
], [
  'is_root_path' => true,
]);

$categories = get_terms(array(
  'hide_empty' => 0,
  'hierarchical' => 1,
  'taxonomy' => 'events-type',
));

$category_id = get_field('category_id');
$posts_per_page = 4;

$today = date('Ymd');

$events = get_posts([
  'posts_per_page' => $posts_per_page,
  'post_type'      => 'events',
]);
?>

<?php if (have_rows('events', 'options')) : ?>
  <?php while (have_rows('events', 'options')) : the_row(); ?>
    <section class="ev-events-header-section container" data-theme="dark">
      <div class="ev-events-welcome">
        <h1 class="ev-events-welcome__title"><?php the_sub_field('archive_page_title'); ?></h1>
        <h2 class="ev-events-welcome__description"><?php the_sub_field('archive_page_description'); ?></h2>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<section class="filters">
  <div class="ui-group ev-btns">
    <div class="button-group js-radio-button-group ev-btns-wrapper" data-filter-group="type">
      <button data-filter=".upcoming" class="active ev-btn js-ev-btn is-checked">
        <?php _e('Upcoming', 'SECRET-domain'); ?>
      </button>

      <button data-filter=".past" class="ev-btn js-ev-btn">
        <?php _e('Past', 'SECRET-domain'); ?>
      </button>
    </div>
  </div>

  <div class="ui-group ev-select">
    <div class="ev-select-top">
      <div class="ev-select-top-title"></div>
    </div>
    <div class="button-group js-radio-button-group ev-select-bot" data-filter-group="type">
      <div data-filter=".upcoming" class="ev-select-bot-item active js-ev-btn">
        <?php _e('Upcoming', 'SECRET-domain'); ?>
      </div>
      <div data-filter=".past" class="ev-select-bot-item js-ev-btn">
        <?php _e('Past', 'SECRET-domain'); ?>
      </div>
    </div>
  </div>
  <div class="ev-categories container" data-theme="white">
    <div class="ev-categories__title" data-offset-start="2">
      <?php _e('Find an event', 'SECRET-domain'); ?>
    </div>

    <div class="ui-group ev-categories__content" data-offset-start="2">
      <div class="chips-list button-group js-radio-button-group" data-filter-group="category">
        <button data-filter="*" data-value="<?php echo $category_id ?>" class="active chips js-ev-btn"><?php _e('All events', 'SECRET-domain'); ?></button>

        <?php foreach ($categories as $item) :
          $value = $item->slug;
          $name = $item->name;
          $category_link = add_query_arg('category_filter', $value, get_permalink(get_page_by_path('events')));
        ?>
          <button data-filter="<?php echo '.' . $value; ?>" data-value="<?php echo $value; ?>" class="button chips js-ev-btn"><?php echo $name; ?></button>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<section class="grid ev-events-list">
  <?php
  foreach ($events as $event) {
    $event_terms = get_the_terms($event->ID, 'events-type');
    $event_type =  date('Ymd', strtotime(get_field('end_date', $event->ID))) >= $today ? " upcoming" : " past";
    $all_terms = "";
    $start_date = get_field('start_date', $event->ID);
    $end_date = get_field('end_date', $event->ID);
    $full_date = $start_date && $end_date ? date('M d, Y', strtotime($start_date)) . ' - ' . date('M d, Y', strtotime($end_date)) : ($start_date ? date('M d, Y', strtotime($start_date)) : '');

    if (is_array($event_terms)) {
      foreach ($event_terms as $event_term) {
        $all_terms .= ' ' . $event_term->slug;
      }
    }
  ?>
    <div class="element-item ev-event-row<?php echo $all_terms, $event_type; ?>">
      <div class="ev-event-image">
        <a href="<?php echo get_permalink($event->ID); ?>"><?php echo (get_the_post_thumbnail($event->ID));  ?></a>
      </div>
      <div class="ev-event-content">
        <div>
          <a href="<?php echo get_permalink($event->ID); ?>">
            <h3 class="ev-event-title"><?php echo $event->post_title; ?></h3>
          </a>
          <?php if ($full_date !== '') { ?> <div class="ev-event-date"><?php echo $full_date; ?></div> <?php } ?>
        </div>
        <div class="ev-event-description"><?php echo ($event->post_excerpt); ?></div>
        <div class="ev-event-actions">
          <a class="ev-event-button" data-button data-style="white outlined" href="<?php echo (get_permalink($event->ID)); ?>">
            <?php _e('Find out more', 'SECRET-domain'); ?>
          </a>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
</section>


<?php get_footer(); ?>