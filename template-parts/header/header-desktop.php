<?php
Enqueue::style('public/parts/header-desktop/header-desktop.css', [
  'is_root_path' => true
]);

Enqueue::script('public/parts/header-desktop/header-desktop.js', [], [
  'is_root_path' => true
]);

$header_theme = get_header_theme();
$header_background = $header_theme['background'];
$what_section = get_field('what_section');
$hide_all_navigation = get_field('hide_all_navigation');
?>

<header class="hd-container container" data-element="primary-header" data-header-theme="<?php echo $header_background ?>">
  <div class="hd-container__section">
    <div class="hd-primary-menu">
      <a href="/" class="hd-logo" alt="SECRET logo" aria-label="SECRET logo">
        <svg width="118" height="37" viewBox="0 0 118 37" fill="none" xmlns="http://www.w3.org/2000/svg">
          <g clip-path="url(#clip0_3301_35572)">
            <path d="M73.5533 11.9658L57.4715 36.5001H52.8555L57.2307 29.8257L54.2657 11.9658H58.4525L60.5723 24.7235L68.9372 11.9658H73.5533Z" fill="var(--header-logo-color)" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.6348 9.85529C15.6434 9.33332 15.7239 8.81565 15.8732 8.31672C16.1103 7.76 16.3969 7.22541 16.7297 6.71942C17.1449 6.08725 17.6248 5.50013 18.1618 4.9676L18.4597 4.68293C19.8958 3.30562 21.7399 2.43122 23.7151 2.19096C24.5197 2.08715 25.3373 2.1655 26.1075 2.42021C26.8776 2.67492 27.5807 3.09947 28.1648 3.66249L28.2874 3.79388C28.4319 3.93402 28.5589 4.08731 28.6728 4.23183C28.791 4.3895 28.9137 4.5603 29.0319 4.7311C29.1579 4.9123 29.3508 5.03602 29.568 5.07503C29.6756 5.09435 29.7859 5.09229 29.8927 5.06897C29.9995 5.04565 30.1006 5.00153 30.1903 4.93913C30.28 4.87673 30.3566 4.79727 30.4156 4.70528C30.4746 4.6133 30.5149 4.51059 30.5342 4.40302C30.5536 4.29545 30.5515 4.18513 30.5282 4.07836C30.513 4.00888 30.489 3.94179 30.4569 3.87868C32.3405 6.2989 32.9138 9.81955 32.0235 13.5253C30.7403 18.8071 25.5768 21.9166 19.2001 21.9253L12.7008 21.9297L10.3578 30.864H5.74609L8.82412 19.1706H5.2114C4.41804 19.1706 3.7749 18.5275 3.7749 17.7341C3.7749 17.0394 4.26809 16.4598 4.92346 16.3265C4.83939 16.3669 4.76264 16.4212 4.69654 16.4873C4.61968 16.5642 4.55871 16.6554 4.51711 16.7559C4.47551 16.8563 4.4541 16.9639 4.4541 17.0726C4.4541 17.2363 4.50265 17.3964 4.5936 17.5325C4.68455 17.6686 4.81383 17.7747 4.96508 17.8374C5.05776 17.8757 5.15614 17.8972 5.25537 17.9004H6.10501L14.3079 17.5018L14.2422 17.4317C13.9156 17.0629 13.6224 16.6657 13.3663 16.2449H9.59425L9.88818 15.1282H3.49899C2.70564 15.1282 2.0625 14.4851 2.0625 13.6917C2.0625 12.9997 2.55194 12.4219 3.20358 12.2857C3.12476 12.3251 3.05202 12.3772 2.98853 12.4406C2.8333 12.5958 2.74609 12.8064 2.74609 13.0259C2.74609 13.1896 2.79464 13.3496 2.88559 13.4858C2.97655 13.6219 3.10582 13.728 3.25707 13.7906C3.35522 13.8313 3.45976 13.8525 3.56494 13.8536V13.8581L12.1708 13.5997C12.0501 13.1429 11.9782 12.6746 11.9562 12.2026H10.6583L10.9419 11.1252H1.43649C0.643141 11.1252 0 10.482 0 9.68869C0 8.99393 0.49322 8.41437 1.14862 8.28105C1.06501 8.32113 0.987958 8.37534 0.92115 8.44215C0.765919 8.59738 0.678711 8.80792 0.678711 9.02745C0.678711 9.19116 0.727257 9.35119 0.81821 9.48731C0.909163 9.62343 1.03844 9.72953 1.18969 9.79218C1.2892 9.8334 1.39529 9.85471 1.50195 9.85529H15.6348ZM28.5064 12.3253C28.6022 12.1306 28.7703 11.981 28.9748 11.9085C29.1794 11.8359 29.4042 11.8462 29.6012 11.937C29.7983 12.0278 29.9521 12.1921 30.0299 12.3947C30.1076 12.5973 30.1031 12.8223 30.0173 13.0216C29.4587 14.2165 28.6699 15.2895 27.6962 16.1793C26.3159 17.4491 24.6282 18.3367 22.7998 18.7545C21.0443 19.1784 19.1983 19.0153 17.5443 18.2902C16.7041 17.9007 15.9494 17.3484 15.3239 16.6654C14.7599 16.0236 14.299 15.2982 13.9575 14.5151C13.625 13.7979 13.4261 13.0262 13.3706 12.2377C13.3751 12.0258 13.4603 11.8236 13.6088 11.6724C13.7573 11.5212 13.9579 11.4323 14.1696 11.4239C14.3814 11.4156 14.5884 11.4883 14.7483 11.6273C14.9083 11.7663 15.0092 11.9611 15.0305 12.172C15.0753 12.7513 15.2236 13.318 15.4684 13.845C15.7279 14.4569 16.0794 15.0255 16.5108 15.5311C16.9882 16.0523 17.5643 16.4736 18.2056 16.7705C19.536 17.3483 21.0194 17.4729 22.4275 17.1253C23.9699 16.7671 25.3921 16.0122 26.5531 14.9355C27.369 14.2019 28.0327 13.315 28.5064 12.3253ZM19.6982 8.19174C19.9151 8.15314 20.1077 8.02999 20.2337 7.84937L20.2249 7.87126C20.436 7.57603 20.6783 7.30439 20.9476 7.06105C21.6092 6.44014 22.4118 5.98925 23.2862 5.74718C23.6338 5.63625 24.0013 5.6019 24.3635 5.64651C24.7256 5.69111 25.0738 5.81361 25.3841 6.00557C25.5116 6.09639 25.6291 6.20064 25.7344 6.31652C26.013 6.66338 26.2071 7.07027 26.3013 7.50504C26.3956 7.93982 26.3874 8.39055 26.2775 8.82163C26.0241 10.0278 25.4155 11.1306 24.53 11.9881L24.333 12.1764C23.5671 12.9325 22.584 13.4302 21.5213 13.5997C21.1419 13.6592 20.7539 13.6301 20.3877 13.5146C20.0215 13.3991 19.6869 13.2004 19.4103 12.934L19.349 12.8684C19.1889 12.6943 19.0547 12.4982 18.9505 12.2859C18.8401 12.0611 18.7606 11.8224 18.714 11.5764C18.6654 11.367 18.5377 11.1846 18.3576 11.0672C18.1775 10.9499 17.959 10.9069 17.7478 10.947C17.5367 10.9872 17.3493 11.1076 17.2248 11.2829C17.1004 11.4581 17.0487 11.6747 17.0804 11.8873C17.1486 12.286 17.2709 12.6735 17.4439 13.0392C17.6181 13.3935 17.8423 13.7209 18.1096 14.0114L18.2147 14.1209C18.6664 14.569 19.2161 14.9059 19.8203 15.105C20.4246 15.3042 21.0669 15.3601 21.6965 15.2684C23.1095 15.0593 24.4209 14.4112 25.4454 13.4158L25.6906 13.1793C26.8276 12.0805 27.6061 10.6639 27.9242 9.11506C28.0859 8.42925 28.0837 7.71498 27.9178 7.03017C27.752 6.34535 27.4271 5.70926 26.9695 5.17345C26.7813 4.96871 26.5713 4.78514 26.3432 4.62601C25.8404 4.29339 25.2708 4.07512 24.6745 3.98659C24.0782 3.89805 23.4698 3.94141 22.8921 4.1136C21.7474 4.42283 20.6952 5.00604 19.8264 5.81287C19.4699 6.13946 19.1498 6.50362 18.8717 6.899C18.7456 7.07962 18.6965 7.3029 18.7351 7.51974C18.7737 7.73657 18.8969 7.92918 19.0775 8.05521C19.2581 8.18123 19.4814 8.23035 19.6982 8.19174Z" fill="var(--header-logo-color)" />
            <path d="M11.7119 8.19982H14.1164C14.1269 8.155 14.1411 8.11101 14.1589 8.06833C14.4498 7.31273 14.8178 6.58922 15.2568 5.90919H12.3149L11.7119 8.19982Z" fill="var(--header-logo-color)" />
            <path d="M12.7092 4.41138H16.3137C16.3378 4.41138 16.3617 4.41254 16.3854 4.41482C16.5746 4.19982 16.7713 3.99125 16.975 3.7895L17.3166 3.46103C18.849 2.00571 20.7676 1.03155 22.8354 0.649414H13.6994L12.7092 4.41138Z" fill="var(--header-logo-color)" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.7109 8.19982H14.1174C14.1279 8.155 14.142 8.11101 14.1599 8.06833C14.4508 7.31273 14.8187 6.58922 15.2577 5.90919H8.12048C7.92186 5.90919 7.73137 5.83029 7.59092 5.68984C7.45048 5.54939 7.37158 5.35891 7.37158 5.16028C7.37158 4.96166 7.45048 4.77117 7.59092 4.63073C7.6377 4.58395 7.69003 4.544 7.74636 4.51151C7.11821 4.59926 6.63477 5.13867 6.63477 5.79099C6.63477 6.50453 7.2132 7.08296 7.92674 7.08296H12.005L11.7109 8.19982ZM12.7084 4.41138H16.3147C16.3387 4.41138 16.3627 4.41254 16.3864 4.41482C16.5756 4.19982 16.7722 3.99125 16.976 3.7895L17.3176 3.46103C18.85 2.00571 20.7686 1.03155 22.8364 0.649414H13.6989L12.7084 4.41138Z" fill="var(--header-logo-color)" />
            <path fill-rule="evenodd" clip-rule="evenodd" d="M45.0915 24.1911C45.121 24.147 45.1504 24.1025 45.1796 24.0575C46.5811 21.8984 47.1767 18.802 45.5431 16.9144C44.746 15.9831 43.603 15.5232 42.1139 15.5349C38.2949 15.5612 35.5446 18.6925 35.1329 22.3013C34.7957 25.2181 36.4117 27.3685 39.438 27.3509L39.4424 27.3466C41.6559 27.3466 43.3683 26.4487 44.7068 24.7245C44.8386 24.5551 44.9668 24.3773 45.0915 24.1911ZM52.6944 11.9818H48.5864L47.8857 14.6226C47.2375 12.8139 44.7806 11.5 42.4813 11.5C38.7849 11.5 35.2068 13.6547 33.0346 16.865C30.5076 20.5832 30.1134 25.2387 32.4171 28.6066C33.6784 30.4416 35.5528 31.3788 38.0579 31.3788C40.493 31.3788 42.1835 30.4766 44.1324 28.8474L43.6068 30.9015H47.7981L52.6944 11.9818Z" fill="var(--header-logo-color)" />
            <path d="M103.545 16.2014C104.386 15.8295 105.296 15.6385 106.216 15.6408C106.873 15.6207 107.527 15.7277 108.143 15.9561C108.708 16.1764 109.213 16.5255 109.619 16.9756C110.025 17.4257 110.321 17.9644 110.482 18.5488C110.649 19.1917 110.692 19.8606 110.609 20.5196C110.518 21.3714 110.293 22.2035 109.943 22.9853C109.582 23.783 109.102 24.5213 108.52 25.1751C107.933 25.8489 107.202 26.3831 106.382 26.7386C105.517 27.101 104.588 27.2871 103.65 27.2861C102.997 27.3067 102.347 27.1996 101.736 26.9707C101.182 26.7554 100.69 26.4064 100.304 25.9547C99.9083 25.4984 99.6262 24.9552 99.4803 24.3693C99.3242 23.7185 99.2871 23.0449 99.3708 22.3809C99.4616 21.5616 99.6818 20.7619 100.023 20.0116C100.388 19.2199 100.861 18.4828 101.429 17.8218C102.002 17.1327 102.722 16.5805 103.536 16.2058L103.545 16.2014ZM109.365 11.8875C108.607 11.704 107.828 11.6186 107.048 11.6335C105.651 11.6475 104.268 11.9269 102.975 12.4569C101.611 13.0304 100.353 13.8316 99.257 14.8262C96.9526 16.8113 95.5017 19.6079 95.2059 22.635C95.0565 23.798 95.1249 24.9787 95.4073 26.1167C95.6672 27.1274 96.1624 28.0624 96.8526 28.8452C97.5377 29.6265 98.4038 30.2279 99.3752 30.597C100.489 30.9976 101.669 31.1834 102.853 31.1445C104.317 31.1348 105.767 30.8572 107.131 30.3255C109.862 29.2062 112.123 27.18 113.534 24.5882C114.189 23.3368 114.601 21.9726 114.747 20.5678C114.846 19.7445 114.846 18.9123 114.747 18.089C114.652 17.3348 114.452 16.5977 114.152 15.8992C113.87 15.2358 113.486 14.621 113.013 14.0773C112.545 13.554 111.995 13.1103 111.384 12.7634C110.758 12.3731 110.078 12.0779 109.365 11.8875Z" fill="var(--header-logo-color)" />
            <path d="M80.6022 7.81875L75.6314 26.6991H78.8854C85.4767 26.6991 89.3964 23.6334 90.3161 16.7487C91.0825 10.9107 88.9365 7.81875 83.4095 7.81875H80.6022ZM77.0986 3.64941H82.446C86.3394 3.64941 88.3146 4.08736 90.1716 4.96327C94.3935 6.97787 95.6635 11.918 95.0548 16.5691C94.411 21.4918 91.7394 26.9137 86.9482 29.2699C84.8066 30.3253 82.8664 30.8509 79.3102 30.8509H69.9336L77.0986 3.64941Z" fill="var(--header-logo-color)" />
          </g>

          <defs>
            <clipPath id="clip0_3301_35572">
              <rect width="118" height="36" fill="var(--header-logo-color)" transform="translate(0 0.5)" />
            </clipPath>
          </defs>
        </svg>
      </a>

      <?php if (!$hide_all_navigation && have_rows('header_sections', 'options')) : ?>
        <div class="hd-primary-menu__navigation hd-navigation-items" data-style="primary">
          <?php while (have_rows('header_sections', 'options')) : the_row();
            $link = get_sub_field('link', 'options');
          ?>
            <?php
            if ($link) :
              $title = $link['title'];
              $active_class = $title == $what_section ? ' active' : '';
            ?>
              <a class="hd-navigation-items__item <?php echo $active_class; ?>" href="<?php echo esc_url($link['url']); ?>">
                <?php echo esc_html($title); ?>
              </a>
            <?php endif; ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="hd-secondary-menu">
      <div class="hd-secondary-menu__navigation">
        <div class="hd-navigation-items">
          <?php
          $header_right = ($what_section == 'Personal') ? 'header_other_links' : 'header_other_links_bussines';

          if (!$hide_all_navigation && have_rows($header_right, 'options')) : ?>
            <?php while (have_rows($header_right, 'options')) : the_row(); ?>
              <?php
              $link = get_sub_field('link', 'options');
              $is_sub_items_exist = have_rows('submenu', 'options');
              ?>

              <?php if ($link) : ?>
                <?php if (!$is_sub_items_exist) : ?>
                  <a class="hd-navigation-items__item" href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target'] ? $link['target'] : '_self'); ?>">
                    <?php echo esc_html($link['title']); ?>
                  </a>
                <?php endif; ?>

                <?php if ($is_sub_items_exist) : ?>
                  <div class="hd-navigation-items__item icon-chevron-down">
                    <?php echo esc_html($link['title']); ?>

                    <?php if ($is_sub_items_exist) : ?>

                      <div class="hd-navigation-items__dropdown hd-navigation-dropdown">
                        <?php while (have_rows('submenu', 'options')) : the_row();
                          $link = get_sub_field('link2', 'options');
                        ?>
                          <?php if ($link) : ?>
                            <a class="hd-navigation-dropdown__item" href="<?php echo esc_url($link['url']); ?>" target="<?php echo $link['target'] ?: '_self' ?>">
                              <?php echo $link['title'] ?>
                            </a>
                          <?php endif; ?>
                        <?php endwhile; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>

              <?php endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
      </div>

      <?php if (!$hide_all_navigation) : ?>
        <?php
        $header_login = ($what_section == 'Personal') ? 'header_reg' : 'header_reg_bussines';
        $header_reg = get_field($header_login, 'option');

        if ($header_reg) :
          $header_log = $header_reg['log'];
          $header_sign = $header_reg['sign'];
        ?>
          <div class="hd-secondary-menu__buttons">
            <?php if ($header_log) : ?>
              <a class="hd-secondary-menu__button" href="<?php echo $header_log['url'] ?>" data-action="logIn" data-button data-style="blue" data-size="sm">
                <?php echo $header_log['title'] ?>
              </a>
            <?php endif; ?>

            <?php if ($header_sign) : ?>
              <a class="hd-secondary-menu__button" href="<?php echo $header_sign['url'] ?>" data-action="signUp" data-button data-style="white outlined" data-size="sm">
                <?php echo $header_sign['title'] ?>
              </a>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <button type="button" data-action="burger" class="hd-secondary-menu__burger-button icon-list" data-icon-open="icon-list" data-icon-close="icon-close" aria-label="Mobile menu toogle button"></button>
      <?php endif; ?>
    </div>
  </div>

  <?php if (!$hide_all_navigation) : ?>
    <div class="hd-container__section">
      <?php if ($what_section == 'Personal') {
        wp_nav_menu([
          'theme_location'  => 'header_menu',
          'menu'            => 'ul',
          'container'       => 'nav',
          'container_class' => 'hd-sub-navigation',
          'container_id'    => '',
          'menu_class'      => 'hd-sub-navigation__list',
          'menu_id'         => '',
          'link_class'      => 'hd-sub-navigation__link icon-chevron-down',
          'echo'            => true,
          'fallback_cb'     => 'wp_page_menu',
          'before'          => '',
          'after'           => '',
          'link_before'     => '',
          'link_after'      => '',
          'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'depth'           => 0,
          'walker'          => '',
        ]);
      } else {
        wp_nav_menu([
          'theme_location'  => 'business_header_menu',
          'menu'            => 'ul',
          'container'       => 'nav',
          'container_class' => 'hd-sub-navigation',
          'container_id'    => '',
          'menu_class'      => 'hd-sub-navigation__list',
          'menu_id'         => '',
          'link_class'      => 'hd-sub-navigation__link icon-chevron-down',
          'echo'            => true,
          'fallback_cb'     => 'wp_page_menu',
          'before'          => '',
          'after'           => '',
          'link_before'     => '',
          'link_after'      => '',
          'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
          'depth'           => 0,
          'walker'          => '',
        ]);
      } ?>
    </div>
  <?php endif; ?>
</header>