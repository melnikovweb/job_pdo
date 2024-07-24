<?php
$group_name = $args['group_name'] ?? 'account_benefits';

if (have_rows($group_name)) :
	Enqueue::style('public/parts/account-benefits/account-benefits.css', [
		'is_root_path' => true,
	]);
?>
	<?php while (have_rows($group_name)) : the_row(); ?>
		<div class="account-benefits" data-theme="dark">
			<div class="container" data-columns>
				<div class="account-benefits__header">
					<div class="account-benefits__title"><?php the_sub_field('title') ?></div>

					<div class="account-benefits__description"><?php the_sub_field('description') ?></div>
				</div>
			</div>
			<?php if (have_rows('cards')) : ?>
				<?php
					$columns_per_row = 4;
					$counter = 0;
				?>
				<div class="account-benefits__cards container">
					<div class="account-benefits__cards-row">
						<?php while (have_rows('cards')) : the_row(); ?>
							<?php if ( $counter != 0 && $counter % $columns_per_row == 0 ) { ?>
								</div><div class="account-benefits__cards-row">
							<?php } ?>
							<?php
								$type = get_sub_field('type');
								if ( $type == 'group' ) {
									$items = get_sub_field('items');
									$group_theme = get_sub_field('theme');
									echo '<div class="account-benefits__cards-group ' . esc_attr( $group_theme ) . '" style="--grid-column:' . count($items) . '">';
										foreach ($items as $item) {
											$counter++;
											get_template_part('template-parts/sections/account-benefits/card', '', $item);
										}
									echo '</div>';
								} else {
									$item = get_sub_field('item');
									$counter++;
									get_template_part('template-parts/sections/account-benefits/card', '', $item);
								}
							?>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
