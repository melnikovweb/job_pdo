<?php
Enqueue::style('public/parts/header-mobile/header-mobile.css', [
  'is_root_path' => true
]);

Enqueue::script('public/parts/header-mobile/header-mobile.js', [], [
  'is_root_path' => true
]);
?>
<section class="hm-container container" data-element="mobile-header" aria-expanded="false">
  <div class="hm-container__body">
    <?php if (have_rows('header_sections', 'options')) : ?>
      <div class="hm-container__navigation hm-navigation-items" data-style="primary">
        <?php while (have_rows('header_sections', 'options')) : the_row();
          $link = get_sub_field('link', 'options');
        ?>
          <?php
          if ($link) :
            $title = $link['title'];
            $active_class = $title == get_field('what_section') ? ' active' : '';
          ?>
            <a class="hm-navigation-items__item <?php echo $active_class; ?>" href="<?php echo esc_url($link['url']); ?>">
              <?php echo esc_html($title); ?>
            </a>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
    <?php endif; ?>

    <div class="hm-container__groups">
      <?php if (get_field('what_section') == 'Personal') : ?>
        <div class="hm-container__group">
          <?php wp_nav_menu([
            'theme_location'  => 'mobile_menu',
            'menu'            => 'ul',
            'container'       => 'nav',
            'container_class' => 'hm-navigation',
            'container_id'    => '',
            'menu_class'      => 'hm-navigation__list',
            'link_class'      => 'icon-chevron-down',
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

          <?php wp_nav_menu([
            'theme_location'  => 'mobile_menu',
            'menu'            => 'ul',
            'container'       => 'nav',
            'container_class' => 'hm-navigation',
            'container_id'    => '',
            'menu_class'      => 'hm-navigation__list',
            'link_class'      => 'icon-chevron-down',
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
        </div>
      <?php else : ?>
        <div class="hm-container__group">
          <?php wp_nav_menu([
            'theme_location'  => 'business_mobile_menu',
            'menu'            => 'ul',
            'container'       => 'nav',
            'container_class' => 'hm-navigation',
            'container_id'    => '',
            'menu_class'      => 'hm-navigation__list',
            'link_class'      => 'icon-chevron-down',
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

          <?php wp_nav_menu([
            'theme_location'  => 'business_mobile_menu',
            'menu'            => 'ul',
            'container'       => 'nav',
            'container_class' => 'hm-navigation',
            'container_id'    => '',
            'menu_class'      => 'hm-navigation__list',
            'link_class'      => 'icon-chevron-down',
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
        </div>
      <?php endif; ?>
    </div>

    <?php
    $header_login = (get_field('what_section') == 'Personal') ? 'header_reg' : 'header_reg_bussines';
    $header_reg = get_field($header_login, 'options');

    if ($header_reg) :
      $header_log = $header_reg['log'];
      $header_sign = $header_reg['sign'];
    ?>
      <div class="hm-actions">
        <?php if ($header_log) : ?>
          <a class="hm-actions__action" href="<?php echo $header_log['url'] ?>" data-action="logIn" data-button data-style="blue" data-size="sm">
            <?php echo $header_log['title'] ?>
          </a>
        <?php endif; ?>

        <?php if ($header_sign) : ?>
          <a class="hm-actions__action" href="<?php echo $header_sign['url'] ?>" data-action="signUp" data-button data-style="white outlined" data-size="sm">
            <?php echo $header_sign['title'] ?>
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</section>
