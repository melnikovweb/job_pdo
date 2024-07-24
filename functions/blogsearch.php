<?php

// ajax поиск по сайту 
add_action('wp_ajax_nopriv_blogsearch', 'searchajax');
add_action('wp_ajax_blogsearch', 'searchajax');

function searchajax()
{
    if (!wp_verify_nonce($_POST['nonce'], 'blogsearch-nonce')) {
        wp_die('Данные отправлены с левого адреса');
    }


    $args = array(
        'post_type'      => 'post', // Тип записи: post, page, кастомный тип записи 
        'post_status'    => 'publish',
        'nopaging'       => false,                // если нужна пагинация
        'paged'          => $_POST['page'],                // если нужна пагинация
    );

    if ($_POST['s'] != '') {
        $args['s'] = $_POST['s'];
    }
    if ($_POST['category'] != 'all') {
        $args['category_name'] = $_POST['category'];
    }
    $query = new WP_Query($args);
    if ($query->have_posts()) { ?>
        <section class="blog-grid p-inline">

            <?php while ($query->have_posts()) {
                $query->the_post(); ?>

                <article class="blog-card"><a class="blog-card-link" href="<?php the_permalink(); ?>"></a>
                    <div class="blog-card-media">
                        <img class="blog-card-media-el lazy" src="<?php echo get_the_post_thumbnail_url(); ?>" loading="lazy" aria-hidden="true" alt="">
                    </div>
                    <div class="blog-card-info">
                        <span class="blog-card-tag"><?php echo get_the_category()[0]->name; ?></span>
                        <h3 class="blog-card-title"><?php the_title(); ?></h3>
                        <div class="blog-card-text"><?php the_excerpt(); ?></div>
                        <p class="blog-card-date"><?php echo get_the_date('M d, Y') ?> | 2min</p>
                        <div class="blog-card-hover">
                            <h3 class="section-heading sm blog-card-hover-heading"><?php the_title(); ?></h3>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </section>

        <?php if ($query->max_num_pages > 1) { ?>
            <section class="blog-pagination p-inline pagination">
                <?php if ($_POST['page'] != 1) { ?>
                    <a href="<?php echo $_POST['baseurl']; ?>page<?php echo $_POST['page'] - 1; ?>" class="nav-btn blue pagination-btn" aria-label="Previous page">
                        <svg class="nav-btn-icon">
                            <use href="<?php echo get_template_directory_uri(); ?>/assets/images/svg-sprite/svg-sprite2.svg#arrow-b-l-icon"></use>
                        </svg>
                    </a>
                <?php } ?>

                <?php if ($_POST['page'] != $query->max_num_pages) { ?>
                    <a href="<?php echo $_POST['baseurl']; ?>page<?php echo $_POST['page'] + 1; ?>" class="nav-btn blue pagination-btn" aria-label="Previous page">
                        <svg class="nav-btn-icon">
                            <use href="<?php echo get_template_directory_uri(); ?>/assets/images/svg-sprite/svg-sprite2.svg#arrow-b-r-icon"></use>
                        </svg>
                    </a>
                <?php } ?>
            </section>
        <?php } ?>

    <?php } else { ?>
        <p class="blog-result p-inline"><?php _e('Not found', 'SECRET-domain'); ?></p>
<?php }
    exit;
}
