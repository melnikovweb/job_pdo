<?php

$group_name = $args['group_name'] ?? 'our_offices';

if (have_rows($group_name)) :
    Enqueue::style('public/parts/our-offices-section/our-offices-section.css', [
        'is_root_path' => true
    ]);
?>

    <?php while (have_rows($group_name)) : the_row(); ?>
        <section class="our-offices container" data-columns data-theme="dark">
            <h2 class="our-offices__heading"><?php echo esc_html(get_sub_field('title')); ?></h1>
                <div class="our-offices__wrapper">
                    <?php if (have_rows('content')) : ?>

                        <?php while (have_rows('content')) : the_row(); ?>
                            <?php
                            $image_id = get_sub_field('photo');
                            $country = get_sub_field('country');
                            $city = get_sub_field('city');
                            $address = get_sub_field('address');
                            ?>

                            <div class="our-offices__row">
                                <div class="our-offices__column">
                                    <?php if (!empty($country)) : ?>
                                        <div class="our-offices__info-wrapper">
                                            <div class="our-offices__label">
                                                <?php _e('Country', 'SECRET-domain'); ?>
                                            </div>
                                            <div class="our-offices__info">
                                                <?php echo esc_html($country); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($city)) : ?>
                                        <div class="our-offices__info-wrapper">
                                            <div class="our-offices__label">
                                                <?php _e('City', 'SECRET-domain'); ?>
                                            </div>
                                            <div class="our-offices__info">
                                                <?php echo esc_html($city); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($address)) : ?>
                                        <div class="our-offices__info-wrapper">
                                            <div class="our-offices__label">
                                                <?php _e('Address', 'SECRET-domain'); ?>
                                            </div>
                                            <div class="our-offices__info">
                                                <?php echo esc_html($address); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="our-offices__column">
                                    <?php if (!empty($image_id)) : ?>
                                        <?php
                                        echo wp_get_attachment_image($image_id, '', false, ['alt' => $title]);
                                        ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>