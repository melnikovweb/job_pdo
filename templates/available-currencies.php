<!--
  Template Name: List of available currencies
-->

<?php

set_header_theme(array(
  'background' => 'dark',
  'invert' => false
));

get_header();

Enqueue::style('public/views/available-currencies/available-currencies.css', [
  'is_root_path' => true,
]);

?>
<?php if (have_rows('header_section')) : ?>
  <?php while (have_rows('header_section')) : the_row();
    $header = get_sub_field('header');
    $description = get_sub_field('description');
  ?>
    <div class="av-header container" data-columns data-theme="dark">
      <div class="av-header__title">
        <?php echo $header ?>
      </div>

      <h2 class="av-header__text">
        <?php echo $description ?>
      </h2>
    </div>

  <?php endwhile; ?>
<?php endif; ?>



<?php if (have_rows('table_section')) : ?>
  <?php while (have_rows('table_section')) : the_row();
    $curency_placeholder = get_sub_field('curency_filter');
    $payment_schemes_placeholder = get_sub_field('payment_schemes_filter');
    $table = get_sub_field('table');
  ?>
    <section class="available-currency-section container" data-theme="dark">
      <table class="available-currency-section__table" id="available-currency">
        <tbody>
          <?php foreach ($table as $item) :
            $currency_array = $item['currency_select'];
          ?>
            <tr>
              <td>
                <?php if ($currency_array) : ?>
                  <?php foreach ($currency_array as $key) :
                    $currency = CurrencyData\get_currency($key);
                  ?>
                    <div class="available-currency-section__table-currency">
                      <div class="available-currency-section__table-currency-img">
                        <img src="<?php echo esc_url($currency->flag); ?>" alt="<?php echo esc_attr($currency->name); ?>" />
                      </div>
                      <div class="available-currency-section__table-currency-name">
                        <span>
                          <?php echo strtoupper($key) ?>
                        </span>
                        <span>
                          <?php echo ucfirst($currency->name) ?>
                        </span>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td>
                <div class="available-currency-section__table-payment_schemes">
                  <?php echo $item['payment_schemes']  ?>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

<?php get_template_part('template-parts/sections/interim-section', 'prohibited-jurisdictions', ['group_name' => 'prohibited_jurisdictions']) ?>

<?php get_template_part('template-parts/sections/callback-section'); ?>

<?php get_footer(); ?>
