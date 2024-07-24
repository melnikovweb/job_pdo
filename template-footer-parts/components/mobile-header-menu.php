<section class="menu menu_mobile">
  <?php if (have_rows('header_sections', 'options')) : ?>
    <div class="menu-mode">
      <?php while (have_rows('header_sections', 'options')) :
        the_row(); ?>

        <?php
        $link = get_sub_field('link', 'options');
        if ($link) :
          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
          <a class="menu-mode-link <?php echo $link_title == get_field('what_section') ? 'active' : ''; ?>" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
        <?php endif; ?>

      <?php endwhile; ?>

    </div>
  <?php endif; ?>

  <?php if (get_field('what_section') == 'Personal') { ?>
    <?php wp_nav_menu([
      'theme_location'  => 'mobile_menu',
      'menu'            => 'ul',
      'container'       => 'nav',
      'container_class' => 'menu-nav',
      'container_id'    => '',
      'menu_class'      => 'menu-nav-list',
      'link_class'      => 'menu-nav-link',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 0,
      'walker'          => '',
    ]); ?>
  <?php } else { ?>
    <?php wp_nav_menu([
      'theme_location'  => 'business_mobile_menu',
      'menu'            => 'ul',
      'container'       => 'nav',
      'container_class' => 'menu-nav',
      'container_id'    => '',
      'menu_class'      => 'menu-nav-list',
      'link_class'      => 'menu-nav-link',
      'menu_id'         => '',
      'echo'            => true,
      'fallback_cb'     => 'wp_page_menu',
      'before'          => '',
      'after'           => '',
      'link_before'     => '',
      'link_after'      => '',
      'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'           => 0,
      'walker'          => '',
    ]); ?>
  <?php }
  $header_reg = get_field('header_reg', 'option');
  if ($header_reg) {
    $header_log = $header_reg['log'];
    $header_sign = $header_reg['sign'];
  ?>
    <div class="menu-wrap">
      <?php if ($header_log) { ?>
        <a class="btn-def blue menu-btn" href="<?php echo $header_log['url'] ?>"><?php echo $header_log['title'] ?></a>
      <?php } ?>
      <?php if ($header_sign) { ?>
        <a class="btn-def brdr wi menu-btn" href="<?php echo $header_sign['url'] ?>"><?php echo $header_sign['title'] ?></a>
      <?php } ?>
    </div>
  <?php } ?>
  <form class="lang menu-lang">
    <div class="lang-head">
      <?php
      $langs_array = pll_the_languages(array('dropdown' => 1, 'hide_current' => 0, 'raw' => 1));
      foreach ($langs_array as $lang) {
        $current_lang = pll_current_language();
      ?>
        <img class="lang-head-flag lazy" data-src="<?php echo $lang['flag'] ?>" loading="lazy" aria-hidden="true" alt="" <?php if ($lang['current_lang'] == '') {
                                                                                                                            echo 'style="display:none;"';
                                                                                                                          } ?>>
        <?php if ($lang['current_lang'] == 1) {
          echo $lang['name'];
        } ?>
      <?php } ?>
    </div>
    <div class="lang-dd">
      <div class="lang-dd-container">
        <?php
        $langs_array = pll_the_languages(array('dropdown' => 1, 'hide_current' => 0, 'raw' => 1));
        foreach ($langs_array as $lang) {
          $current_lang = pll_current_language();
        ?>
          <a href="<?php echo $lang['url'] ?>" class="lang-btn" <?php if ($lang['current_lang'] == 1) {
                                                                  echo 'style="display:none;"';
                                                                } ?>>
            <img class="lang-flag lazy" data-src="<?php echo $lang['flag'] ?>" loading="lazy" aria-hidden="true" alt="">
            <?php echo $lang['name'] ?>
          </a>
        <?php } ?>
      </div>

    </div>
  </form>
</section>