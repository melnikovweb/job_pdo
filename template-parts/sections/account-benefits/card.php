<?php
	$title = $args['title'] ?? '';
	$subtitle = $args['subtitle'] ?? '';
	$text = $args['text'] ?? '';
	$theme = $args['theme'] ?? 'black';
	$size = $args['size'] ?? '';
	$images_ids = $args['images'] ?? array();
?>
<div class="account-benefit-card <?php echo esc_attr( $theme ); ?> <?php echo esc_attr( $size ); ?>">
	<?php if ( $title || $images_ids ) { ?>
		<div class="account-benefit-card__header">
			<?php if ( $images_ids ) { ?>
				<div class="account-benefit-card__images">
					<?php foreach ( $images_ids as $image_id ) { ?>
						<?php echo wp_get_attachment_image( $image_id, 'icon-72', false, ['class' => 'account-benefit-card__image'] ); ?>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if ( $title ) { ?>
				<div class="account-benefit-card__title">
					<?php echo wp_kses_post( $title ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if ( $subtitle ) { ?>
		<div class="account-benefit-card__subtitle">
			<?php echo esc_html( $subtitle ); ?>
		</div>
	<?php } ?>

	<?php if ( $text ) { ?>
		<div class="account-benefit-card__text">
			<?php echo esc_html( $text ); ?>
		</div>
	<?php } ?>
</div>