<?php
$section_key = $args['group_name'] ?? 'benefits_section_numbers';

if (have_rows($section_key)) :
  Enqueue::style('public/parts/benefits-section/benefits-section.css', [
    'is_root_path' => true,
  ]);
?>
  <?php while (have_rows($section_key)) : the_row(); ?>
    <?php
      $background = get_sub_field('background');
      $benefits = get_sub_field('benefits');
    ?>
    <section class="numbers-benefits container" data-theme="<?php echo $background ?>">
      <div class="numbers-benefits__items">
        <?php
          if ($benefits) {
            foreach ($benefits as $benefit) {
        ?>
          <article class="numbers-benefits__item">
            <div class="numbers-benefits__item-number">
              <?php echo $benefit['number'] ?>
            </div>
            <div class="numbers-benefits__item-text">
              <?php echo $benefit['text'] ?>
            </div>
        </article>
        <?php }
        } ?>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>
