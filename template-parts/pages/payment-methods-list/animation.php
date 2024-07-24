<?php $payment_methods_images =get_sub_field('payment_methods'); ?>
<div class="all-payment-methods-vertical">
    <?php if ( $payment_methods_images ) : ?>
      <div class="all-payment-methods-vertical__previews">
       
        <div class="all-payment-methods-vertical__ticker-row ticker-row-vertical">
          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
     
        <div class="all-payment-methods-vertical__ticker-row ticker-row-vertical reverse">
          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
   
        <div class="all-payment-methods-vertical__ticker-row ticker-row-vertical">
          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="all-payment-methods-vertical__ticker-row ticker-row-vertical reverse">
          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>

          <div class="ticker-row-vertical__wrapper">
            <?php foreach ($payment_methods_images as $image) : ?>
              <div class="all-payment-methods-vertical__preview">
                <img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
</div>
