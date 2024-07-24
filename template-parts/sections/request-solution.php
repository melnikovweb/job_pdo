<?php if ( have_rows( 'request_solution' ) ) : ?>
  <?php
  Enqueue::style('public/parts/request-solution/request-solution.css', [
    'is_root_path' => true,
  ]);
  ?>

  <?php while ( have_rows( 'request_solution' ) ) : the_row(); ?>
    <?php
      $title = get_sub_field( 'title' );
      $items = get_sub_field( 'items' );
    ?>
    <section class="request-solution" data-theme="white">
      <div class="container">
        <div class="request-solution__title">
          <?php echo $title; ?>
        </div>
        <?php if ( $items ) { ?>
          <div class="request-solution__items">
            <?php foreach ( $items as $item ) { ?>
              <div class="request-solution__item">
                <?php if ( isset( $item['title'] ) ) { ?>
                  <div class="request-solution__item__title">
                    <?php echo esc_html( $item['title'] ); ?>
                  </div>
                <?php } ?>

                <?php if ( isset( $item['description'] ) ) { ?>
                  <div class="request-solution__item__description">
                    <?php echo esc_html( $item['description'] ); ?>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </section>
  <?php endwhile; ?>
<?php endif; ?>